<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MissionsObjectifs extends Model
{
    protected $fillable = [
        'missions_titre',
        'objectifs_titre',
    ];

    public function cartes(): HasMany
    {
        return $this->hasMany(MissionsObjectifsCarte::class, 'missions_objectifs_id')
            ->orderBy('ordre');
    }

    public function missions(): HasMany
    {
        return $this->hasMany(MissionsObjectifsCarte::class, 'missions_objectifs_id')
            ->where('type', 'mission')
            ->orderBy('ordre');
    }

    public function objectifs(): HasMany
    {
        return $this->hasMany(MissionsObjectifsCarte::class, 'missions_objectifs_id')
            ->where('type', 'objectif')
            ->orderBy('ordre');
    }
}
