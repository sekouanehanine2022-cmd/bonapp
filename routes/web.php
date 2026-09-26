<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

Route::get('/', AccueilController::class)->name('accueil');

Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');
Route::get('/recettes/{recette}', [RecetteController::class, 'show'])->name('recettes.show');

Route::middleware('guest')->group(function (): void {
    Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])
    ->prefix('administration')
    ->name('admin.')
    ->group(function (): void {
        Route::get('/', [RecetteController::class, 'adminIndex'])->name('recettes.index');
        Route::get('/recettes/ajouter', [RecetteController::class, 'create'])->name('recettes.create');
        Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
        Route::get('/recettes/{recette}/modifier', [RecetteController::class, 'edit'])->name('recettes.edit');
        Route::put('/recettes/{recette}', [RecetteController::class, 'update'])->name('recettes.update');
        Route::delete('/recettes/{recette}', [RecetteController::class, 'destroy'])->name('recettes.destroy');

        Route::resource('categories', CategorieController::class)
            ->except(['show'])
            ->parameters(['categories' => 'categorie']);
    });
