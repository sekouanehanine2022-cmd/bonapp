@extends('layouts.app')

@section('title', 'BonApp - Administration des recettes')

@section('content')
    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-4">
            <div>
                <h1 class="h2 fw-bold mb-1">Administration des recettes</h1>
                <p class="text-muted mb-0">Ajoutez, modifiez ou supprimez les recettes de BonApp.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark">Catégories</a>
                <a href="{{ route('admin.recettes.create') }}" class="btn btn-dark">
                    <i class="fa-solid fa-plus me-2"></i>Ajouter
                </a>
            </div>
        </div>

        <div class="table-responsive admin-table">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Difficulté</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recettes as $recette)
                        <tr>
                            <td><img src="{{ $recette->image_url }}" alt="{{ $recette->titre }}" class="admin-miniature"></td>
                            <td>{{ $recette->titre }}</td>
                            <td>{{ $recette->categorie->nom }}</td>
                            <td>{{ ucfirst($recette->difficulte) }}</td>
                            <td>{{ $recette->statut === 'publiee' ? 'Publiée' : 'Brouillon' }}</td>
                            <td>{{ $recette->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.recettes.edit', $recette) }}" class="btn btn-sm btn-outline-dark">Modifier</a>
                                <form method="POST" action="{{ route('admin.recettes.destroy', $recette) }}" class="d-inline" onsubmit="return confirm('Supprimer cette recette ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucune recette enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection
