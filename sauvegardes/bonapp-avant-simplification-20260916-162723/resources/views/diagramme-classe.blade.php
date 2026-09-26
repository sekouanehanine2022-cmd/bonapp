@extends('layouts.app')

@section('title', 'BonApp - Diagramme de classe')

@section('content')
    <main class="container-fluid py-4">
        <iframe src="{{ asset('docs/diagramme_classe_bonapp.html') }}" title="Diagramme de classe BonApp" style="width: 100%; min-height: 80vh; border: 0;"></iframe>
    </main>
@endsection
