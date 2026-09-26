@extends('layouts.app')

@section('title', 'BonApp - Recettes')

@section('content')
    {{-- en-tete de la page avec la barre de recherche --}}
    <section class="section-header-recettes">
        <div class="section-titre">
            <h1>Toutes nos recettes</h1>
            <p>Recherchez un plat, filtrez par catégorie et trouvez une idée de repas.</p>
        </div>

        <div class="conteneur-recherche">
            <input type="text" id="barreRecherche" class="barre-recherche" placeholder="Rechercher une recette...">
        </div>
    </section>

    {{-- boutons des categories --}}
    <div class="categories-globales">
        <button type="button" class="categorie-item actif" data-filtre="tous">Tous</button>
        @foreach ($categories as $categorie)
            <button type="button" class="categorie-item" data-filtre="{{ $categorie->id }}">{{ $categorie->nom }}</button>
        @endforeach
    </div>

    {{-- liste des recettes --}}
    <section class="section-grille container">
        <div class="grille-recettes">
            {{-- boucle pour afficher une carte par recette --}}
            @forelse ($recettes as $recette)
                <article class="carte-recette" data-categorie="{{ $recette->categorie_id }}" data-titre="{{ \Illuminate\Support\Str::lower($recette->titre) }}">
                    <span class="badge-niveau {{ $recette->difficulte }}">{{ ucfirst($recette->difficulte) }}</span>
                    <img src="{{ $recette->image_url }}" class="img-carte" alt="{{ $recette->titre }}">
                    <div class="contenu-carte">
                        <h2 class="titre-carte">{{ $recette->titre }}</h2>
                        <p class="description-carte">{{ $recette->description }}</p>
                        <div class="infos-carte">
                            <span>{{ $recette->categorie->nom }}</span>
                            <span>{{ $recette->temps_preparation }} min</span>
                        </div>
                        <a href="{{ route('recettes.show', $recette) }}" class="btn btn-dark w-100 mt-3">Voir la recette</a>
                    </div>
                </article>
            @empty
                {{-- si il n'y a pas de recette --}}
                <p class="text-center text-muted grid-column-full">Aucune recette publiée pour le moment.</p>
            @endforelse
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // je recupere les elements de la page
        const barreRecherche = document.getElementById('barreRecherche');
        const boutonsCategories = document.querySelectorAll('.categorie-item');
        const cartes = document.querySelectorAll('.carte-recette');
        let filtreActuel = 'tous';

        // fonction pour afficher ou cacher les cartes
        function appliquerFiltres() {
            const recherche = barreRecherche.value.trim().toLowerCase();

            cartes.forEach((carte) => {
                // on verifie le titre et la categorie
                const correspondRecherche = carte.dataset.titre.includes(recherche);
                const correspondCategorie = filtreActuel === 'tous' || carte.dataset.categorie === filtreActuel;
                carte.style.display = correspondRecherche && correspondCategorie ? '' : 'none';
            });
        }

        // quand on clique sur une categorie
        boutonsCategories.forEach((bouton) => {
            bouton.addEventListener('click', () => {
                boutonsCategories.forEach((item) => item.classList.remove('actif'));
                bouton.classList.add('actif');
                filtreActuel = bouton.dataset.filtre;
                appliquerFiltres();
            });
        });

        // quand on ecrit dans la barre de recherche
        barreRecherche.addEventListener('input', appliquerFiltres);
    </script>
@endpush
