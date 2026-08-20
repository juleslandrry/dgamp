<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiographieTimeline extends Model
{
    protected $fillable = ['biographie_id', 'date', 'texte', 'ordre'];

    public function biographie()
    {
        return $this->belongsTo(Biographie::class);
    }
}