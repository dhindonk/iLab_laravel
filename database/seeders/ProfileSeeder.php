<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Profile;
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            Profile::create([
                'user_id' => $user->id,
                'image' => 'https://picsum.photos/800/600',
                'full_name' => $faker->name,
                'gender' => $faker->randomElement(['male', 'female']),
                'phone' => $faker->phoneNumber,
                'residential_address' => $faker->address,
                'status' => 'mahasiswa',
                'student_identity_number' => $faker->optional()->numerify('STU####'),
                'country_of_origin' => $faker->country,
                'university_name' => $faker->company,
                'affiliate' => $faker->word,
                'university_address' => $faker->address,
                'university_country' => $faker->country,
            ]);
        }
    }
}
