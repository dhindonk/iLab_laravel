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
        $projects = Project::with(['creator', 'members', 'progress'])
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.projects.index', compact('projects'));
    }

    public function show($id)
    {
        // Cari project berdasarkan ID
        $project = Project::with(['creator', 'members', 'progress'])
                         ->findOrFail($id);

        // Pastikan list_job tidak null
        $listJob = json_decode($project->list_job) ?? [];

        // Hitung progress per member
        $memberProgress = [];

        if ($project->members) {
            foreach ($project->members as $member) {
                // Hitung total pekerjaan yang ditugaskan kepada member ini
                $assignedJobs = $project->progress()->where('user_id', $member->id)->get();
                $totalJobs = $assignedJobs->count(); // Total pekerjaan yang ditugaskan
                $completedJobs = $assignedJobs->where('is_completed', true)->count(); // Pekerjaan yang telah diselesaikan oleh member

                $memberProgress[$member->id] = [
                    'percentage' => $totalJobs > 0 ? ($completedJobs / $totalJobs) * 100 : 0,
                    'completed' => $completedJobs,
                    'total' => $totalJobs // Total pekerjaan yang harus dikerjakan
                ];
            }
        }

        // Hitung progress keseluruhan project
        $totalProjectJobs = count($listJob);
        $completedProjectJobs = $project->progress()->where('is_completed', true)->count();
        $projectProgress = $totalProjectJobs > 0 ? ($completedProjectJobs / $totalProjectJobs) * 100 : 0;

        return view('pages.projects.show', compact('project', 'memberProgress', 'projectProgress'));
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('project')->with('success', 'Project berhasil dihapus.');
    }
}
