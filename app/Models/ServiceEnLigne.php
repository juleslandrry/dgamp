<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceEnLigne extends Model
{
    protected $table = 'services_en_ligne';

    protected $fillable = [
        'cle', 'slug', 'badge', 'titre', 'description', 'bouton_texte',
        'desc', 'accent', 'icon', 'lien',
        'detail_texte', 'detail_points', 'ordre',
    ];

    protected $casts = [
        'detail_points' => 'array',
    ];

    public static function generateUniqueSlug(string $titre, ?int $ignoreId = null): string
    {
        $base = Str::slug($titre) ?: 'service';
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}