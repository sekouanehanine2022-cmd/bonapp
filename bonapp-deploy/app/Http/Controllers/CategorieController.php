<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategorieController extends Controller
{
    public function index(): View
    {
        $categories = Categorie::query()
            ->withCount('recettes')
            ->orderBy('nom')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create', ['categorie' => new Categorie()]);
    }

    public function store(CategorieRequest $request): RedirectResponse
    {
        Categorie::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function edit(Categorie $categorie): View
    {
        return view('admin.categories.edit', compact('categorie'));
    }

    public function update(CategorieRequest $request, Categorie $categorie): RedirectResponse
    {
        $categorie->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Categorie $categorie): RedirectResponse
    {
        if ($categorie->recettes()->exists()) {
            return back()->withErrors('Cette catégorie est utilisée par une recette et ne peut pas être supprimée.');
        }

        $categorie->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
