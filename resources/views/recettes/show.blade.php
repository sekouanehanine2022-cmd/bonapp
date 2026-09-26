@extends('layouts.app')

@section('title', 'BonApp - '.$recette->titre)

@section('content')
    <main class="container py-5">
        <article class="detail-recette">
            <img src="{{ $recette->image_url }}" alt="{{ $recette->titre }}" class="detail-recette__image">

            <div class="detail-recette__contenu">
                <a href="{{ route('recettes.index') }}" class="btn btn-outline-dark mb-4">
                    <i class="fa-solid fa-arrow-left me-2"></i>Retour aux recettes
                </a>

                <h1 class="fw-bold">{{ $recette->titre }}</h1>

                <div class="detail-recette__meta">
                    <span>{{ $recette->categorie->nom }}</span>
                    <span>{{ ucfirst($recette->difficulte) }}</span>
                    <span>{{ $recette->temps_preparation }} min</span>
                    <span>{{ $recette->nombre_personnes }} personne(s)</span>
                </div>

                <p class="lead">{{ $recette->description }}</p>

                <div class="row g-4 mt-3">
                    <div class="col-md-5">
                        <h2 class="h4 fw-bold">Ingrédients</h2>
                        <p class="texte-recette">{{ $recette->ingredients }}</p>
                    </div>
                    <div class="col-md-7">
                        <h2 class="h4 fw-bold">Instructions</h2>
                        <p class="texte-recette">{{ $recette->instructions }}</p>
                    </div>
                </div>
            </div>
        </article>
    </main>
@endsection
