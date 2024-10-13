<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'residential_address' => $request->residential_address,
            'status' => $request->status,
            'student_identity_number' => $request->student_identity_number,
            'country_of_origin' => $request->country_of_origin,
            'university_name' => $request->university_name,
            'affiliate' => $request->affiliate,
            'university_address' => $request->university_address,
            'university_country' => $request->university_country,
        ]);

        Auth::login($user);

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }
}
