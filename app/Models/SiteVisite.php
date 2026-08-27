<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisite extends Model
{
    protected $table = 'site_visites';

    protected $fillable = [
        'pays', 'ville', 'date_visite', 'vues',
    ];

    protected $casts = [
        'date_visite' => 'date',
    ];
}