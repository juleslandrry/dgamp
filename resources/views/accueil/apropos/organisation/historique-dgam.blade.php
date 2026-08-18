@extends('template')
@section('layout')

<section class="historique-section">

<div class="overlay">

<div class="container">

<h1 class="titre-historique">HISTORIQUE</h1>

<p class="intro">
Les Affaires Maritimes et Portuaires ivoiriennes, qui font partie intégrante
des Forces de Sécurité Intérieure de l’État, ont connu plusieurs mutations
de 1960 à nos jours.
</p>

<div class="timeline">

<div class="timeline-item">
<span class="year">1960</span>
<p> création de la Direction de la Marine Marchande par le décret n°60-353 du 02 novembre 1960 et rattachée au Ministère des Travaux Publiques et des Transports.</p>
</div>

<div class="timeline-item">
<span class="year">1974</span>
<p>l’érection de la Direction de la Marine Marchande en Secrétariat d’Etat à la Marine et placée sous l’autorité du Président de la République.</p>
</div>

<div class="timeline-item">
<span class="year">1976</span>
<p> cette année constitue une grande étape dans l’évolution de cette administration par la transformation du secrétariat d’Etat à la Marine en Ministère de la marine. </p>
</div>

<div class="timeline-item">
<span class="year">1991</span>
<p>avec le décret n°91-67 du 07 février 1991 portant organisation du Ministère de l’équipement, du transport et du Tourisme, l’Administration Maritime est réduite en deux (02) directions centrales. Il s’agit de :
 <br>
 - la Direction des Affaires Maritimes et Portuaires (DAMP) ;
 <br>
- la Direction des Transports Maritimes, Fluvio-Lagunaires et de la Plaisance (DTMFLP).</p>
</div>

<div class="timeline-item">
<span class="year">2004</span>
<p>la Direction Générale des Affaires Maritimes et Portuaires est créée par le décret n°2004-07 du 7 janvier 2004 portant organisation du Ministère d’Etat, Ministère des Transports, avec  quatre (4) directions centrales que sont:
 <br>
la Direction des Transports Maritimes et Fluvio-Lagunaires ;
 <br>
la Direction de la Navigation, de la Sécurité et de la Garde Côtière ;
 <br>
la Direction des Affaires Portuaires, du Domaine et de la Plaisance ;
 <br>
la Direction des Gens de Mer et des Relations Extérieures ;
 <br>
la Direction des Moyens créée en 2011, par le décret n°2011-401 du 16 novembre 2011 portant organisation du Ministère des Transports.
 <br>
De 2019 à 2021, la Direction Générale des Affaires Maritimes et Portuaires connaît des changements..</p>
</div>
 
<div class="timeline-item">
<span class="year"> 4 septembre 2019</span>
<p> elle est rattachée au Secrétariat d’Etat, auprès du Ministre des Transports, chargé des Affaires Maritimes.</p>
</div>

<div class="timeline-item">
<span class="year"> 3 mai 2020</span>
<p>avec la création du Ministère chargé des Affaires Maritimes, la Direction Générale des Affaires Maritimes et Portuaires devient une structure à part entière dudit Ministère.</p>
</div>

<div class="timeline-item">
<span class="year"> 6 avril 2021</span>
<p> la Direction Générale des Affaires Maritimes et Portuaires est à nouveau rattachée au Secrétariat d’Etat, auprès du Ministre des Transports, chargé des Affaires Maritimes.</p>
</div>

<div class="timeline-item">
<span class="year"> 20 avril 2022</span>
<p>rattachement au ministère des Transports dans le 2è gouvernement du Premier Ministre Patrick Achi.</p>
</div>

</div>
</div>

</div>

</section>

<style>
  .historique-section{

background-image:url("assets/images/image33.jpeg");
background-size:cover;
background-position:center;
background-attachment:fixed;

}

.overlay{

background:rgba(0,0,0,0.65);
padding:100px 0;

}

.titre-historique{

text-align:center;
font-size:40px;
color:white;
margin-bottom:20px;
font-weight:bold;

}

.intro{

text-align:center;
color:#ddd;
max-width:800px;
margin:auto;
margin-bottom:50px;
font-size:18px;

}

.timeline{

max-width:800px;
margin:auto;
border-left:4px solid white;
padding-left:30px;

}

.timeline-item{

margin-bottom:40px;
position:relative;
color: #ffffff;

}

.timeline-item::before{

content:"";
width:15px;
height:15px;
background: #ea9307;
border-radius:50%;
position:absolute;
left:-38px;
top:5px;

}

.year{

font-weight:bold;
font-size:22px;
}


.timeline-item{

opacity:0;
transform:translateY(40px);
transition:0.6s;

}

.timeline-item.show{

opacity:1;
transform:translateY(0);

}
</style>

<script>

const items = document.querySelectorAll(".timeline-item");

function showTimeline(){

items.forEach(item => {

const position = item.getBoundingClientRect().top;
const screenPosition = window.innerHeight - 100;

if(position < screenPosition){

item.classList.add("show");

}

});

}

window.addEventListener("scroll", showTimeline);

</script>
@endsection