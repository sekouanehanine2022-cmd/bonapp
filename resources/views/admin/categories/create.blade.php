@extends('layouts.app')

@section('title', 'BonApp - Ajouter une catégorie')

@section('content')
    <main class="container py-5">
        <div class="mx-auto form-page">
            <h1 class="h2 fw-bold mb-4">Ajouter une catégorie</h1>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @include('admin.categories._form')
            </form>
        </div>
    </main>
@endsection
