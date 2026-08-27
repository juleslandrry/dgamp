<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'telephone',
        'boite_postale',
        'email',
        'adresse',
        'lien_maps',
        'facebook',
        'twitter',
        'youtube',
        'linkedin',
        'logo_principal',
        'logo_connexion',
        'favicon'
    ];
}
