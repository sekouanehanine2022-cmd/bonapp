<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngredientCatalogue extends Model
{
    protected $table = 'ingredients_catalogue';

    protected $fillable = ['nom', 'slug', 'type'];

    public function recettes(): HasMany
    {
        return $this->hasMany(RecetteIngredient::class, 'ingredient_id');
    }

    public function allergenes(): BelongsToMany
    {
        return $this->belongsToMany(Allergene::class, 'ingredient_allergenes', 'ingredient_id', 'allergene_id');
    }
}
