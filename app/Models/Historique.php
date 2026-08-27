<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\HistoriqueEtape;
class Historique extends Model
{
    protected $fillable = [
        'intro',
        'image1',
        'image2',
        'image3'
    ];

    public function etapes(): HasMany
    {
        return $this->hasMany(HistoriqueEtape::class)
            ->orderBy('ordre');
    }
}