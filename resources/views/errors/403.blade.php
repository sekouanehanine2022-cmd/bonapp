@extends('layouts.app')

@section('title', 'Accès interdit')

@section('content')
    <main class="container py-5 text-center">
        <h1 class="display-5 fw-bold">Accès interdit</h1>
        <p class="text-muted">Vous n’avez pas l’autorisation d’accéder à cette page.</p>
        <a href="{{ route('accueil') }}" class="btn btn-dark">Retour à l’accueil</a>
    </main>
@endsection
