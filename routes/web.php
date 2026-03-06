<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\AdminAnimalController;
use App\Http\Controllers\Admin\AdminVideoController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/animales', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animales/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');

Route::get('/juegos', [GameController::class, 'index'])->name('games.index');
Route::get('/juegos/memoria', [GameController::class, 'memory'])->name('games.memory');
Route::get('/juegos/quiz', [GameController::class, 'quiz'])->name('games.quiz');

Route::middleware('auth')->group(function () {
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::post('/favoritos/video/{video}', [FavoriteController::class, 'toggleVideo'])
        ->name('favorites.video.toggle');

    Route::post('/favoritos/animal/{animal}', [FavoriteController::class, 'toggleAnimal'])
        ->name('favorites.animal.toggle');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('animales', AdminAnimalController::class)
            ->parameters(['animales' => 'animal'])
            ->names('animals');

        Route::resource('videos', AdminVideoController::class)
            ->parameters(['videos' => 'video']); // opcional, pero consistente
    });
require __DIR__.'/auth.php';
