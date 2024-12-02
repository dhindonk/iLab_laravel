<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(): JsonResponse
    {
        $usersData = [
            [
                'email' => 'andi@gmail.com',
                'full_name' => 'Andi Susanto',
            ],
            [
                'email' => 'budi@gmail.com',
                'full_name' => 'Budi Wijaya',
            ],
            [
                'email' => 'citra.ayu@gmail.com',
                'full_name' => 'Citra Ayu',
            ],
            [
                'email' => 'diana.putri@gmail.com',
                'full_name' => 'Diana Putri',
            ],
            [
                'email' => 'eko.prasetyo@gmail.com',
                'full_name' => 'Eko Prasetyo',
            ],
            [
                'email' => 'fajar.hidayat@gmail.com',
                'full_name' => 'Fajar Hidayat',
            ],
            [
                'email' => 'gita.nurul@gmail.com',
                'full_name' => 'Gita Nurul',
            ],
            [
                'email' => 'hendra.kurniawan@gmail.com',
                'full_name' => 'Hendra Kurniawan',
            ],
            [
                'email' => 'ika.sari@gmail.com',
                'full_name' => 'Ika Sari',
            ],
            [
                'email' => 'joko.wijono@gmail.com',
                'full_name' => 'Joko Wijono',
            ],
        ];

        // Cek apakah email sudah terdaftar
        foreach ($usersData as $data) {
            if (User::where('email', $data['email'])->exists()) {
                return response()->json(['error' => 'Email ' . $data['email'] . ' sudah terdaftar'], 409);
            }
        }

        // Buat user baru
        try {
            foreach ($usersData as $data) {
                $gender = (rand(0, 1) === 0) ? 'male' : 'female'; // Random gender
                $image = ($gender === 'male') ? 'male.png' : 'female.png'; // Random image based on gender

                $user = User::create([
                    'email' => $data['email'],
                    'password' => Hash::make('12345678'), // 
                    'role' => 'mahasiswa',
                    'verify' => false, // 
                ]);

                // Buat profil baru
                Profile::create([
                    'user_id' => $user->id,
                    'image' => $image,
                    'full_name' => $data['full_name'],
                    'gender' => $gender,
                    'phone' => '+62-812-3456-78' . str_pad($user->id, 2, '0', STR_PAD_LEFT),
                    'residential_address' => 'Jalan Merdeka No. ' . $user->id . ', Jakarta, DKI Jakarta, 10110, Indonesia',
                    'status' => 'aktif',
                    'student_identity_number' => '123456789012345' . $user->id,
                    'country_of_origin' => 'Indonesia',
                    'university_name' => 'Universitas Pakuan',
                    'affiliate' => 'Himpunan Mahasiswa Ilmu Komputer',
                    'university_address' => 'Jalan Raya Pakuan No. 1, Bogor, Jawa Barat, 16127, Indonesia',
                    'university_country' => 'Indonesia',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan data pengguna: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data', 'isinya' => $e], 500);
        }

        return response()->json([
            'message' => '10 akun berhasil dibuat',
            'users' => $usersData,
        ], 201);
    }
}
