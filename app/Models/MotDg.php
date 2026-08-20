<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotDg extends Model
{
    protected $table = 'mot_dg';

    protected $fillable = [
        'grade_dg',
        'nom_dg',
        'prenom_dg',
        'titre_dg',
        'texte_dg',
        'photo',
    ];
}