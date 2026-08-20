<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organigramme extends Model
{
    protected $fillable = [
        'directeur_titre',
        'organigramme_pdf',
        'decret_pdf',
    ];

    public function nodes(): HasMany
    {
        return $this->hasMany(OrganigrammeNode::class)
            ->whereNull('parent_id')
            ->orderBy('ordre');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(OrganigrammeDocument::class)
            ->orderBy('ordre');
    }
}