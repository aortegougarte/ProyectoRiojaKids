<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Favorite;
use App\Models\Video;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // IDs favoritos por tipo
        $videoIds = Favorite::where('user_id', $userId)
            ->where('item_type', 'video')
            ->pluck('item_id');

        $animalIds = Favorite::where('user_id', $userId)
            ->where('item_type', 'animal')
            ->pluck('item_id');

        // Traer modelos reales
        $favoriteVideos = Video::whereIn('id', $videoIds)->latest()->get();
        $favoriteAnimals = Animal::whereIn('id', $animalIds)->latest()->get();

        return view('favorites.index', compact('favoriteVideos', 'favoriteAnimals'));
    }

    public function toggleVideo(Request $request, Video $video)
    {
        $userId = $request->user()->id;

        $fav = Favorite::where('user_id', $userId)
            ->where('item_type', 'video')
            ->where('item_id', $video->id)
            ->first();

        if ($fav) {
            $fav->delete();
            return back()->with('status', 'Quitado de favoritos 💔');
        }

        Favorite::create([
            'user_id' => $userId,
            'item_type' => 'video',
            'item_id' => $video->id,
        ]);

        return back()->with('status', 'Añadido a favoritos ❤️');
    }

    public function toggleAnimal(Request $request, Animal $animal)
    {
        $userId = $request->user()->id;

        $fav = Favorite::where('user_id', $userId)
            ->where('item_type', 'animal')
            ->where('item_id', $animal->id)
            ->first();

        if ($fav) {
            $fav->delete();
            return back()->with('status', 'Quitado de favoritos 💔');
        }

        Favorite::create([
            'user_id' => $userId,
            'item_type' => 'animal',
            'item_id' => $animal->id,
        ]);

        return back()->with('status', 'Añadido a favoritos ❤️');
    }
}
