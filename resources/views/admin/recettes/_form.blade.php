@csrf

@if ($recette->exists)
    @method('PUT')
@endif

<div class="row g-3">
    <div class="col-md-8">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $recette->titre) }}" required>
    </div>

    <div class="col-md-4">
        <label for="categorie_id" class="form-label">Catégorie</label>
        <select class="form-select" id="categorie_id" name="categorie_id" required>
            <option value="">Choisir une catégorie</option>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}" @selected((int) old('categorie_id', $recette->categorie_id) === $categorie->id)>
                    {{ $categorie->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="temps_preparation" class="form-label">Temps de préparation</label>
        <input type="number" min="1" class="form-control" id="temps_preparation" name="temps_preparation" value="{{ old('temps_preparation', $recette->temps_preparation) }}" required>
    </div>

    <div class="col-md-4">
        <label for="nombre_personnes" class="form-label">Nombre de personnes</label>
        <input type="number" min="1" class="form-control" id="nombre_personnes" name="nombre_personnes" value="{{ old('nombre_personnes', $recette->nombre_personnes) }}" required>
    </div>

    <div class="col-md-4">
        <label for="difficulte" class="form-label">Difficulté</label>
        <select class="form-select" id="difficulte" name="difficulte" required>
            <option value="facile" @selected(old('difficulte', $recette->difficulte) === 'facile')>Facile</option>
            <option value="moyen" @selected(old('difficulte', $recette->difficulte) === 'moyen')>Moyen</option>
            <option value="difficile" @selected(old('difficulte', $recette->difficulte) === 'difficile')>Difficile</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="statut" class="form-label">Statut</label>
        <select class="form-select" id="statut" name="statut" required>
            <option value="brouillon" @selected(old('statut', $recette->statut) === 'brouillon')>Brouillon</option>
            <option value="publiee" @selected(old('statut', $recette->statut) === 'publiee')>Publiée</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
        @if ($recette->image)
            <p class="form-text mb-0">Image actuelle conservée si aucun fichier n’est choisi.</p>
        @endif
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $recette->description) }}</textarea>
    </div>

    <div class="col-md-6">
        <label for="ingredients" class="form-label">Ingrédients</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="8" required>{{ old('ingredients', $recette->ingredients) }}</textarea>
    </div>

    <div class="col-md-6">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="8" required>{{ old('instructions', $recette->instructions) }}</textarea>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.recettes.index') }}" class="btn btn-outline-dark">Annuler</a>
    <button type="submit" class="btn btn-dark">Enregistrer</button>
</div>
