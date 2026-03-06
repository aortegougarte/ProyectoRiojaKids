<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class HomeController extends Controller
{
    public function index()
    {
        $latestVideos = \App\Models\Video::latest()->take(6)->get();
        $featuredAnimals = \App\Models\Animal::latest()->take(6)->get();

        $favoriteCount = 0;

        if (Auth::check()) {
            $favoriteCount = Favorite::where('user_id', Auth::id())->count();
        }

        return view('home', compact('latestVideos', 'featuredAnimals', 'favoriteCount'));
    }
}
