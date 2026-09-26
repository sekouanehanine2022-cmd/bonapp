<?php

use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');
Route::get('/recettes/ajouter', [RecetteController::class, 'create'])->name('recettes.create');
Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
Route::get('/api/recettes', [RecetteController::class, 'api'])->name('recettes.api');

Route::view('/planificateur', 'planificateur')->name('planificateur');
Route::view('/contact', 'contact')->name('contact');
Route::view('/diagramme-classe', 'diagramme-classe')->name('diagramme-classe');
