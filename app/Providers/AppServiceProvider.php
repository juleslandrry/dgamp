<?php

namespace App\Providers;

use App\Models\Activite;
use App\Models\Arrondissement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\ServiceEnLigne;


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

        View::composer('template', function ($view) {
        $view->with('servicesEnLigneMenu', ServiceEnLigne::orderBy('ordre')->get());
    });

    }
}
