<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CollectionRecette extends Model
{
    protected $table = 'collections';

    protected $fillable = ['utilisateur_id', 'nom', 'description', 'visibilite'];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function recettes(): BelongsToMany
    {
        return $this->belongsToMany(Recette::class, 'collection_recettes', 'collection_id', 'recette_id')->withTimestamps();
    }
}
