<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrateurs';

    protected $fillable = [
        'nom',
        'email',
        'titre',
        'password',
        'statut',
        'derniere_connexion',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password'            => 'hashed',
        'derniere_connexion'  => 'datetime',
    ];

    /**
     * Initiales utilisées pour l'avatar (ex: "Kouame Hurbain" -> "KH")
     */
    public function getInitialesAttribute(): string
    {
        $mots = preg_split('/\s+/', trim($this->nom));
        $initiales = collect($mots)->map(fn ($m) => mb_strtoupper(mb_substr($m, 0, 1)))->take(2)->implode('');

        return $initiales ?: '?';
    }

    public function getStatutLabelAttribute(): string
    {
        return $this->statut === 'actif' ? 'En ligne' : 'Hors ligne';
    }
}