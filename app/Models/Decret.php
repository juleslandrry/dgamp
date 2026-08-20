<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decret extends Model
{
    use HasFactory;

    protected $table = 'decrets';

    protected $fillable = [
        'titre',
        'description',
        'fichier_path',
        'ordre',
    ];
}
