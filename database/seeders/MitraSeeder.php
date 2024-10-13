<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mitras = [
            [
                'name' => 'Gass',
                'image' => 'https://picsum.photos/800/600',
            ],
            [
                'name' => 'Hmm1',
                'image' => 'https://picsum.photos/800/600',
            ],
            [
                'name' => 'New Sponsor',
                'image' => 'https://picsum.photos/800/600',
            ],
            [
                'name' => 'Exclusive Offers',
                'image' => 'https://picsum.photos/800/600',
            ],
        ];

        foreach ($mitras as $mitra) {
            Mitra::create($mitra);
        }
    }
}
