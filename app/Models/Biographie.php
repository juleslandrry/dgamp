<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biographie extends Model
{
    protected $fillable = [
    'date_naissance',
    'lieu_naissance',
    'corps',
    'grade_classe',
    'fonction_actuelle',
    ];

    public function timelines()
    {
        return $this->hasMany(BiographieTimeline::class)->orderBy('ordre');
    }

    public function formations()
    {
        return $this->hasMany(BiographieFormation::class)->orderBy('ordre');
    }
}