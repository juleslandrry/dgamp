<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VieAssociativePage extends Model
{
    protected $fillable = [
        'type', 'badge', 'titre', 'lead',
        'intro_titre', 'intro_texte', 'intro_image',
    ];

    public function cards()
    {
        return $this->hasMany(VieAssociativeCard::class)->orderBy('ordre');
    }
}