<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $age = $request->query('age');

        $query = Video::query();

        if ($category) $query->where('category', $category);
        if ($age) $query->where('age_group', $age);

        $videos = $query->orderByDesc('id')->paginate(9);

        // 🔴 NUEVO: sacar ids favoritos del usuario
        $favoriteVideoIds = [];

        if (Auth::check()) {
            $favoriteVideoIds = Favorite::where('user_id', Auth::id())
                ->where('item_type', 'video')
                ->pluck('item_id')
                ->toArray();
        }

        return view('videos.index', compact('videos', 'category', 'age', 'favoriteVideoIds'));
    }

    public function show(Video $video)
    {
        $isFavorite = false;

        if (Auth::check()) {
            $isFavorite = Favorite::where('user_id', Auth::id())
                ->where('item_type', 'video')
                ->where('item_id', $video->id)
                ->exists();
        }

        return view('videos.show', compact('video', 'isFavorite'));
    }
}
