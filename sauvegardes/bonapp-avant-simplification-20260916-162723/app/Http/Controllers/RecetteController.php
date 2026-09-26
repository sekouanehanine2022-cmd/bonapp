<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Recette;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RecetteController extends Controller
{
    public function index(): View
    {
        $recettes = Recette::query()
            ->withAvg('avis', 'note')
            ->withCount('avis')
            ->where('statut', 'publiee')
            ->orderBy('id')
            ->get();

        return view('recettes.index', compact('recettes'));
    }

    public function create(): View
    {
        return view('recettes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'temps' => ['required', 'string', 'max:50'],
            'personnes' => ['required', 'string', 'max:50'],
            'type' => ['required', 'string', 'max:80'],
            'niveau' => ['required', 'in:facile,moyen,difficile'],
            'categories' => ['required', 'string', 'max:255'],
        ]);

        $recette = Recette::create([
            ...$data,
            'auteur_id' => 1,
            'slug' => $this->uniqueSlug($data['titre']),
            'image' => $data['image'] ?: 'image/recette1.jpg',
            'statut' => 'publiee',
        ]);

        $this->syncCategories($recette, $data['categories'] . ' ' . $data['type']);

        return redirect()
            ->route('recettes.index')
            ->with('success', 'Recette ajoutée avec succès.');
    }

    public function api(): JsonResponse
    {
        $recettes = Recette::query()
            ->withAvg('avis', 'note')
            ->withCount('avis')
            ->where('statut', 'publiee')
            ->orderBy('id')
            ->get();

        return response()->json([
            'success' => true,
            'recettes' => $recettes,
        ]);
    }

    private function uniqueSlug(string $titre): string
    {
        $base = Str::slug($titre) ?: 'recette';
        $slug = $base;
        $suffix = 2;

        while (Recette::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }

    private function syncCategories(Recette $recette, string $source): void
    {
        $source = Str::of($source)->ascii()->lower()->value();

        $ids = Categorie::query()
            ->get()
            ->filter(function (Categorie $categorie) use ($source): bool {
                return str_contains($source, Str::of($categorie->nom)->ascii()->lower()->value())
                    || str_contains($source, Str::of($categorie->slug)->ascii()->lower()->value());
            })
            ->pluck('id')
            ->all();

        $recette->categoriesRelation()->sync($ids);
    }
}
