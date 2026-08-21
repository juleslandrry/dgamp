<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'slug', 'image'];

    public function reglementations()
    {
        return $this->hasMany(Reglementation::class);
    }
}
