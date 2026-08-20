<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = [
    'type', 'titre', 'description', 'details', 'date_evenement', 'heure_evenement', 'image',
    'lieu', 'lien', 'categorie', 'tag', 'ordre',
];

protected $casts = [
    'date_evenement' => 'date',
];

    public function scopeAvenir($query)
    {
        return $query->where('type', 'avenir')->orderBy('ordre');
    }

    public function scopePasse($query)
    {
        return $query->where('type', 'passe')->orderBy('ordre');
    }
}