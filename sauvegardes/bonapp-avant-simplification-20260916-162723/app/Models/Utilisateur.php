<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';

    protected $fillable = [
        'role_id',
        'prenom',
        'nom',
        'email',
        'mot_de_passe_hash',
        'telephone',
        'statut',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function profilClient(): HasOne
    {
        return $this->hasOne(ProfilClient::class);
    }

    public function adresses(): HasMany
    {
        return $this->hasMany(Adresse::class);
    }

    public function recettes(): HasMany
    {
        return $this->hasMany(Recette::class, 'auteur_id');
    }

    public function favoris(): BelongsToMany
    {
        return $this->belongsToMany(Recette::class, 'favoris')->withTimestamps();
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(CollectionRecette::class);
    }

    public function planifications(): HasMany
    {
        return $this->hasMany(Planification::class);
    }
}
