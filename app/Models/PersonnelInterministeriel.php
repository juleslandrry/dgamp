<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonnelInterministeriel extends Model
{
    protected $table = 'personnel_interministeriels';

    protected $fillable = [
        'badge', 'titre', 'hero_description', 'hero_image',
        'section_titre', 'section_texte', 'section_image', 'section_points',
    ];

    protected $casts = [
        'section_points' => 'array',
    ];
}