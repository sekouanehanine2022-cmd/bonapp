<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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
        if (! $this->image) {
            return asset('image/recette1.jpg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://', 'image/'])) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }
}
