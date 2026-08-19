@extends('Espace_admin.layout')

@section('content')

<style>
    :root{
        --navy:#0B2340;
        --navy-2:#123A63;
        --blue:#1E7FB8;
        --orange:#E8720C;
        --green:#1F7A4D;
        --gold:#C9A227;
        --gold-soft:#FBF3DD;
        --ink:#1C2733;
        --ink-soft:#66707B;
        --line:#E7E2D6;
    }

    .mdg-wrap{
        max-width:900px;
        margin:0 auto;
        padding:36px 24px 60px;
    }

    .mdg-crumb{
        font-size:11px;
        text-transform:uppercase;
        letter-spacing:.12em;
        color:var(--orange);
        font-weight:700;
        display:flex;
        align-items:center;
        gap:6px;
        margin-bottom:6px;
    }

    .mdg-crumb::before{
        content:"";
        width:14px;
        height:2px;
        background:var(--orange);
        border-radius:2px;
    }

    .mdg-title{
        font-family:'IBM Plex Sans',sans-serif;
        font-size:25px;
        font-weight:700;
        color:var(--navy);
        margin:0 0 8px;
    }

    .mdg-sub{
        font-size:13px;
        color:var(--ink-soft);
        margin:0 0 26px;
    }

    .mdg-alert{
        background:#E5F5EC;
        border-left:4px solid var(--green);
        color:var(--green);
        padding:12px 18px;
        border-radius:6px;
        margin-bottom:22px;
        font-size:13.5px;
    }

    .mdg-section-title{
        display:flex;
        align-items:center;
        gap:10px;
        font-size:17px;
        font-weight:700;
        color:var(--navy);
        margin:38px 0 18px;
        padding-bottom:10px;
        border-bottom:2px solid var(--gold);
    }

    .mdg-field{
        margin-bottom:22px;
    }

    .mdg-label{
        display:flex;
        align-items:center;
        gap:9px;
        font-size:12.5px;
        font-weight:700;
        color:var(--navy);
        text-transform:uppercase;
        letter-spacing:.05em;
        margin-bottom:9px;
    }

    .mdg-icon{
        width:24px;
        height:24px;
        border-radius:7px;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#fff;
    }

    .mdg-icon svg{
        width:13px;
        height:13px;
    }

    .i-blue{
        background:var(--blue);
    }

    .i-green{
        background:var(--green);
    }

    .mdg-field input[type=text]{
        width:100%;
        border:1.5px solid var(--line);
        border-radius:9px;
        background:#fff;
        padding:12px 14px;
        font-size:14.5px;
        font-family:inherit;
        color:var(--ink);
        box-sizing:border-box;
    }

    .mdg-field input[type=text]:focus{
        outline:none;
        border-color:var(--navy);
        box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }

    .card-block{
        background:#FAF9F5;
        border:1.5px solid var(--line);
        border-radius:10px;
        padding:18px 20px;
        margin-bottom:16px;
        position:relative;
    }

    .card-block-label{
        display:flex;
        align-items:center;
        gap:8px;
        font-weight:700;
        color:var(--navy);
        font-size:12.5px;
        margin-bottom:14px;
        text-transform:uppercase;
        letter-spacing:.05em;
    }

    .card-num{
        width:22px;
        height:22px;
        border-radius:50%;
        background:var(--navy);
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:11px;
        font-weight:700;
    }

    .field{
        margin-bottom:12px;
    }

    .field:last-child{
        margin-bottom:0;
    }

    .field label{
        display:block;
        font-weight:700;
        color:var(--ink-soft);
        margin-bottom:6px;
        font-size:11.5px;
        text-transform:uppercase;
        letter-spacing:.04em;
    }

    .field input,
    .field textarea{
        width:100%;
        border:1.5px solid var(--line);
        border-radius:8px;
        padding:10px 12px;
        font-size:13.5px;
        font-family:inherit;
        box-sizing:border-box;
        background:#fff;
    }

    .field textarea{
        min-height:70px;
        resize:vertical;
        line-height:1.5;
    }

    .field input:focus,
    .field textarea:focus{
        outline:none;
        border-color:var(--navy);
    }

    .btn-remove-card{
        position:absolute;
        top:14px;
        right:16px;
        background:#FBEAEA;
        color:#C0392B;
        border:none;
        border-radius:7px;
        padding:7px 13px;
        cursor:pointer;
        font-size:12px;
        font-weight:700;
    }

    .btn-add-card{
        background:transparent;
        color:var(--navy);
        border:1.5px dashed var(--navy);
        border-radius:8px;
        padding:10px 18px;
        cursor:pointer;
        font-size:12.5px;
        font-weight:700;
        margin-bottom:10px;
    }

    .mdg-actions{
        display:flex;
        justify-content:flex-end;
        margin-top:34px;
    }

    .mdg-btn{
        border:none;
        border-radius:6px;
        padding:11px 24px;
        font-weight:700;
        cursor:pointer;
        font-size:13px;
    }

    .mdg-btn-save{
        background:linear-gradient(135deg,var(--gold),#DFAF3C);
        color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);
    }

    .mdg-error{
        color:#C0392B;
        font-size:11.5px;
        margin-top:5px;
    }

    @media(max-width:640px){
        .btn-remove-card{
            position:static;
            margin-bottom:12px;
        }
    }
</style>


<div class="mdg-wrap">

    <div class="mdg-crumb">
        Connaître la DGAM &nbsp;›&nbsp; Organisation
    </div>

    <h1 class="mdg-title">
        Missions & Objectifs
    </h1>

    <p class="mdg-sub">
        Modifie une carte existante ou ajoute une nouvelle carte.
    </p>


    {{-- Message de succès --}}

    @if(session('success'))

        <div class="mdg-alert">
            {{ session('success') }}
        </div>

    @endif


    {{-- Erreurs --}}

    @if($errors->any())

        <div
            class="mdg-alert"
            style="background:#FBEAEA;color:#C0392B;border-color:#C0392B;"
        >
            Veuillez corriger les erreurs avant d'enregistrer.
        </div>

    @endif


    <form
        method="POST"
        action="{{ route('admin.missions.update') }}"
    >

        @csrf


        {{-- ================================================= --}}
        {{-- MISSIONS                                          --}}
        {{-- ================================================= --}}

        <div class="mdg-section-title">
            Nos Missions
        </div>


        <div class="mdg-field">

            <div class="mdg-label">

                <span class="mdg-icon i-blue">

                    <svg
                        viewBox="0 0 16 16"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path d="M2 3h12v7H6l-3 3v-3H2z"/>
                    </svg>

                </span>

                Titre de la section

            </div>


            <input
                type="text"
                name="missions_titre"
                value="{{ old('missions_titre', $missionsObjectifs?->missions_titre ?? '') }}"
            >


            @error('missions_titre')

                <div class="mdg-error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <div id="missions-list">

            @php
                $missions = old(
                    'missions',
                    $missionsObjectifs?->missions
                        ?->map(fn($mission) => [
                            'titre' => $mission->titre,
                            'description' => $mission->description,
                        ])
                        ->toArray() ?? []
                );
            @endphp


            @foreach($missions as $index => $mission)

                <div class="card-block">

                    <div class="card-block-label">

                        <span class="card-num">
                            {{ $index + 1 }}
                        </span>

                        Carte {{ $index + 1 }}

                    </div>


                    <div class="field">

                        <label>
                            Titre
                        </label>

                        <input
                            type="text"
                            name="missions[{{ $index }}][titre]"
                            value="{{ $mission['titre'] ?? '' }}"
                        >

                    </div>


                    <div class="field">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="missions[{{ $index }}][description]"
                        >{{ $mission['description'] ?? '' }}</textarea>

                    </div>

                </div>

            @endforeach

        </div>


        <button
            type="button"
            class="btn-add-card"
            onclick="addCard('missions')"
        >
            + Ajouter une carte Mission
        </button>



        {{-- ================================================= --}}
        {{-- OBJECTIFS                                         --}}
        {{-- ================================================= --}}

        <div class="mdg-section-title">
            Nos Objectifs
        </div>


        <div class="mdg-field">

            <div class="mdg-label">

                <span class="mdg-icon i-green">

                    <svg
                        viewBox="0 0 16 16"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <circle cx="8" cy="8" r="6"/>
                        <circle cx="8" cy="8" r="3"/>
                    </svg>

                </span>

                Titre de la section

            </div>


            <input
                type="text"
                name="objectifs_titre"
                value="{{ old('objectifs_titre', $missionsObjectifs?->objectifs_titre ?? '') }}"
            >


            @error('objectifs_titre')

                <div class="mdg-error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <div id="objectifs-list">

            @php
                $objectifs = old(
                    'objectifs',
                    $missionsObjectifs?->objectifs
                        ?->map(fn($objectif) => [
                            'titre' => $objectif->titre,
                            'description' => $objectif->description,
                        ])
                        ->toArray() ?? []
                );
            @endphp


            @foreach($objectifs as $index => $objectif)

                <div class="card-block">

                    <div class="card-block-label">

                        <span class="card-num">
                            {{ $index + 1 }}
                        </span>

                        Carte {{ $index + 1 }}

                    </div>


                    <div class="field">

                        <label>
                            Titre
                        </label>

                        <input
                            type="text"
                            name="objectifs[{{ $index }}][titre]"
                            value="{{ $objectif['titre'] ?? '' }}"
                        >

                    </div>


                    <div class="field">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="objectifs[{{ $index }}][description]"
                        >{{ $objectif['description'] ?? '' }}</textarea>

                    </div>

                </div>

            @endforeach

        </div>


        <button
            type="button"
            class="btn-add-card"
            onclick="addCard('objectifs')"
        >
            + Ajouter une carte Objectif
        </button>



        {{-- ================================================= --}}
        {{-- ENREGISTRER                                       --}}
        {{-- ================================================= --}}

        <div class="mdg-actions">

            <button
                type="submit"
                class="mdg-btn mdg-btn-save"
            >
                Enregistrer les modifications
            </button>

        </div>

    </form>

</div>


<script>

    let missionsIndex = {{ count($missions) }};
    let objectifsIndex = {{ count($objectifs) }};


    function addCard(type)
    {
        const list = document.getElementById(
            type + '-list'
        );

        let index;

        if (type === 'missions') {
            index = missionsIndex++;
        } else {
            index = objectifsIndex++;
        }

        const number =
            list.querySelectorAll('.card-block').length + 1;

        const label =
            type === 'missions'
                ? 'Mission'
                : 'Objectif';


        const wrap = document.createElement('div');

        wrap.className = 'card-block';


        wrap.innerHTML = `

            <div class="card-block-label">

                <span class="card-num">
                    ${number}
                </span>

                Carte ${number}

            </div>


            <button
                type="button"
                class="btn-remove-card"
                onclick="removeCard(this)"
            >
                Retirer
            </button>


            <div class="field">

                <label>
                    Titre
                </label>

                <input
                    type="text"
                    name="${type}[${index}][titre]"
                >

            </div>


            <div class="field">

                <label>
                    Description
                </label>

                <textarea
                    name="${type}[${index}][description]"
                ></textarea>

            </div>

        `;


        list.appendChild(wrap);

        renumberCards(list);
    }


    function removeCard(button)
    {
        const card = button.closest('.card-block');

        const list = card.parentElement;

        card.remove();

        renumberCards(list);
    }


    function renumberCards(list)
    {
        const cards =
            list.querySelectorAll('.card-block');

        cards.forEach((card, index) => {

            const number =
                card.querySelector('.card-num');

            number.textContent = index + 1;

        });
    }

</script>

@endsection