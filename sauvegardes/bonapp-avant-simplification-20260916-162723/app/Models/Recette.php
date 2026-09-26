<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recette extends Model
{
    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'ingredients',
        'instructions',
        'image',
        'temps',
        'personnes',
        'type',
        'niveau',
        'categories',
        'temps_preparation_min',
        'temps_cuisson_min',
        'portions',
        'cout_estime',
        'statut',
    ];

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'auteur_id');
    }

    public function categoriesRelation(): BelongsToMany
    {
        return $this->belongsToMany(Categorie::class, 'recette_categories');
    }

    public function ingredientsRelation(): HasMany
    {
        return $this->hasMany(RecetteIngredient::class);
    }

    public function etapes(): HasMany
    {
        return $this->hasMany(EtapeRecette::class)->orderBy('numero');
    }

    public function medias(): HasMany
    {
        return $this->hasMany(MediaRecette::class);
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }
}
