<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\View\View;

class AccueilController extends Controller
{
    public function __invoke(): View
    {
        $recettes = Recette::query()
            ->with('categorie')
            ->where('statut', 'publiee')
            ->latest()
            ->take(3)
            ->get();

        return view('accueil', compact('recettes'));
    }
}
