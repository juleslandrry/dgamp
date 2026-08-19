@extends('template')

@section('layout')

<section class="historique-section">

    <div class="overlay">

        <div class="container">

            <h1 class="titre-historique">
                HISTORIQUE
            </h1>

            @if($historique)

                <p class="intro">
                    {{ $historique->intro }}
                </p>

            @endif

            <div class="timeline">

                @if($historique && $historique->etapes->count())

                    @foreach($historique->etapes as $etape)

                        <div class="timeline-item">

                            <span class="year">
                                {{ $etape->date }}
                            </span>

                            <p>
                                {!! nl2br(e($etape->description)) !!}
                            </p>

                        </div>

                    @endforeach

                @else

                    <p class="empty-message">
                        Aucun événement historique disponible pour le moment.
                    </p>

                @endif

            </div>

        </div>

    </div>

</section>


<style>

.historique-section {

    background-image:
        url("{{ asset('assets/images/image33.jpeg') }}");

    background-size: cover;
    background-position: center;
    background-attachment: fixed;

}


.overlay {

    background: rgba(0, 0, 0, 0.65);

    padding: 100px 0;

}


.titre-historique {

    text-align: center;

    font-size: 40px;

    color: white;

    margin-bottom: 20px;

    font-weight: bold;

}


.intro {

    text-align: center;

    color: #ddd;

    max-width: 800px;

    margin: 0 auto 50px;

    font-size: 18px;

    line-height: 1.7;

}


.timeline {

    max-width: 800px;

    margin: auto;

    border-left: 4px solid white;

    padding-left: 30px;

}


.timeline-item {

    margin-bottom: 40px;

    position: relative;

    color: #ffffff;

    opacity: 0;

    transform: translateY(40px);

    transition: 0.6s;

}


.timeline-item.show {

    opacity: 1;

    transform: translateY(0);

}


.timeline-item::before {

    content: "";

    width: 15px;

    height: 15px;

    background: #ea9307;

    border-radius: 50%;

    position: absolute;

    left: -38px;

    top: 5px;

}


.year {

    font-weight: bold;

    font-size: 22px;

    display: block;

    margin-bottom: 8px;

}


.timeline-item p {

    margin: 0;

    line-height: 1.7;

}


.empty-message {

    color: white;

    text-align: center;

}


@media (max-width: 768px) {

    .overlay {
        padding: 70px 20px;
    }

    .titre-historique {
        font-size: 32px;
    }

    .intro {
        font-size: 16px;
    }

    .timeline {
        padding-left: 25px;
    }

    .timeline-item::before {
        left: -33px;
    }

}

</style>


<script>

document.addEventListener("DOMContentLoaded", function () {

    const items = document.querySelectorAll(".timeline-item");


    function showTimeline() {

        items.forEach(function (item) {

            const position =
                item.getBoundingClientRect().top;

            const screenPosition =
                window.innerHeight - 100;


            if (position < screenPosition) {

                item.classList.add("show");

            }

        });

    }


    showTimeline();

    window.addEventListener(
        "scroll",
        showTimeline
    );

});

</script>

@endsection