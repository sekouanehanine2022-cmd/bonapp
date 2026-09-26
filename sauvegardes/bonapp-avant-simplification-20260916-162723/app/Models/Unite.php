<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unite extends Model
{
    public $timestamps = false;

    protected $fillable = ['nom', 'abreviation'];

    public function recetteIngredients(): HasMany
    {
        return $this->hasMany(RecetteIngredient::class);
    }
}
