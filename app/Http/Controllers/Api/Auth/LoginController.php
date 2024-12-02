<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $token = $request->user()->currentAccessToken();
        if (!$token) {
            return response()->json(['error' => 'Token not found or already logged out'], 404);
        }
        try {
            $token->delete();
            return response()->json(['message' => 'Logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to logout'], 500);
        }
    }

    public function getAllMembers(Request $request)
    {
        $query = User::with('profile');
        $perPage = 25;

        if ($request->has('search') && !empty($request->search)) {
            // Mode pencarian
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('profile', function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('university_name', 'like', "%{$search}%");
                })
                    ->orWhere('email', 'like', "%{$search}%");
            });

            // Untuk search, ambil semua hasil tanpa pagination
            $members = $query->get();

            return response()->json([
                'message' => 'Success',
                'data' => $members,
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => count($members),
                'total' => count($members)
            ]);
        } else {
            // Mode normal dengan pagination
            $members = $query->paginate($perPage);

            return response()->json([
                'message' => 'Success',
                'data' => $members->items(),
                'current_page' => $members->currentPage(),
                'last_page' => $members->lastPage(),
                'per_page' => $members->perPage(),
                'total' => $members->total()
            ]);
        }
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
