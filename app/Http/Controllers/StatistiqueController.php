<?php

namespace App\Http\Controllers;

use App\Models\SiteVisite;
use App\Models\Actualite;
use App\Models\Communique;
use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatistiqueController extends Controller
{
    public function index(Request $request)
    {
        // ===== Cartes du haut =====
        $visiteursEnLigne = count(array_filter(
            Cache::get('visiteurs_en_ligne', []),
            fn($t) => $t > now()->subMinutes(5)->timestamp
        ));

        $totalVisiteurs  = SiteVisite::sum('vues');
        $totalArticles   = Actualite::count();
        $totalCommuniques = Communique::count();

        // ===== Derniers administrateurs connectés =====
        $derniersAdmins = Administrateur::whereNotNull('derniere_connexion')
            ->orderByDesc('derniere_connexion')
            ->take(5)
            ->get();

        // ===== Filtre par date (optionnel) =====
        $query = SiteVisite::query();

        if ($request->filled('debut')) {
            $query->whereDate('date_visite', '>=', $request->debut);
        }
        if ($request->filled('fin')) {
            $query->whereDate('date_visite', '<=', $request->fin);
        }

        $visites = $query->orderBy('date_visite', 'desc')->get();

        // ===== Données pour le graphique (visites par mois, 12 derniers mois) =====
        $parMois = SiteVisite::selectRaw("DATE_FORMAT(date_visite, '%Y-%m') as mois, SUM(vues) as total")
            ->where('date_visite', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois');

        // On complète les mois sans donnée avec 0, pour un graphique continu
        $labelsGraphique = [];
        $valeursGraphique = [];
        for ($m = 11; $m >= 0; $m--) {
            $cle = now()->subMonths($m)->format('Y-m');
            $labelsGraphique[] = now()->subMonths($m)->translatedFormat('M Y');
            $valeursGraphique[] = (int) ($parMois[$cle] ?? 0);
        }

        return view('Espace_admin.parametres.statistique', [
            'visiteursEnLigne'  => $visiteursEnLigne,
            'totalVisiteurs'    => $totalVisiteurs,
            'totalArticles'     => $totalArticles,
            'totalCommuniques'  => $totalCommuniques,
            'derniersAdmins'    => $derniersAdmins,
            'visites'           => $visites,
            'labelsGraphique'   => $labelsGraphique,
            'valeursGraphique'  => $valeursGraphique,
            'debut'             => $request->debut,
            'fin'               => $request->fin,
        ]);
    }
}