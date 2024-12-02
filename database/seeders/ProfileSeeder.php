<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 40; $i++) {
            // Insert into 'users' table
            $userId = DB::table('users')->insertGetId([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Default password
                'role' => $faker->randomElement(['user', 'admin']),
                'verify' => $faker->boolean(70), // 70% verified
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert into 'profiles' table
            DB::table('profiles')->insert([
                'user_id' => $userId,
                'image' => $faker->imageUrl(200, 200, 'people', true, 'Faker'),
                'full_name' => $faker->name,
                'gender' => $faker->randomElement(['male', 'female']),
                'phone' => $faker->unique()->phoneNumber,
                'residential_address' => $faker->address,
                'status' => $faker->randomElement(['single', 'married']),
                'student_identity_number' => $faker->unique()->numerify('NIM#########'),
                'country_of_origin' => 'Indonesia',
                'university_name' => $faker->company . ' University',
                'affiliate' => $faker->company,
                'university_address' => $faker->address,
                'university_country' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
