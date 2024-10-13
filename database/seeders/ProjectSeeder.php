<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectProgress;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::take(5)->get();

        $projects = [
            [
                'name' => 'Online Shop Project',
                'description' => 'An online shop platform',
                'start_date' => '2024-01-01',
                'end_date' => '2024-06-30',
                'user_id' => $users[0]->id,
                'list_job' => json_encode(['Design UI', 'Develop Backend', 'Test Features', 'Deploy']),
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'A new mobile app',
                'start_date' => '2024-02-01',
                'end_date' => '2024-07-31',
                'user_id' => $users[1]->id,
                'list_job' => json_encode(['Create Wireframe', 'Code Frontend', 'Integrate API', 'Launch App']),
            ],
        ];

        foreach ($projects as $projectData) {
            $project = Project::create($projectData);

            foreach ($users as $user) {
                ProjectMember::create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                ]);
            }

            $leader = User::find($projectData['user_id']);
            foreach (json_decode($projectData['list_job']) as $index => $job) {
                ProjectProgress::create([
                    'project_id' => $project->id,
                    'user_id' => $leader->id,
                    'job_index' => $index,
                    'is_completed' => (bool) rand(0, 1),
                ]);
            }

            // // Assign progress ke setiap member proyek, bukan hanya leader
            // foreach ($users as $user) {
            //     foreach (json_decode($projectData['list_job']) as $index => $job) {
            //         ProjectProgress::create([
            //             'project_id' => $project->id,
            //             'user_id' => $user->id,
            //             'job_index' => $index,
            //             'is_completed' => false,
            //         ]);
            //     }
            // }
        }
    }
}
