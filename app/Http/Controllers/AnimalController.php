<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $type = $request->query('type'); // mamifero, reptil...
        $environment = $request->query('environment'); // tierra | mar

        $query = Animal::query();

        if ($q) {
            $query->where('name', 'like', "%{$q}%")
                ->orWhere('habitat', 'like', "%{$q}%");
        }

        if ($type) {
            $query->where('animal_type', $type);
        }

        if ($environment) {
            $query->where('environment', $environment);
        }

        $animals = $query->orderByDesc('id')->paginate(9);

        // (Opcional pero queda muy bien) para mostrar "quitar/añadir" como en vídeos
        $favoriteAnimalIds = [];
        if (Auth::check()) {
            $favoriteAnimalIds = Favorite::where('user_id', Auth::id())
                ->where('item_type', 'animal')
                ->pluck('item_id')
                ->toArray();
        }

        return view('animals.index', compact('animals', 'q', 'type', 'environment', 'favoriteAnimalIds'));
    }

    public function show(Animal $animal)
    {
        $isFavorite = false;

        if (Auth::check()) {
            $isFavorite = Favorite::where('user_id', Auth::id())
                ->where('item_type', 'animal')
                ->where('item_id', $animal->id)
                ->exists();
        }

        return view('animals.show', compact('animal', 'isFavorite'));
    }
}
