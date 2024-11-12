<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{

    public function index()
    {
        $members = User::with('profile')
            ->where('email', 'like', '%' . request('email') . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.members.index', compact('members'));
    }

    public function create()
    {
        return view('pages.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'residential_address' => 'required',
            'status' => 'required',
            'country_of_origin' => 'required',
            'university_name' => 'required',
            'affiliate' => 'required',
            'university_address' => 'required',
            'university_country' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/foto_profile/'), $imageName);
        } else {
            if ($request->gender == 'male') {
                $imageName = 'male.png';
            } else {
                $imageName = 'female.png';
            }
        }

        $user->profile()->create([
            'image' => $imageName,
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

        return redirect()->route('members.index')->with('success', 'User and Profile created successfully');
    }


    public function edit(User $member)
    {
        $profile = $member->profile;
        return view('pages.members.edit', compact('member', 'profile'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name' => 'required',
            'gender' => 'required',
            'phone' => 'required|unique:profiles,phone,' . $user->profile->id,
            'residential_address' => 'required',
            'status' => 'required',
            'country_of_origin' => 'required',
            'university_name' => 'required',
            'affiliate' => 'required',
            'university_address' => 'required',
            'university_country' => 'required',
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

        return redirect()->route('members.index')->with('success', 'User and Profile updated successfully');
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
