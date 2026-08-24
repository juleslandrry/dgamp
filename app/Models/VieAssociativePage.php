<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VieAssociativePage extends Model
{
    protected $fillable = [
        'type', 'badge', 'titre', 'lead',
        'intro_titre', 'intro_texte', 'intro_image', 'checklist',
        'stat1_val', 'stat1_lab', 'stat2_val', 'stat2_lab', 'tags',
        'cta_titre', 'cta_texte', 'cta_bouton_texte', 'cta_bouton_lien',
    ];

    protected $casts = [
        'checklist' => 'array',
        'tags'      => 'array',
    ];

    public function cards()
    {
        return $this->hasMany(VieAssociativeCard::class)->orderBy('ordre');
    }
}