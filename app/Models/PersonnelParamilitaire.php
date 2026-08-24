<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonnelParamilitaire extends Model
{
    protected $table = 'personnel_paramilitaires';

    protected $fillable = [
        'badge', 'titre', 'hero_description', 'hero_image',
        'section_titre', 'section_texte', 'section_image', 'section_points',
    ];

    protected $casts = [
        'section_points' => 'array',
    ];
}