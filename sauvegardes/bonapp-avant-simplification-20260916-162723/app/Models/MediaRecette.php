<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaRecette extends Model
{
    protected $table = 'medias_recette';

    protected $fillable = ['recette_id', 'url', 'type_media', 'texte_alternatif', 'principale'];

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class);
    }
}
