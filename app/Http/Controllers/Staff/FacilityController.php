<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        // Menampilkan fasilitas terbaru di urutan teratas
        $facilities = Facility::latest()->get();
        return view('staff.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('staff.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'information' => 'nullable|string',
        ]);

        // Menggunakan only() untuk keamanan mass assignment
        Facility::create($request->only(['name', 'information']));

        return redirect()->route('staff.facilities.index')
                         ->with('success', 'Data fasilitas berhasil ditambahkan!');
    }

    // Menggunakan Route Model Binding (Facility $facility)
    public function edit(Facility $facility)
    {
        return view('staff.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'information' => 'nullable|string',
        ]);

        $facility->update($request->only(['name', 'information']));

        return redirect()->route('staff.facilities.index')
                         ->with('success', 'Data fasilitas berhasil diperbarui!');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('staff.facilities.index')
                         ->with('danger', 'Data fasilitas berhasil dihapus!');
    }
}