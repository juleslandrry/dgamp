<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionsObjectifsCarte extends Model
{
    protected $fillable = [
        'missions_objectifs_id',
        'type',
        'titre',
        'description',
        'ordre',
    ];

    public function missionsObjectifs(): BelongsTo
    {
        return $this->belongsTo(
            MissionsObjectifs::class,
            'missions_objectifs_id'
        );
    }
}
