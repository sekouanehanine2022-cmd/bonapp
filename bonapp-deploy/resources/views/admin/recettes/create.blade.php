@extends('layouts.app')

@section('title', 'BonApp - Ajouter une recette')

@section('content')
    <main class="container py-5">
        <div class="mx-auto form-page-large">
            <h1 class="h2 fw-bold mb-4">Ajouter une recette</h1>
            <form method="POST" action="{{ route('admin.recettes.store') }}" enctype="multipart/form-data">
                @include('admin.recettes._form')
            </form>
        </div>
    </main>
@endsection
