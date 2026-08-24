<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalerieAlbum extends Model
{
    protected $table = 'galerie_albums';

    protected $fillable = [
        'album_id',
        'titre',
        'date',
        'popup_titre',
        'popup_sous',
        'cover',
        'photos',
        'ordre',
    ];

    protected $casts = [
        'photos' => 'array',
        'date'   => 'date',
    ];
}