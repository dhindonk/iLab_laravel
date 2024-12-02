<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Http\Requests\StoreBannersRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBannersRequest;

class BannersController extends Controller
{

    public function index()
    {
        $banners = Banners::orderBy('id', 'desc')->get();
        return view('pages.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('pages.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/banners/'), $imageName);

        Banners::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return redirect()->route('banners.index')
                         ->with('success', 'Banner created successfully.');
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Banners $banner)
    {
        return view('pages.banners.edit', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, Banners $banner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/banners/'), $imageName);
            $banner->image = $imageName;
        }

        $banner->name = $request->name;
        $banner->save();

        return redirect()->route('banners.index')
                         ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Banners $banner)
    {
        if (file_exists(public_path('images/banners/' . $banner->image))) {
            unlink(public_path('images/banners/' . $banner->image));
        }

        $banner->delete();
        return redirect()->route('banners.index')
                         ->with('success', 'Banner deleted successfully.');
    }
}
