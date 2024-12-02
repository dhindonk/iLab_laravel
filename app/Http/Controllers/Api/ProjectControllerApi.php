<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectProgress;
use App\Models\ProjectJoinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectControllerApi extends Controller
{
    /**
     * Display a listing of all projects
     */
    public function index(Request $request)
    {
        $projects = Project::with(['creator.profile', 'members.profile', 'progress', 'joinRequests'])
            ->get()
            ->map(function ($project) use ($request) {
                $project->is_owner = $project->user_id === $request->user()->id;
                $project->has_pending_request = $project->joinRequests()
                    ->where('user_id', $request->user()->id)
                    ->where('status', 'pending')
                    ->exists();
                $project->total_jobs = count(json_decode($project->list_job));
                $project->completed_jobs = $project->progress()->where('is_completed', true)->count();
                $project->progress_percentage = $project->total_jobs > 0
                    ? ($project->completed_jobs / $project->total_jobs) * 100
                    : 0;
                return $project;
            });

        return response()->json([
            'projects' => $projects,
            'user_is_verified' => $request->user()->verify
        ]);
    }

    public function store(Request $request)
    {
        // Check if user is verified
        if (!$request->user()->verify) {
            return response()->json([
                'error' => 'Only verified users can create projects'
            ], 403);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'list_job' => 'required|array',
            'list_job.*.job_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => $request->user()->id,
            'list_job' => json_encode($request->list_job),
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project->load('members')
        ], 201);
    }

    /**
     * Request to join a project
     */
    public function requestJoin(Request $request, Project $project)
    {
        // Check if user is not the owner
        if ($project->user_id === $request->user()->id) {
            return response()->json([
                'error' => 'You cannot join your own project'
            ], 422);
        }

        // Check if user already has a pending request
        if ($project->joinRequests()->where('user_id', $request->user()->id)->exists()) {
            return response()->json([
                'error' => 'You already have a pending request for this project'
            ], 422);
        }

        // Create join request
        $joinRequest = ProjectJoinRequest::create([
            'project_id' => $project->id,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Join request sent successfully',
            'request' => $joinRequest
        ]);
    }

    /**
     * Handle join request (approve/reject)
     */
    public function handleJoinRequest(Request $request, Project $project, ProjectJoinRequest $joinRequest)
    {
        // Verify the current user is the project owner
        if ($project->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:approved,rejected',
            'assigned_jobs' => 'required_if:status,approved|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $joinRequest->status = $request->status;
        $joinRequest->save();

        if ($request->status === 'approved') {
            // Add user as project member
            $project->members()->attach($joinRequest->user_id);

            // Assign jobs
            foreach ($request->assigned_jobs as $jobIndex) {
                ProjectProgress::create([
                    'project_id' => $project->id,
                    'user_id' => $joinRequest->user_id,
                    'job_index' => $jobIndex,
                    'is_completed' => false
                ]);
            }
        }

        return response()->json([
            'message' => 'Join request ' . $request->status,
            'project' => $project->load('members', 'progress')
        ]);
    }

    // Tambah method baru untuk assign job
    public function assignJob(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'job_index' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Cek apakah user adalah member project
        if (!$project->members()->where('user_id', $request->user_id)->exists()) {
            return response()->json(['error' => 'User bukan member project ini'], 422);
        }

        // Hapus assignment lama jika ada
        ProjectProgress::where('project_id', $project->id)
            ->where('job_index', $request->job_index)
            ->delete();

        // Update atau buat assignment baru
        $progress = ProjectProgress::updateOrCreate(
            [
                'project_id' => $project->id,
                'job_index' => $request->job_index
            ],
            [
                'user_id' => $request->user_id,
                'is_completed' => false
            ]
        );

        return response()->json([
            'message' => 'Job berhasil diassign',
            'progress' => $progress
        ]);
    }

    /**
     * Update the progress of a project.
     */
    public function updateProgress(Request $request, Project $project)
    {
        $user = $request->user();

        // Cek apakah job ini dimiliki oleh user yang request
        $progress = ProjectProgress::where('project_id', $project->id)
            ->where('job_index', $request->job_index)
            ->where('user_id', $user->id)
            ->first();

        if (!$progress) {
            return response()->json([
                'error' => 'Anda tidak memiliki akses ke job ini'
            ], 403);
        }

        // Update progress
        $progress->update([
            'is_completed' => $request->is_completed
        ]);

        // Cek apakah semua job dalam project ini telah selesai
        $allJobsCompleted = $project->progress()->where('is_completed', false)->count() === 0;

        if ($allJobsCompleted) {
            $project->update([
                'status' => 'Completed'
            ]);
        }

        return response()->json($progress);
    }

    /**
     * Calculate the progress of a project.
     */
    public function calculateProgress(Project $project, $userId)
    {
        $totalJobs = count(json_decode($project->list_job));
        $completedJobs = $project->progress()->where('user_id', $userId)->where('is_completed', true)->count();

        return ($completedJobs / $totalJobs) * 100;
    }

    // Tambahkan method addMember
    public function addMember(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Cek apakah user sudah menjadi member
        if ($project->members()->where('user_id', $request->user_id)->exists()) {
            return response()->json(['error' => 'User sudah menjadi member project ini'], 422);
        }

        // Tambahkan member baru
        $project->members()->attach($request->user_id);

        return response()->json([
            'message' => 'Member berhasil ditambahkan',
            'project' => $project->load('members')
        ]);
    }

    // Tambahkan juga method getProjectMembers
    public function getProjectMembers(Project $project)
    {
        return response()->json([
            'members' => $project->members
        ]);
    }

    // Tambahkan method removeMember
    public function removeMember(Project $project, $userId)
    {
        // Cek apakah user adalah member
        if (!$project->members()->where('user_id', $userId)->exists()) {
            return response()->json(['error' => 'User bukan member project ini'], 422);
        }

        // Hapus semua progress job user di project ini
        ProjectProgress::where('project_id', $project->id)
            ->where('user_id', $userId)
            ->delete();

        // Hapus user dari project
        $project->members()->detach($userId);

        return response()->json([
            'message' => 'Member berhasil dihapus dari project'
        ]);
    }

    public function getPendingJoinRequests(Project $project, Request $request)
    {
        // Verify user is project owner
        if ($request->user()->id !== $project->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pendingRequests = $project->joinRequests()
            ->with('user.profile')
            ->where('status', 'pending')
            ->get();

        return response()->json($pendingRequests);
    }

    /**
     * Get projects by status (owned, member, available)
     */
    public function getProjectsByStatus(Request $request, $status)
    {
        $user = $request->user();

        switch ($status) {
            case 'owned':
                $projects = Project::with(['creator.profile', 'members.profile', 'progress', 'joinRequests'])
                    ->where('user_id', $user->id)
                    ->get();
                break;

            case 'member':
                $projects = $user->memberProjects()
                    ->with(['creator.profile', 'members.profile', 'progress', 'joinRequests'])
                    ->get();
                break;

            case 'available':
                $projects = Project::with(['creator.profile', 'members.profile', 'progress', 'joinRequests'])
                    ->whereNotIn('id', function ($query) use ($user) {
                        $query->select('project_id')
                            ->from('project_members')
                            ->where('user_id', $user->id);
                    })
                    ->where('user_id', '!=', $user->id)
                    ->whereNotIn('id', function ($query) use ($user) {
                        $query->select('project_id')
                            ->from('project_join_requests')
                            ->where('user_id', $user->id)
                            ->where('status', 'pending');
                    })
                    ->get();
                break;

            default:
                return response()->json(['error' => 'Invalid status'], 400);
        }

        // Tambahkan informasi tambahan seperti di method index
        $projects = $projects->map(function ($project) use ($user) {
            $project->is_owner = $project->user_id === $user->id;
            $project->has_pending_request = $project->joinRequests()
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->exists();
            $project->total_jobs = count(json_decode($project->list_job));
            $project->completed_jobs = $project->progress()->where('is_completed', true)->count();
            $project->progress_percentage = $project->total_jobs > 0
                ? ($project->completed_jobs / $project->total_jobs) * 100
                : 0;
            return $project;
        });

        return response()->json([
            'projects' => $projects,
            'user_is_verified' => $user->verify
        ]);
    }

    /**
     * Get user's join request notifications
     */
    public function getJoinRequestNotifications(Request $request)
    {
        $user = $request->user();

        // Get notifications for project owner
        $ownerNotifications = ProjectJoinRequest::with(['user.profile', 'project'])
            ->whereHas('project', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('status', 'pending')
            ->get()
            ->map(function ($request) {
                return [
                    'type' => 'join_request',
                    'message' => $request->user->profile->full_name . ' requested to join ' . $request->project->name,
                    'data' => $request
                ];
            });

        // Get notifications for requesting user
        $userNotifications = ProjectJoinRequest::with(['project.creator.profile'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['approved', 'rejected'])
            ->where('is_read', false)
            ->get()
            ->map(function ($request) {
                return [
                    'type' => 'request_response',
                    'message' => 'Your request to join ' . $request->project->name . ' was ' . $request->status,
                    'data' => $request
                ];
            });

        return response()->json([
            'notifications' => $ownerNotifications->concat($userNotifications)
        ]);
    }

    // 
    public function getProjectDetail(Project $project, Request $request)
    {
        // Verify user is project owner
        if ($request->user()->id !== $project->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get project with relationships
        $project->load(['creator.profile', 'members.profile', 'progress', 'joinRequests']);

        // Get available jobs
        $listJobs = json_decode($project->list_job, true);

        // Get assigned jobs
        $assignedJobs = $project->progress()
            ->select('job_index', 'user_id')
            ->with('user.profile')
            ->get()
            ->groupBy('job_index')
            ->map(function ($items) {
                return $items->first();
            });

        // Add assignment info to jobs
        $jobs = collect($listJobs)->map(function ($job, $index) use ($assignedJobs) {
            $assignment = $assignedJobs->get($index);
            return [
                'index' => $index,
                'job_name' => $job['job_name'],
                'assigned_to' => $assignment ? [
                    'user_id' => $assignment->user_id,
                    'user_name' => $assignment->user->profile->full_name ?? 'Unknown',
                ] : null,
            ];
        });

        return response()->json([
            'project' => $project,
            'jobs' => $jobs,
        ]);
    }
}
