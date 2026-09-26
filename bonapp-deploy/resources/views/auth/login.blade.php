@extends('layouts.app')

@section('title', 'BonApp - Connexion')

@section('content')
    <main class="container py-5">
        <div class="mx-auto form-page">
            <h1 class="h2 fw-bold mb-2">Connexion</h1>
            <p class="text-muted">Connectez-vous avec votre adresse e-mail et votre mot de passe.</p>

            <form method="POST" action="{{ route('login.store') }}" class="row g-3">
                @csrf

                <div class="col-12">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="col-12 form-check ms-2">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label for="remember" class="form-check-label">Se souvenir de moi</label>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-dark w-100">Se connecter</button>
                </div>
            </form>
        </div>
    </main>
@endsection
