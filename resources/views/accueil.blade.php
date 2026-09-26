@extends('layouts.app')

@section('title', 'BonApp - Accueil')

@section('content')
    <section class="section-accueil">
        <div class="texte-sur-image text-center">
            <img src="{{ asset('image/logo_cuisine.png') }}" alt="Logo BonApp" class="logo-accueil mb-3">
            <h1>BonApp</h1>
            <p>Une application Laravel simple pour consulter et gérer des recettes de cuisine.</p>
            <a href="{{ route('recettes.index') }}" class="btn btn-light fw-semibold">
                <i class="fa-solid fa-utensils me-2"></i>Découvrir les recettes
            </a>
        </div>
    </section>

    <main class="container py-5">
        <div class="text-center mb-4">
            <h2 class="titre-section">Recettes mises en avant</h2>
            <p class="sous-titre-section">Quelques idées pour commencer simplement.</p>
        </div>

        <div class="grille-recettes">
            @forelse ($recettes as $recette)
                <article class="carte-recette">
                    <span class="badge-niveau {{ $recette->difficulte }}">{{ ucfirst($recette->difficulte) }}</span>
                    <img src="{{ $recette->image_url }}" class="img-carte" alt="{{ $recette->titre }}">
                    <div class="contenu-carte">
                        <h3 class="titre-carte">{{ $recette->titre }}</h3>
                        <p class="description-carte">{{ $recette->description }}</p>
                        <div class="infos-carte">
                            <span>{{ $recette->categorie->nom }}</span>
                            <span>{{ $recette->temps_preparation }} min</span>
                        </div>
                        <a href="{{ route('recettes.show', $recette) }}" class="btn btn-dark w-100 mt-3">Voir la recette</a>
                    </div>
                </article>
            @empty
                <p class="text-center text-muted grid-column-full">Aucune recette publiée pour le moment.</p>
            @endforelse
        </div>
    </main>
@endsection
