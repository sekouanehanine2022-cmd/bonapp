@extends('layouts.app')

@section('title', 'BonApp - Ajouter une recette')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recettes.css') }}">
@endpush

@section('content')
    <main class="container py-5">
        <div class="mx-auto" style="max-width: 900px;">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4 flex-wrap">
                <div>
                    <h1 class="h2 fw-bold mb-1">Ajouter une recette</h1>
                    <p class="text-muted mb-0">La recette sera enregistrée par Laravel dans MySQL.</p>
                </div>
                <a href="{{ route('recettes.index') }}" class="btn btn-outline-dark">
                    <i class="fa-solid fa-arrow-left me-2"></i>Retour
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">Vérifie les champs du formulaire.</div>
            @endif

            <form method="POST" action="{{ route('recettes.store') }}" class="row g-3">
                @csrf

                <div class="col-md-8">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="temps" class="form-label">Temps</label>
                    <input type="text" class="form-control" id="temps" name="temps" value="{{ old('temps') }}" placeholder="30 min" required>
                </div>

                <div class="col-md-6">
                    <label for="personnes" class="form-label">Personnes</label>
                    <input type="text" class="form-control" id="personnes" name="personnes" value="{{ old('personnes') }}" placeholder="4 personnes" required>
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="image/recette1.jpg">
                </div>

                <div class="col-md-4">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        @foreach (['Entrée', 'Plat', 'Dessert', 'Soupe', 'Petit Déjeuner', 'Viande', 'Boisson'] as $type)
                            <option value="{{ $type }}" @selected(old('type') === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="niveau" class="form-label">Niveau</label>
                    <select class="form-select" id="niveau" name="niveau" required>
                        <option value="facile" @selected(old('niveau') === 'facile')>Facile</option>
                        <option value="moyen" @selected(old('niveau') === 'moyen')>Moyen</option>
                        <option value="difficile" @selected(old('niveau') === 'difficile')>Difficile</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="categories" class="form-label">Catégories</label>
                    <input type="text" class="form-control" id="categories" name="categories" value="{{ old('categories') }}" placeholder="Plat Facile Healthy" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="2" required>{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="ingredients" class="form-label">Ingrédients</label>
                    <textarea class="form-control" id="ingredients" name="ingredients" rows="8" required>{{ old('ingredients') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="instructions" class="form-label">Instructions</label>
                    <textarea class="form-control" id="instructions" name="instructions" rows="8" required>{{ old('instructions') }}</textarea>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
