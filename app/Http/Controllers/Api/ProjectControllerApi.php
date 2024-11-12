<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $projects = $user->projects()->with('members', 'progress')->get();

        return response()->json($projects);
    }

    public function store(Request $request)
    {
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

        // Buat project baru
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => $request->user()->id,
            'list_job' => json_encode($request->list_job),
        ]);

        // PM otomatis jadi member
        $project->members()->attach($request->user()->id);

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project->load('members')
        ], 201);
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
}
