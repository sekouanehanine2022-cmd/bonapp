@extends('layouts.app')

@section('title', 'BonApp - Accueil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recettes.css') }}">
@endpush

@section('content')
    <section class="section-header-recettes">
        <div class="section-titre">
            <h1>BonApp</h1>
            <p>Un projet Laravel pour gérer des recettes, des clients, des favoris, des avis et des menus.</p>
        </div>

        <div class="text-center">
            <a href="{{ route('recettes.index') }}" class="btn btn-light fw-semibold">
                <i class="fa-solid fa-utensils me-2"></i>Voir les recettes
            </a>
        </div>
    </section>

    <main class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <h2 class="h4 fw-bold">Recettes</h2>
                <p class="text-muted">Les recettes sont stockées en base MySQL et servies par Laravel.</p>
            </div>
            <div class="col-md-4">
                <h2 class="h4 fw-bold">Clients</h2>
                <p class="text-muted">Le modèle inclut rôles, profils clients, adresses, allergies et préférences.</p>
            </div>
            <div class="col-md-4">
                <h2 class="h4 fw-bold">Organisation</h2>
                <p class="text-muted">Favoris, collections, planification des repas et listes de courses sont prévus.</p>
            </div>
        </div>
    </main>
@endsection
