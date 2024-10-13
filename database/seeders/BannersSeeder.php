<?php

namespace Database\Seeders;

use App\Models\Banners;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'name' => 'Summer Sale',
                'image' => 'https://fastly.picsum.photos/id/113/800/600.jpg?hmac=HoE3TuhCGlcL84nejl2y1PxOlDXI3BMmZnjVNAJMKbY',
            ],
            [
                'name' => 'Winter Collection',
                'image' => 'https://fastly.picsum.photos/id/1032/800/600.jpg?hmac=Si6JgFQrUSDeMFCBPI7pRDH3eN4bi3mYmoy_Y8jcP7Q',
            ],
            [
                'name' => 'New Arrivals',
                'image' => 'https://fastly.picsum.photos/id/326/800/600.jpg?hmac=p6tJmtJ8GuRWGxVyL0nTkalJJKYWyQgO7sEs3Fku8Cw',
            ],
            [
                'name' => 'Exclusive Offers',
                'image' => 'https://fastly.picsum.photos/id/1009/800/600.jpg?hmac=_9YTMEi1aIocCF21g3zBOJbwA6QcLmBuyosYESkQLVQ',
            ],
        ];

        foreach ($banners as $banner) {
            Banners::create($banner);
        }
    }
}
