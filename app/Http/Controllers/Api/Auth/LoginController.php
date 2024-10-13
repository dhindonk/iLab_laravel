<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    //login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $loginData['email'])->first();

        //check user exist
        if (!$user) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        //check password
        if (!Hash::check($loginData['password'], $user->password)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response(['user' => $user, 'token' => $token], 200);
    }

    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['message' => 'Logged out'], 200);
    }

    public function getAllMembers()
    {
        $members = User::with('profile')->paginate(25);
        return response()->json([
            'message' => 'Success',
            'data' => $members->items(),
            'current_page' => $members->currentPage(),
            'last_page' => $members->lastPage(),
            'per_page' => $members->perPage(),
            'total' => $members->total(),
        ], 200);
    }

    // //update fcm token
    // public function updateFcmToken(Request $request)
    // {
    //     $request->validate([
    //         'fcm_token' => 'required',
    //     ]);

    //     $user = $request->user();
    //     $user->fcm_token = $request->fcm_token;
    //     $user->save();

    //     return response([
    //         'message' => 'FCM token updated',
    //     ], 200);
    // }
}
