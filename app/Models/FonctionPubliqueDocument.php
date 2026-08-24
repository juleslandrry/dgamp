<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FonctionPubliqueDocument extends Model
{
    protected $table = 'fonction_publique_documents';

    protected $fillable = [
        'reference',
        'mots_cles',
        'intitule',
        'lien',
        'ordre',
    ];
}