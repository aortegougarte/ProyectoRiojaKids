<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:120',
            'youtube_id' => ['required','string','regex:/^[A-Za-z0-9_-]{11}$/'],
            'category' => 'required|string|max:50',
            'age_group' => 'required|string|max:20',
            'description' => 'nullable|string|max:1500',
            'featured' => 'nullable|boolean',
        ]);

        $data['featured'] = (bool) ($data['featured'] ?? false);

        Video::create($data);

        return redirect()->route('admin.videos.index')
            ->with('status', 'Vídeo creado ✅');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'title' => 'required|string|max:120',
            'youtube_id' => ['required','string','regex:/^[A-Za-z0-9_-]{11}$/'],
            'category' => 'required|string|max:50',
            'age_group' => 'required|string|max:20',
            'description' => 'nullable|string|max:1500',
            'featured' => 'nullable|boolean',
        ]);

        $data['featured'] = (bool) ($data['featured'] ?? false);

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('status', 'Vídeo actualizado ✅');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('status', 'Vídeo borrado 🗑️');
    }
}
