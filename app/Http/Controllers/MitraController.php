<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Http\Requests\StoreMitraRequest;
use App\Http\Requests\UpdateMitraRequest;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::paginate(10);
        return view('pages.mitra.index', compact('mitras'));
    }

    public function create()
    {
        return view('pages.mitra.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/mitras/'), $imageName);

        Mitra::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return redirect()->route('mitras.index')
            ->with('success', 'Mitra created successfully.');
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Mitra $mitra)
    {
        return view('pages.mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($mitra->image && file_exists(public_path('images/mitras/' . $mitra->image))) {
                unlink(public_path('images/mitras/' . $mitra->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/mitras/'), $imageName);
            $data['image'] = $imageName;
        }

        $mitra->update($data);

        return redirect()->route('mitras.index')
            ->with('success', 'Mitra updated successfully.');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Mitra $mitra)
    {
        if (file_exists(public_path('images/mitras/' . $mitra->image))) {
            unlink(public_path('images/mitras/' . $mitra->image));
        }

        $mitra->delete();
        return redirect()->route('mitras.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
