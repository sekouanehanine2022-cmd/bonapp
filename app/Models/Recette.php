<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categorie_id',
        'titre',
        'description',
        'ingredients',
        'instructions',
        'image',
        'temps_preparation',
        'nombre_personnes',
        'difficulte',
        'statut',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset($this->image ?: 'image/logo_cuisine.png');
    }
}
