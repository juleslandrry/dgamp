<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Historique extends Model
{
    protected $fillable = [
        'intro',
    ];

    public function etapes(): HasMany
    {
        return $this->hasMany(HistoriqueEtape::class)
            ->orderBy('ordre');
    }
}