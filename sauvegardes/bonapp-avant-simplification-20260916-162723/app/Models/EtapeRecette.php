<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EtapeRecette extends Model
{
    protected $table = 'etapes_recette';

    protected $fillable = ['recette_id', 'numero', 'description', 'duree_min'];

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class);
    }
}
