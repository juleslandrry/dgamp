<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganigrammeDocument extends Model
{
    protected $fillable = [
        'organigramme_id',
        'titre',
        'type',
        'fichier',
        'bouton',
        'ordre',
    ];

    public function organigramme(): BelongsTo
    {
        return $this->belongsTo(Organigramme::class);
    }
}