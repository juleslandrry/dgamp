<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganigrammeDepartement extends Model
{
    protected $fillable = [
        'organigramme_id',
        'nom',
        'ordre',
    ];

    public function organigramme(): BelongsTo
    {
        return $this->belongsTo(Organigramme::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(OrganigrammeService::class)
            ->orderBy('ordre');
    }
}