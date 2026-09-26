@csrf

@if ($categorie->exists)
    @method('PUT')
@endif

<div class="row g-3">
    <div class="col-12">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $categorie->nom) }}" required>
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $categorie->description) }}">
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark">Annuler</a>
    <button type="submit" class="btn btn-dark">Enregistrer</button>
</div>
