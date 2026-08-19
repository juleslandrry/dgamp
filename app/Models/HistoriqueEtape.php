<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueEtape extends Model
{
    protected $fillable = [
        'historique_id',
        'date',
        'description',
        'ordre',
    ];

    public function historique(): BelongsTo
    {
        return $this->belongsTo(Historique::class);
    }
}