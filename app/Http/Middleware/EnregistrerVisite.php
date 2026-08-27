<?php

namespace App\Http\Middleware;

use App\Models\SiteVisite;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EnregistrerVisite
{
    public function handle(Request $request, Closure $next)
    {
        // On ignore les requêtes non-GET, les assets, et l'espace admin
        if ($request->isMethod('get')
            && !$request->is('admin*')
            && !$request->is('assets*')
            && !$request->is('storage*')
        ) {
            $ip = $request->ip();

            // ===== Visiteurs "en ligne" (actifs dans les 5 dernières minutes) =====
            $enLigne = Cache::get('visiteurs_en_ligne', []);
            $enLigne[$ip] = now()->timestamp;
            // Nettoie les IP inactives depuis plus de 5 minutes
            $enLigne = array_filter($enLigne, fn($t) => $t > now()->subMinutes(5)->timestamp);
            Cache::put('visiteurs_en_ligne', $enLigne, now()->addMinutes(10));

            // ===== Visite unique par IP par jour (évite de recompter à chaque page) =====
            $clefDuJour = 'visite_enregistree_' . $ip . '_' . now()->format('Y-m-d');

            if (!Cache::has($clefDuJour)) {
                Cache::put($clefDuJour, true, now()->endOfDay());

                [$pays, $ville] = $this->geolocaliser($ip);

                SiteVisite::updateOrCreate(
                    [
                        'pays'        => $pays,
                        'ville'       => $ville,
                        'date_visite' => now()->format('Y-m-d'),
                    ],
                    []
                )->increment('vues');
            }
        }

        return $next($request);
    }

    /**
     * Géolocalise une IP via l'API gratuite ip-api.com.
     * Retourne [pays, ville]. En local (IP privée), retourne des valeurs par défaut.
     */
    protected function geolocaliser(string $ip): array
    {
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return ['Côte d\'Ivoire', 'Abidjan'];
        }

        try {
            $reponse = Http::timeout(2)->get("http://ip-api.com/json/{$ip}", [
                'fields' => 'status,country,city',
            ]);

            if ($reponse->ok() && $reponse->json('status') === 'success') {
                return [
                    $reponse->json('country') ?: 'Inconnu',
                    $reponse->json('city') ?: 'Inconnue',
                ];
            }
        } catch (\Throwable $e) {
            // Silencieux : en cas d'échec réseau, on retombe sur "Inconnu"
        }

        return ['Inconnu', 'Inconnue'];
    }
}