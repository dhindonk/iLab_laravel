<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('creator', 'progress')->get();

        return view('pages.projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with('creator', 'members', 'progress')->findOrFail($id);

        // Hitung progress berdasarkan pekerjaan yang telah selesai
        $totalJobs = count(json_decode($project->list_job));
        $completedJobs = $project->progress->where('is_completed', true)->count();
        $progressPercentage = ($totalJobs > 0) ? ($completedJobs / $totalJobs) * 100 : 0;

        return view('pages.projects.show', compact('project', 'progressPercentage'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project')->with('success', 'Project berhasil dihapus.');
    }
}
