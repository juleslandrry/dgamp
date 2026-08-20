<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrete extends Model
{
    use HasFactory;

    // Nom de la table associée dans phpMyAdmin
    protected $table = 'arretes';

    // Champs autorisés à la modification de masse (Mass Assignment)
    protected $fillable = [
        'titre',
        'description',
        'fichier_path',
        'ordre',
    ];
}
