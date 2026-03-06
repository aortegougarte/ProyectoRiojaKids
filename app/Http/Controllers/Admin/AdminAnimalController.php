<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AdminAnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::latest()->get();
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        return view('admin.animals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:80',
            'photo_url' => 'required|url|max:500',
            'environment' => 'required|in:tierra,mar',
            'animal_type' => 'required|in:mamifero,reptil,anfibio,ave,pez',
            'habitat' => 'required|string|max:80',
            'scientific_name' => 'nullable|string|max:120',
            'diet' => 'nullable|string|max:80',
            'lifespan_years' => 'nullable|integer|min:0|max:200',
            'size_cm' => 'nullable|integer|min:0|max:5000',
            'weight_kg' => 'nullable|numeric|min:0|max:100000',
            'description' => 'nullable|string|max:1500',
        ]);

        Animal::create($data);

        return redirect()->route('admin.animals.index')
            ->with('status', 'Animal creado ✅');
    }

    public function edit(Animal $animal)
    {
        return view('admin.animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $data = $request->validate([
            'name' => 'required|string|max:80',
            'photo_url' => 'required|url|max:500',
            'environment' => 'required|in:tierra,mar',
            'animal_type' => 'required|in:mamifero,reptil,anfibio,ave,pez',
            'habitat' => 'required|string|max:80',
            'scientific_name' => 'nullable|string|max:120',
            'diet' => 'nullable|string|max:80',
            'lifespan_years' => 'nullable|integer|min:0|max:200',
            'size_cm' => 'nullable|integer|min:0|max:5000',
            'weight_kg' => 'nullable|numeric|min:0|max:100000',
            'description' => 'nullable|string|max:1500',
        ]);

        $animal->update($data);

        return redirect()->route('admin.animals.index')
            ->with('status', 'Animal actualizado ✅');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('admin.animals.index')
            ->with('status', 'Animal borrado 🗑️');
    }
}
