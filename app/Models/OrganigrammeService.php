<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganigrammeService extends Model
{
    protected $fillable = [
        'departement_id',
        'nom',
        'ordre',
    ];

    public function departement(): BelongsTo
    {
        return $this->belongsTo(OrganigrammeDepartement::class);
    }
}