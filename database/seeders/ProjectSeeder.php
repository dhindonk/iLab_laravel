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
        // Create admin user if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'verify' => true,
            ]
        );

        // Create some test users if needed
        $testUsers = [];
        for ($i = 1; $i <= 3; $i++) {
            $testUsers[] = User::firstOrCreate(
                ['email' => "user{$i}@gmail.com"],
                [
                    'password' => bcrypt('12345678'),
                    'role' => 'user',
                    'verify' => true,
                ]
            );
        }

        $projects = [
            [
                'name' => 'E-Commerce Platform Development',
                'description' => 'Development of a full-featured e-commerce platform with inventory management, payment integration, and analytics dashboard.',
                'start_date' => '2024-01-01',
                'end_date' => '2024-06-30',
                'user_id' => $admin->id,
                'list_job' => json_encode([
                    ['job_name' => 'System Architecture Design'],
                    ['job_name' => 'Database Schema Implementation'],
                    ['job_name' => 'Frontend Development'],
                    ['job_name' => 'Backend API Development'],
                ]),
            ],
            [
                'name' => 'Mobile Health Tracking App',
                'description' => 'Cross-platform mobile application for health monitoring, fitness tracking, and wellness recommendations.',
                'start_date' => '2024-02-01',
                'end_date' => '2024-08-31',
                'user_id' => $testUsers[0]->id,
                'list_job' => json_encode([
                    ['job_name' => 'UI/UX Design'],
                    ['job_name' => 'Core Features Development'],
                    ['job_name' => 'Health API Integration'],
                    ['job_name' => 'App Testing'],
                ]),
            ],
        ];

        foreach ($projects as $projectData) {
            // Create project
            $project = Project::create($projectData);

            // Add project owner as member
            ProjectMember::create([
                'project_id' => $project->id,
                'user_id' => $projectData['user_id'],
            ]);

            // Add some other members
            foreach ($testUsers as $user) {
                if ($user->id !== $projectData['user_id']) {
                    ProjectMember::create([
                        'project_id' => $project->id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            // Create progress entries
            $jobs = json_decode($projectData['list_job'], true);
            foreach ($jobs as $index => $job) {
                ProjectProgress::create([
                    'project_id' => $project->id,
                    'user_id' => $projectData['user_id'],
                    'job_index' => $index,
                    'is_completed' => (bool) rand(0, 1),
                ]);
            }
        }
    }
}
