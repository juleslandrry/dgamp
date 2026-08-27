<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VieAssociativeCard extends Model
{
    protected $fillable = [
        'vie_associative_page_id', 'titre', 'description', 'ordre',
    ];

    public function page()
    {
        return $this->belongsTo(VieAssociativePage::class, 'vie_associative_page_id');
    }
}