<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListeCoursesItem extends Model
{
    protected $table = 'liste_courses_items';

    protected $fillable = ['liste_id', 'ingredient_id', 'unite_id', 'libelle', 'quantite', 'coche', 'ordre'];

    public function liste(): BelongsTo
    {
        return $this->belongsTo(ListeCourses::class, 'liste_id');
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
