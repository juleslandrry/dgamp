<?php

namespace App\Providers;

use App\Models\Activite;
use App\Models\Arrondissement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\ServiceEnLigne;


use App\Models\Configuration;
use App\Models\Banniere;
use App\Models\FlashInfo;
use App\Models\Partenaire;
use Illuminate\Support\Facades\Route;
use App\Models\Actualite;
use App\Models\Communique;
use App\Models\MotDg;
use App\Models\GalerieAlbum;
use App\Models\Video;
use App\Models\Historique;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);


        // Partage la liste des activités avec la vue du menu/header
        View::composer('template', function ($view) {
            $view->with('menuActivites', Activite::select('titre', 'slug')->get());
        });

        View::composer('template', function ($view) {
            $view->with('headerArrondissements', Arrondissement::select('id', 'titre', 'slug')->get());
        });

        View::composer('*', function ($view) {
            $siteSettings = Configuration::first();
            $view->with('siteSettings', $siteSettings);
        });

        View::composer('template', function ($view) {
            $view->with('servicesEnLigneMenu', ServiceEnLigne::orderBy('ordre')->get());
        });

        View::composer('index', function ($view) {
            $banniere = Banniere::where('is_active', true)
                                ->orderBy('ordre', 'asc')
                                ->get();
            $view->with('banniere', $banniere);
        });

        View::composer('template', function ($view) {
            $flashInfos = FlashInfo::where('is_active', true)
                                   ->orderBy('ordre', 'asc')
                                   ->get();
            $view->with('flashInfos', $flashInfos);
        });


    }

}
