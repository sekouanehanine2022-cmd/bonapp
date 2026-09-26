<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;
use App\Models\Categorie;
use App\Models\Recette;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class RecetteController extends Controller
{
    public function index(): View
    {
        $recettes = Recette::query()
            ->with('categorie')
            ->where('statut', 'publiee')
            ->latest()
            ->get();
        $categories = Categorie::query()->orderBy('nom')->get();

        return view('recettes.index', compact('recettes', 'categories'));
    }

    public function show(Recette $recette): View
    {
        abort_unless($recette->statut === 'publiee', 404);

        $recette->load('categorie');

        return view('recettes.show', compact('recette'));
    }

    public function adminIndex(): View
    {
        $recettes = Recette::query()
            ->with('categorie')
            ->latest()
            ->get();

        return view('admin.recettes.index', compact('recettes'));
    }

    public function create(): View
    {
        return view('admin.recettes.create', [
            'recette' => new Recette(['statut' => 'brouillon', 'difficulte' => 'facile']),
            'categories' => Categorie::query()->orderBy('nom')->get(),
        ]);
    }

    public function store(StoreRecetteRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $data['image'] = $this->enregistrerImage($request->file('image'));
        }

        Recette::create($data);

        return redirect()
            ->route('admin.recettes.index')
            ->with('success', 'Recette ajoutée avec succès.');
    }

    public function edit(Recette $recette): View
    {
        return view('admin.recettes.edit', [
            'recette' => $recette,
            'categories' => Categorie::query()->orderBy('nom')->get(),
        ]);
    }

    public function update(UpdateRecetteRequest $request, Recette $recette): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->supprimerImage($recette);
            $data['image'] = $this->enregistrerImage($request->file('image'));
        }

        $recette->update($data);

        return redirect()
            ->route('admin.recettes.index')
            ->with('success', 'Recette modifiée avec succès.');
    }

    public function destroy(Recette $recette): RedirectResponse
    {
        $this->supprimerImage($recette);
        $recette->delete();

        return redirect()
            ->route('admin.recettes.index')
            ->with('success', 'Recette supprimée avec succès.');
    }

    private function enregistrerImage(UploadedFile $fichier): string
    {
        $nom = $fichier->hashName();
        $fichier->move(public_path('image/recettes'), $nom);

        return 'image/recettes/'.$nom;
    }

    private function supprimerImage(Recette $recette): void
    {
        if ($recette->image && str_starts_with($recette->image, 'image/recettes/')) {
            File::delete(public_path($recette->image));
        }
    }
}
