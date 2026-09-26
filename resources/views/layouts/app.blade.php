<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BonApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/acceuil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/recettes.css') }}">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('accueil') }}">
                <img src="{{ asset('image/logo_cuisine.png') }}" alt="Logo BonApp" class="logo">
                <span class="nom-site ms-2">BonApp</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav" aria-controls="menuNav" aria-expanded="false" aria-label="Ouvrir le menu de navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('accueil')) active @endif" href="{{ route('accueil') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('recettes.*')) active @endif" href="{{ route('recettes.index') }}">Recettes</a></li>

                    @auth
                        @can('administrer')
                            <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.*')) active @endif" href="{{ route('admin.recettes.index') }}">Administration</a></li>
                        @endcan
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-2">
                    @guest
                        <a class="btn btn-dark btn-sm" href="{{ route('login') }}">Connexion</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark btn-sm">Déconnexion</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container mt-4">
            <div class="alert alert-success mb-0">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="container mt-4">
            <div class="alert alert-danger mb-0">
                <p class="fw-semibold mb-2">Merci de corriger les erreurs suivantes :</p>
                <ul class="mb-0">
                    @foreach ($errors->all() as $erreur)
                        <li>{{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="footer bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold">BonApp</h5>
                    <p>Découvrez des recettes simples, rapides et faciles à gérer avec Laravel.</p>
                </div>

                <div class="col-md-3 mb-3">
                    <h5 class="fw-bold">Navigation</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('accueil') }}" class="footer-link">Accueil</a></li>
                        <li><a href="{{ route('recettes.index') }}" class="footer-link">Recettes</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3">
                    <h5 class="fw-bold">Projet</h5>
                    <p class="mb-0">Support de dossier professionnel CDA.</p>
                </div>
            </div>

            <hr class="border-light">

            <div class="text-center">
                <p class="mb-0">© 2026 BonApp - Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
