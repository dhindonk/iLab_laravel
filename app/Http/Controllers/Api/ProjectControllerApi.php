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
            'list_job' => json_encode($request->list_job), // Disimpan dalam format JSON
        ]);

        // Tambahkan user yang membuat project sebagai anggota
        $project->members()->attach($request->user()->id);

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ], 201);
    }


    /**
     * Update the progress of a project.
     */
    public function updateProgress(Request $request, Project $project)
    {
        $user = $request->user();

        $progress = ProjectProgress::updateOrCreate(
            ['project_id' => $project->id, 'user_id' => $user->id, 'job_index' => $request->job_index],
            ['is_completed' => $request->is_completed]
        );

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
}
