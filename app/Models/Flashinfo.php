<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashinfo extends Model
{
    use HasFactory;

    protected $fillable = ['contenu', 'lien', 'ordre', 'is_active'];
}
