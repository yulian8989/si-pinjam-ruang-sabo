<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('staff.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $facilities = Facility::all();
        return view('staff.rooms.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255|unique:rooms,name',
            'description'  => 'required|string',
            'capacity'     => 'required|integer|min:1',
            'facilities'   => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
            'images'       => 'nullable|array|max:5',
            'images.*'     => 'image|mimes:jpg,png,jpeg|max:2048', 
        ], [
            'name.unique'      => 'Nama ruangan sudah terdaftar.',
            'images.*.max'     => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'images.*.mimes'   => 'Format gambar harus JPG, PNG, atau JPEG.',
            'capacity.min'     => 'Kapasitas minimal adalah 1 orang.',
        ]);
    
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 5) as $image) {
                $imagePaths[] = $image->store('rooms', 'public');
            }
        }
    
        $data = $request->only(['name', 'description', 'capacity']);
        $data['images'] = $imagePaths;
        $data['is_active'] = $request->has('is_active');

        $room = Room::create($data);

        if ($request->has('facilities')) {
            $facilityData = [];
            foreach ($request->facilities as $facilityId) {
                $facilityData[$facilityId] = [
                    'quantity' => $request->quantities[$facilityId] ?? 1
                ];
            }
            $room->facilities()->attach($facilityData);
        }
    
        return redirect()->route('staff.rooms.index')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    public function edit(Room $room)
    {
        $room->load('facilities');
        $facilities = Facility::all();
        return view('staff.rooms.edit', compact('room', 'facilities'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:rooms,name,' . $room->id,
            'description' => 'required|string',
            'capacity'    => 'required|integer|min:1',
            'images.*'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'capacity']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('images')) {

            if ($room->images) {
                foreach ($room->images as $oldImagePath) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            $imagePaths = [];
            foreach (array_slice($request->file('images'), 0, 5) as $image) {
                $imagePaths[] = $image->store('rooms', 'public');
            }
            $data['images'] = $imagePaths;
        }

        $room->update($data);

        if ($request->has('facilities')) {
            $facilityData = [];
            foreach ($request->facilities as $facilityId) {
                $facilityData[$facilityId] = [
                    'quantity' => $request->quantities[$facilityId] ?? 1
                ];
            }
            $room->facilities()->sync($facilityData);
        } else {
            $room->facilities()->sync([]);
        }

        return redirect()->route('staff.rooms.index')->with('success', 'Data ruangan berhasil diperbarui!');
    }

    public function destroy(Room $room)
    {
  
        if ($room->images && is_array($room->images)) {
            foreach ($room->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $room->delete();

        return redirect()->route('staff.rooms.index')->with('success', 'Data ruangan berhasil dihapus!');
    } 

    public function show(Room $room)
    {

        $room->load(['facilities', 'reviews.user']);


        $averageRating = $room->reviews()->avg('rating');
        $totalReviews = $room->reviews()->count();

        return view('user.rooms.show', compact('room', 'averageRating', 'totalReviews'));
    }
}