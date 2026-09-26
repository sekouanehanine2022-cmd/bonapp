<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergene extends Model
{
    public $timestamps = false;

    protected $fillable = ['nom', 'description'];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(IngredientCatalogue::class, 'ingredient_allergenes', 'allergene_id', 'ingredient_id');
    }

    public function utilisateurs(): BelongsToMany
    {
        return $this->belongsToMany(Utilisateur::class, 'utilisateur_allergenes');
    }
}
