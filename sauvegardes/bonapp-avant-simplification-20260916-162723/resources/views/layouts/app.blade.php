<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BonApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/acceuil.css') }}">
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
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('planificateur')) active @endif" href="{{ route('planificateur') }}">Planificateur</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('contact')) active @endif" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('diagramme-classe')) active @endif" href="{{ route('diagramme-classe') }}">Diagramme</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">BonApp</h5>
                    <p>Découvrez des recettes faciles, rapides et délicieuses faites pour tous les gourmands.</p>
                </div>

                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Liens utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('accueil') }}" class="footer-link">Accueil</a></li>
                        <li><a href="{{ route('recettes.index') }}" class="footer-link">Recettes</a></li>
                        <li><a href="{{ route('planificateur') }}" class="footer-link">Planificateur</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">Contact</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Suivez-nous</h5>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/" class="footer-social" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook fa-xl"></i></a>
                        <a href="https://www.instagram.com/" class="footer-social" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram fa-xl"></i></a>
                        <a href="https://www.tiktok.com/" class="footer-social" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-tiktok fa-xl"></i></a>
                        <a href="https://www.youtube.com/" class="footer-social" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube fa-xl"></i></a>
                    </div>
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
