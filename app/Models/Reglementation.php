<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglementation extends Model
{
    use HasFactory;

    protected $fillable = ['activite_id', 'titre', 'sous_titre', 'intro', 'description'];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
