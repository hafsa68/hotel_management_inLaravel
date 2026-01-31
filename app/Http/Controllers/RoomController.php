<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    public function index()
    {
        $data = Room::latest()->get();
        return view('backend.room.index', compact('data'));
    }

    public function create()
    {
        return view('backend.room.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'room_type' => 'required',
        'fare' => 'required|numeric',
        'total_adult' => 'required|integer', // 'adults' এর পরিবর্তে 'total_adult'
        'total_child' => 'required|integer', // 'children' এর পরিবর্তে 'total_child'
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    // স্লাগ তৈরি
    $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

    // মেইন ইমেজ আপলোড
    if ($request->hasFile('main_image')) {
        $path = public_path('uploads/rooms');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $imageName = time() . '.' . $request->main_image->extension();
        $request->main_image->move($path, $imageName);
        $data['main_image'] = 'uploads/rooms/' . $imageName;
    }

    // গ্যালারি ইমেজ আপলোড
    if ($request->hasFile('gallery')) {
        $galleryPath = public_path('uploads/rooms/gallery');
        if (!File::isDirectory($galleryPath)) {
            File::makeDirectory($galleryPath, 0777, true, true);
        }

        $galleryPaths = [];
        foreach ($request->file('gallery') as $file) {
            $name = uniqid() . '.' . $file->extension();
            $file->move($galleryPath, $name);
            $galleryPaths[] = 'uploads/rooms/gallery/' . $name;
        }
        // মডেলে $casts থাকলে json_encode করার দরকার নেই, লারাভেল নিজে করবে
        $data['gallery_images'] = $galleryPaths; 
    }

    Room::create($data);

    return redirect()->route('room.index')->with('success', 'Room added successfully!');
}
    public function edit(Room $room)
    {
        return view('backend.room.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fare' => 'required|numeric',
            'adults' => 'required|integer',
            'children' => 'required|integer',
            'room_type' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        
       

        if ($request->hasFile('main_image')) {
            if ($room->main_image && file_exists(public_path($room->main_image))) {
                unlink(public_path($room->main_image));
            }
            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('uploads/rooms'), $imageName);
            $data['main_image'] = 'uploads/rooms/' . $imageName;
        }

        $room->update($data);
        return redirect()->route('room.index')->with('success', 'Room Updated Successfully');
    }

    public function destroy(Room $room)
    {
        if ($room->main_image && file_exists(public_path($room->main_image))) {
            unlink(public_path($room->main_image));
        }

        $room->delete();
        return redirect()->route('room.index')->with('success', 'Room Deleted Successfully');
    }

    public function statusToggle(Request $request)
    {
        $room = Room::findOrFail($request->id);
        $room->status = $room->status == 'Enabled' ? 'Disabled' : 'Enabled';
        $room->save();

        return response()->json(['status' => $room->status]);
    }
}