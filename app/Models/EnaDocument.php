<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnaDocument extends Model
{
    protected $table = 'ena_documents';

    protected $fillable = [
        'reference',
        'mots_cles',
        'intitule',
        'lien',
        'ordre',
    ];
}