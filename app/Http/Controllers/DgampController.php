<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceEnLigne;

class DgampController extends Controller
{
    public function home() {
        return view('index');
    }

    public function mot_du_dg () {
        return view('accueil.apropos.direction-general.mot-du-dg');
    }

     public function biographie_du_dg () {
        return view('accueil.apropos.direction-general.biographie-du-dg');
    }

    public function ecrire_au_dg () {
        return view('accueil.apropos.direction-general.ecrire-au-dg');
    }

     public function historique_dgam() {
        return view('accueil.apropos.organisation.historique-dgam');
    }

     public function mission_et_objectif() {
        return view('accueil.apropos.organisation.mission-et-objectif');
    }

    public function organigrame_dgam() {
        return view('accueil.apropos.organisation.organigrame-dgam');
    }
    
    public function lois_dgam() {
        return view('accueil.apropos.documentation.textes-nationaux.lois-dgam');
    }

    public function decret_dgam() {
        return view('accueil.apropos.documentation.textes-nationaux.decret-dgam');
    }

     public function arrêté_de_decision() {
        return view('accueil.apropos.documentation.textes-nationaux.arrêtés-de-decision');
    }

     public function convention_dgam() {
        return view('accueil.apropos.documentation.textes-nationaux.textes-internationaux.convention-dgam');
    }

    public function accord_dgam() {
        return view('accueil.apropos.documentation.textes-nationaux.textes-internationaux.accord-dgam');

    }
    public function protocole_dgam() {
        return view('accueil.apropos.documentation.textes-nationaux.textes-internationaux.protocole-dgam');
    }

    public function even_à_venir() {
        return view('accueil.agenda.even-à-venir');
    }

    public function even_passé() {
        return view('accueil.agenda.even-passé');
    }
  
    public function ena() {
        return view('accueil.recrutement.ena');
    }

    public function fonction_publique() {
        return view('accueil.recrutement.fonction-publique');

    }

    public function galerie_img() {
        return view('multimedia.galerie-img');
    }

    public function galerie_vidéo() {
        return view('multimedia.galerie-vidéo');
    }

     public function communiqué() {
        return view('communiqué');
    }

      public function actualité() {
        return view('actualité');
    }

      public function securité_maritime() {
        return view('activité.securité-maritime');
    }

     public function sureté_portuaire() {
        return view('activité.sureté-portuaire');
    }

    public function santé_population_mer() {
        return view('activité.santé-population-mer');
    }

    public function gestion_population_mer() {
        return view('activité.gestion-population-mer');
    }

    public function plaisance_activité_nautique() {
        return view('activité.plaisance-activité-nautique');
    }

    public function transport_fluvio_lagunaire() {
        return view('activité.transport-fluvio-lagunaire');
    }

    public function recouvrement() {
        return view('activité.recouvrement');
    }

     public function coordination_sauvetage_maritime () {
        return view('activité.coordination-sauvetage-maritime');
    }

     public function agrément_visa () {
    $service = ServiceEnLigne::where('cle', 'Agréments et visas')->first();
    return view('service-en-ligne.agrement-visa', ['service' => $service]);
}

public function immatriculation_navire() {
    $service = ServiceEnLigne::where('cle', 'Immatriculations des navires')->first();
    return view('service-en-ligne.immatriculation-navire', ['service' => $service]);
}

public function visite_technique() {
    $service = ServiceEnLigne::where('cle', 'Visite technique des navires')->first();
    return view('service-en-ligne.visite-technique', ['service' => $service]);
}

public function permis_conduire() {
    $service = ServiceEnLigne::where('cle', 'Permis de conduire des navires')->first();
    return view('service-en-ligne.permis-conduire', ['service' => $service]);
}

public function titres_maritimes() {
    $service = ServiceEnLigne::where('cle', 'Livrets et titres maritimes')->first();
    return view('service-en-ligne.titres-maritimes', ['service' => $service]);
}
    public function arrondissement_adiaké() {
        return view('arrondissement.arrondissement-adiaké');
    }

    public function arrondissement_san_pedro() {
        return view('arrondissement.arrondissement-san-pedro');
    }

    public function arrondissement_grand_bassam() {
        return view('arrondissement.arrondissement-grand-bassam');
    }

    public function arrondissement_tabou() {
        return view('arrondissement.arrondissement-tabou');
    }

    public function arrondissement_abidjan() {
        return view('arrondissement.arrondissement-abidjan');
    }

    public function arrondissement_jacqueville() {
        return view('arrondissement.arrondissement-jacqueville');
    }

    public function arrondissement_sassandra() {
        return view('arrondissement.arrondissement-sassandra');
    }

    public function arrondissement_grand_lahou() {
        return view('arrondissement.arrondissement-grand-lahou');
    }

    public function arrondissement_bingerville() {
        return view('arrondissement.arrondissement-bingerville');
    }

    public function arrondissement_fresco() {
        return view('arrondissement.arrondissement-fresco');
    }

    public function personnel_militaire() {
        return view('personnel.personnel-militaire');
    }

     public function personnel_interministériel() {
        return view('personnel.personnel-interministériel');
    }

     public function fond_prévoyance() {
        return view('vie-associative.fond-prévoyance');
    }

     public function vie_social() {
        return view('vie-associative.vie-social');
    }

     public function autre_association() {
        return view('vie-associative.autre-association');
    }

    public function opérateur() {
        return view('opérateur');
    }

    public function partenaire() {
        return view('partenaire');
    }








       
}
