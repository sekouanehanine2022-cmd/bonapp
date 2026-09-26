@extends('layouts.app')

@section('title', 'Page introuvable')

@section('content')
    <main class="container py-5 text-center">
        <h1 class="display-5 fw-bold">Page introuvable</h1>
        <p class="text-muted">La page ou la recette demandée n’existe pas.</p>
        <a href="{{ route('recettes.index') }}" class="btn btn-dark">Voir les recettes</a>
    </main>
@endsection
