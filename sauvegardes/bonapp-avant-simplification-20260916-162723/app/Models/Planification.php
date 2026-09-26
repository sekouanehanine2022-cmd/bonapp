<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planification extends Model
{
    protected $fillable = ['utilisateur_id', 'nom', 'date_debut', 'date_fin'];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function repas(): HasMany
    {
        return $this->hasMany(RepasPlanifie::class);
    }

    public function listesCourses(): HasMany
    {
        return $this->hasMany(ListeCourses::class);
    }
}
