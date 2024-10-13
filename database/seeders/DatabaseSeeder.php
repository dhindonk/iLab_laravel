<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => '123@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'verify' => true,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'image' => 'male.png',
            'full_name' => 'Admin User',
            'gender' => 'male',
            'phone' => '081234567890',
            'residential_address' => 'Jl. Contoh Alamat',
            'status' => 'admin',
            'student_identity_number' => null,
            'country_of_origin' => 'Indonesia',
            'university_name' => 'Universitas Contoh',
            'affiliate' => 'Fakultas Teknologi',
            'university_address' => 'Jl. Contoh Universitas',
            'university_country' => 'Indonesia',
        ]);

        $this->call(
            [
                BannersSeeder::class,
                MitraSeeder::class,
                UserSeeder::class,
                ProfileSeeder::class,
                ProjectSeeder::class,
            ]
        );
    }
}
