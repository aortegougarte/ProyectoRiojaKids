<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('games.index');
    }

    public function memory()
    {
        return view('games.memory');
    }

    public function quiz()
    {
        return view('games.quiz');
    }
}
