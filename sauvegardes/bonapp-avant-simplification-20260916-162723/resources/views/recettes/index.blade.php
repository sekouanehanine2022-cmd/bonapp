@extends('layouts.app')

@section('title', 'BonApp - Recettes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recettes.css') }}">
@endpush

@section('content')
    <section class="section-header-recettes">
        <div class="section-titre">
            <h1>Toutes nos Recettes</h1>
            <p>Recherchez un plat, filtrez selon vos envies et découvrez nos meilleures idées cuisine.</p>
        </div>

        <div class="conteneur-recherche">
            <input type="text" id="barreRecherche" class="barre-recherche" placeholder="Rechercher une recette...">
        </div>

        <div class="text-center">
            <a href="{{ route('recettes.create') }}" class="btn btn-light fw-semibold">
                <i class="fa-solid fa-plus me-2"></i>Ajouter une recette
            </a>
        </div>
    </section>

    <div class="categories-globales">
        @foreach (['tous' => 'Tous', 'Entrée' => 'Entrée', 'Plat' => 'Plat', 'Dessert' => 'Dessert', 'Soupe' => 'Soupe', 'Facile' => 'Facile', 'Petit-Déjeuner' => 'Petit Déjeuner', 'Viande' => 'Viande', 'Healthy' => 'Healthy', 'Boisson' => 'Boisson'] as $filtre => $label)
            <div class="categorie-item @if($filtre === 'tous') actif @endif" data-filtre="{{ $filtre }}">{{ $label }}</div>
        @endforeach
    </div>

    <section class="section-grille container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="grille-recettes">
            @forelse ($recettes as $recette)
                @php
                    $popup = [
                        'titre' => $recette->titre,
                        'ingredients' => $recette->ingredients,
                        'instructions' => $recette->instructions,
                        'image' => asset($recette->image),
                        'temps' => $recette->temps,
                        'personnes' => $recette->personnes,
                        'type' => $recette->type,
                        'niveau' => $recette->niveau,
                    ];
                @endphp

                <article class="carte-recette" data-type="{{ $recette->categories }}" data-recette="{{ base64_encode(json_encode($popup, JSON_UNESCAPED_UNICODE)) }}" tabindex="0">
                    <div class="badge-niveau {{ $recette->niveau }}">{{ ucfirst($recette->niveau) }}</div>
                    <img src="{{ asset($recette->image) }}" class="img-carte" alt="{{ $recette->titre }}">
                    <div class="contenu-carte">
                        <h3 class="titre-carte">{{ $recette->titre }}</h3>
                        <p class="description-carte">{{ $recette->description }}</p>
                        <div class="infos-carte">
                            <span>{{ $recette->temps }}</span>
                            <span>{{ $recette->personnes }}</span>
                            <span>{{ $recette->type }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-center text-muted grid-column-full">Aucune recette enregistrée pour le moment.</p>
            @endforelse
        </div>
    </section>

    <div id="popupRecette" class="popup-overlay">
        <div class="popup-fenetre">
            <span class="popup-fermer" onclick="fermerPopup()">×</span>
            <h2 id="popupTitre"></h2>
            <img id="popupImage" src="" alt="" class="popup-image">

            <div class="popup-infos"></div>

            <div class="popup-contenu">
                <div>
                    <h3>Ingrédients</h3>
                    <p id="popupIngredients"></p>
                </div>

                <div>
                    <h3>Instructions</h3>
                    <p id="popupInstructions"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const popup = document.getElementById('popupRecette');
        const categories = document.querySelectorAll('.categorie-item');
        const barreRecherche = document.getElementById('barreRecherche');
        let filtreActuel = 'tous';
        let cartes = document.querySelectorAll('.carte-recette');

        cartes.forEach((carte) => {
            const ouvrir = () => ouvrirPopupLaravel(JSON.parse(atob(carte.dataset.recette)));
            carte.addEventListener('click', ouvrir);
            carte.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    ouvrir();
                }
            });
        });

        categories.forEach((cat) => {
            cat.addEventListener('click', () => {
                categories.forEach((categorie) => categorie.classList.remove('actif'));
                cat.classList.add('actif');
                filtreActuel = cat.dataset.filtre;
                appliquerFiltreEtRecherche();
            });
        });

        barreRecherche.addEventListener('input', appliquerFiltreEtRecherche);

        function appliquerFiltreEtRecherche() {
            const texteRecherche = barreRecherche.value.toLowerCase();

            cartes.forEach((carte) => {
                const titre = carte.querySelector('.titre-carte').innerText.toLowerCase();
                const type = carte.dataset.type.toLowerCase();
                const correspondRecherche = titre.includes(texteRecherche);
                const correspondFiltre = filtreActuel === 'tous' || type.includes(filtreActuel.toLowerCase());

                carte.style.display = correspondRecherche && correspondFiltre ? 'block' : 'none';
            });
        }

        function ouvrirPopupLaravel(recette) {
            document.getElementById('popupTitre').innerText = recette.titre;
            document.getElementById('popupIngredients').innerText = recette.ingredients;
            document.getElementById('popupInstructions').innerText = recette.instructions;

            const popupImage = document.getElementById('popupImage');
            popupImage.src = recette.image;
            popupImage.alt = recette.titre;

            document.querySelector('.popup-infos').innerHTML = `
                <span>${recette.temps}</span>
                <span>${recette.personnes}</span>
                <span>${recette.type}</span>
                <span class="niveau ${recette.niveau}">${recette.niveau}</span>
            `;

            popup.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function fermerPopup() {
            popup.style.display = 'none';
            document.body.style.overflow = '';
        }

        popup.addEventListener('click', (event) => {
            if (event.target === popup) {
                fermerPopup();
            }
        });
    </script>
@endpush
