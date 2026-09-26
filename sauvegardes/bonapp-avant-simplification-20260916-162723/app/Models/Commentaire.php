<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commentaire extends Model
{
    protected $table = 'commentaires';

    protected $fillable = ['recette_id', 'utilisateur_id', 'parent_id', 'contenu', 'statut'];

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class);
    }

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function reponses(): HasMany
    {
        return $this->hasMany(Commentaire::class, 'parent_id');
    }
}
