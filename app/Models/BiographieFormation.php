<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiographieFormation extends Model
{
    protected $fillable = ['biographie_id', 'annee', 'texte', 'ordre'];

    public function biographie()
    {
        return $this->belongsTo(Biographie::class);
    }
}