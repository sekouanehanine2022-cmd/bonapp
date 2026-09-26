<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepasPlanifie extends Model
{
    protected $table = 'repas_planifies';

    protected $fillable = ['planification_id', 'recette_id', 'date_repas', 'type_repas', 'portions'];

    public function planification(): BelongsTo
    {
        return $this->belongsTo(Planification::class);
    }

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class);
    }
}
