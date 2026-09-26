<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilClient extends Model
{
    protected $table = 'profils_clients';
    protected $primaryKey = 'utilisateur_id';
    public $incrementing = false;

    protected $fillable = ['utilisateur_id', 'date_naissance', 'niveau_cuisine', 'bio', 'preferences_alimentaires'];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
