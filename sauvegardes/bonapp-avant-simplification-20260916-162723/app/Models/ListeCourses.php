<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListeCourses extends Model
{
    protected $table = 'listes_courses';

    protected $fillable = ['utilisateur_id', 'planification_id', 'nom', 'statut'];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function planification(): BelongsTo
    {
        return $this->belongsTo(Planification::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ListeCoursesItem::class, 'liste_id');
    }
}
