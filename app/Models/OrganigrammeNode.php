<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganigrammeNode extends Model
{
    protected $fillable = [
        'organigramme_id',
        'parent_id',
        'nom',
        'ordre',
    ];

    public function organigramme(): BelongsTo
    {
        return $this->belongsTo(Organigramme::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            OrganigrammeNode::class,
            'parent_id'
        );
    }

    public function enfants(): HasMany
    {
        return $this->hasMany(
            OrganigrammeNode::class,
            'parent_id'
        )->orderBy('ordre');
    }
}