<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class MemberController extends Controller
{

    public function index()
    {
        $members = User::with('profile')
            ->where(function($query) {
                if(request('email')) {
                    $query->where('email', 'like', '%' . request('email') . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.members.index', compact('members'));
    }

    public function create()
    {
        return view('pages.members.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|min:8|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'full_name' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'phone' => [
                    'required',
                    'unique:profiles,phone',
                    'regex:/^([0-9\s\-\+\(\)]*)$/',
                    'min:10',
                    'max:15'
                ],
                'residential_address' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'student_identity_number' => 'nullable|string|max:255',
                'country_of_origin' => 'required|string|max:255',
                'university_name' => 'required|string|max:255',
                'affiliate' => 'required|string|max:255',
                'university_address' => 'required|string|max:255',
                'university_country' => 'required|string|max:255',
            ], [
                'phone.unique' => 'This phone number is already registered.',
                'phone.regex' => 'Please enter a valid phone number.',
                'phone.min' => 'Phone number must be at least 10 digits.',
                'phone.max' => 'Phone number cannot exceed 15 digits.',
                'email.unique' => 'This email is already registered.',
                'password.min' => 'Password must be at least 8 characters.',
                'image.max' => 'The image size cannot exceed 2MB.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'gender.in' => 'Please select a valid gender (male or female).',
            ]);

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'verify' => false
            ]);

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/foto_profile/'), $imageName);
            } else {
                $imageName = $request->gender == 'male' ? 'male.png' : 'female.png';
            }

            $user->profile()->create([
                'image' => $imageName,
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'phone' => preg_replace('/[^0-9]/', '', $request->phone), // Remove non-numeric characters
                'residential_address' => $request->residential_address,
                'status' => $request->status,
                'student_identity_number' => $request->student_identity_number,
                'country_of_origin' => $request->country_of_origin,
                'university_name' => $request->university_name,
                'affiliate' => $request->affiliate,
                'university_address' => $request->university_address,
                'university_country' => $request->university_country,
            ]);

            return redirect()->route('members.index')
                           ->with('success', 'Member created successfully.');

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // MySQL duplicate entry error code
                $field = str_contains($e->getMessage(), 'phone') ? 'phone number' : 'email';
                return redirect()->back()
                               ->withInput()
                               ->with('error', "This $field is already registered. Please use a different $field.");
            }
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }


    public function edit(User $member)
    {
        $profile = $member->profile;
        if (!$profile) {
            return redirect()->route('members.index')
                           ->with('error', 'Member profile not found.');
        }
        return view('pages.members.edit', compact('member', 'profile'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            
            if (!$user->profile) {
                return redirect()->back()
                               ->with('error', 'Member profile not found.');
            }

            $request->validate([
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|min:8|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'full_name' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'phone' => [
                    'required',
                    'regex:/^([0-9\s\-\+\(\)]*)$/',
                    'min:10',
                    'max:15',
                    'unique:profiles,phone,' . $user->profile->id
                ],
                'residential_address' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'student_identity_number' => 'nullable|string|max:255',
                'country_of_origin' => 'required|string|max:255',
                'university_name' => 'required|string|max:255',
                'affiliate' => 'required|string|max:255',
                'university_address' => 'required|string|max:255',
                'university_country' => 'required|string|max:255',
            ]);

            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $imageName = $user->profile->image;
            if ($request->hasFile('image')) {
                if ($imageName && !in_array($imageName, ['male.png', 'female.png']) &&
                    file_exists(public_path('images/foto_profile/' . $imageName))) {
                    unlink(public_path('images/foto_profile/' . $imageName));
                }
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/foto_profile/'), $imageName);
            }

            $user->profile()->update([
                'image' => $imageName,
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'phone' => preg_replace('/[^0-9]/', '', $request->phone),
                'residential_address' => $request->residential_address,
                'status' => $request->status,
                'student_identity_number' => $request->student_identity_number,
                'country_of_origin' => $request->country_of_origin,
                'university_name' => $request->university_name,
                'affiliate' => $request->affiliate,
                'university_address' => $request->university_address,
                'university_country' => $request->university_country,
            ]);

            return redirect()->route('members.index')
                           ->with('success', 'Member updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error updating member: ' . $e->getMessage());
        }
    }


    public function verify(Request $request, User $member)
    {
        $member->update([
            'verify' => !$member->verify,
        ]);

        return redirect()->route('members.index')->with('success', 'Verification status updated successfully');
    }


    public function destroy(User $member)
    {
        $member->profile()->delete();
        $member->delete();

        return redirect()->route('members.index')->with('success', 'User and Profile deleted successfully');
    }
}
