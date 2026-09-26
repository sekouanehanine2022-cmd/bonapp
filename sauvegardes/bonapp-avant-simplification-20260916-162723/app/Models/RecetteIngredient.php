<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecetteIngredient extends Model
{
    protected $table = 'recette_ingredients';

    protected $fillable = ['recette_id', 'ingredient_id', 'unite_id', 'quantite', 'note', 'ordre'];

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class);
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(IngredientCatalogue::class, 'ingredient_id');
    }

    public function unite(): BelongsTo
    {
        return $this->belongsTo(Unite::class);
    }
}
