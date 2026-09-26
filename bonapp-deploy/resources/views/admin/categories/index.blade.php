@extends('layouts.app')

@section('title', 'BonApp - Catégories')

@section('content')
    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-4">
            <div>
                <h1 class="h2 fw-bold mb-1">Catégories</h1>
                <p class="text-muted mb-0">Gérez les catégories utilisées par les recettes.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.recettes.index') }}" class="btn btn-outline-dark">Recettes</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-dark">Ajouter</a>
            </div>
        </div>

        <div class="table-responsive admin-table">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Recettes</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $categorie)
                        <tr>
                            <td>{{ $categorie->nom }}</td>
                            <td>{{ $categorie->description }}</td>
                            <td>{{ $categorie->recettes_count }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $categorie) }}" class="btn btn-sm btn-outline-dark">Modifier</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $categorie) }}" class="d-inline" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" @disabled($categorie->recettes_count > 0)>Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Aucune catégorie enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection
