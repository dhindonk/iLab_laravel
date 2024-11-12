<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectProgress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat beberapa user tetap
        $users = [
            [
                'email' => 'pm@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'verify' => true,
            ],
            [
                'email' => 'frontend@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'verify' => true,
            ],
            [
                'email' => 'backend@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'verify' => true,
            ],
            [
                'email' => 'designer@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'verify' => true,
            ]
        ];

        // Simpan user dan collect ID-nya
        $userIds = [];
        foreach ($users as $userData) {
            $user = User::create($userData);
            $userIds[] = $user->id;
        }

        // Buat beberapa user random tambahan
        User::factory()->count(5)->create();
    }
}
