<?php

namespace App\Http\Controllers\Antrian\Table;

use App\Http\Controllers\Controller;
use App\Models\Antrian\Video;
use App\Models\MWLWL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Video::all();
        return view("antrian.tables.video.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'path' => 'required|mimes:mp4,mov,avi|max:15000' // Batasan 10MB
        ]);

        if ($request->hasFile('path')) {
            $videoPath = $request->file('path')->store('videos', 'public');
            // dd($videoPath);
            
            Video::create([
                'path' => $videoPath
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        if ($request->hasFile('path')) {
            // Hapus video lama jika ada
            if ($video->path && Storage::disk('public')->exists($video->path)) {
                Storage::disk('public')->delete($video->path);
            }

            // Simpan video baru
            $path = $request->file('path')->store('videos', 'public');
            $video->path = $path;
        }

        $video->save();

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
