@extends('Espace_admin.layout')

@section('content')

<style>

    :root{
        --navy:#0B2340;
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
        display:block;
        font-size:12.5px;
        font-weight:700;
        color:var(--navy);
        text-transform:uppercase;
        letter-spacing:.05em;
        margin-bottom:9px;
    }

    .mdg-field input,
    .node-name,
    .service-name{
        width:100%;
        border:1.5px solid var(--line);
        border-radius:9px;
        background:#fff;
        padding:11px 13px;
        font-size:14px;
        font-family:inherit;
        color:var(--ink);
        box-sizing:border-box;
    }

    .mdg-field input:focus,
    .node-name:focus,
    .service-name:focus{
        outline:none;
        border-color:var(--navy);
        box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }

    .node-card{
        background:#FAF9F5;
        border:1.5px solid var(--line);
        border-radius:10px;
        padding:18px;
        margin-bottom:16px;
    }

    .node-header{
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:16px;
    }

    .node-number{
        width:26px;
        height:26px;
        border-radius:50%;
        background:var(--navy);
        color:white;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:12px;
        font-weight:700;
        flex-shrink:0;
    }

    .node-header-title{
        font-size:13px;
        font-weight:700;
        color:var(--navy);
        text-transform:uppercase;
        flex:1;
    }

    .node-remove{
        border:none;
        background:#FBEAEA;
        color:#C0392B;
        border-radius:7px;
        padding:7px 12px;
        cursor:pointer;
        font-size:12px;
        font-weight:700;
    }

    .children-title{
        margin:18px 0 10px;
        font-size:11.5px;
        font-weight:700;
        color:var(--ink-soft);
        text-transform:uppercase;
        letter-spacing:.05em;
    }

    .service-row{
        display:flex;
        gap:8px;
        margin-bottom:8px;
    }

    .service-row .service-name{
        flex:1;
    }

    .service-remove{
        border:none;
        background:#FBEAEA;
        color:#C0392B;
        border-radius:7px;
        padding:0 12px;
        cursor:pointer;
        font-size:11px;
        font-weight:700;
    }

    .btn-add{
        background:transparent;
        color:var(--navy);
        border:1.5px dashed var(--navy);
        border-radius:8px;
        padding:9px 15px;
        cursor:pointer;
        font-size:12px;
        font-weight:700;
    }

    .btn-add:hover{
        background:var(--gold-soft);
    }

    .btn-add-direction{
        margin-top:4px;
    }

    .documents-card{
        background:#FAF9F5;
        border:1.5px solid var(--line);
        border-radius:10px;
        padding:18px;
        margin-bottom:16px;
    }

    .document-title{
        font-size:13px;
        font-weight:700;
        color:var(--navy);
        margin-bottom:15px;
    }

    .current-file{
        margin-top:10px;
        padding:9px 12px;
        background:#E5F5EC;
        color:var(--green);
        border-radius:7px;
        font-size:12px;
    }

    .mdg-actions{
        display:flex;
        justify-content:flex-end;
        margin-top:34px;
    }

    .mdg-btn-save{
        border:none;
        border-radius:6px;
        padding:11px 24px;
        font-weight:700;
        cursor:pointer;
        font-size:13px;
        background:linear-gradient(135deg,var(--gold),#DFAF3C);
        color:white;
    }

    .mdg-error{
        color:#C0392B;
        font-size:11.5px;
        margin-top:5px;
    }

    @media(max-width:640px){

        .service-row{
            flex-direction:column;
        }

        .service-remove{
            padding:8px;
        }
    }

</style>


<div class="mdg-wrap">

    <div class="mdg-crumb">
        Connaître la DGAM &nbsp;›&nbsp; Organisation
    </div>

    <h1 class="mdg-title">
        Organigramme
    </h1>

    <p class="mdg-sub">
        Gérez les directions, services et documents officiels de l'organigramme.
    </p>


    {{-- SUCCESS --}}

    @if(session('success'))

        <div class="mdg-alert">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERREURS --}}

    @if($errors->any())

        <div
            class="mdg-alert"
            style="background:#FBEAEA;color:#C0392B;border-color:#C0392B;"
        >
            <strong>Veuillez corriger les erreurs :</strong>

            <ul style="margin:8px 0 0 18px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('admin.organigramme.update') }}"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- ================================================= --}}
        {{-- DIRECTION GENERALE                               --}}
        {{-- ================================================= --}}

        <div class="mdg-section-title">
            Direction Générale
        </div>


        <div class="mdg-field">

            <label class="mdg-label">
                Titre de la boîte principale
            </label>

            <input
                type="text"
                name="directeur_titre"
                value="{{ old(
                    'directeur_titre',
                    $organigramme?->directeur_titre ?? ''
                ) }}"
                placeholder="Ex : Directeur Général"
            >

            @error('directeur_titre')

                <div class="mdg-error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        {{-- ================================================= --}}
        {{-- DIRECTIONS                                       --}}
        {{-- ================================================= --}}

        <div class="mdg-section-title">
            Directions & Services
        </div>


        <div id="nodes-list">

            @php

                $nodes = old(
                    'nodes',
                    $organigramme?->nodes
                        ?->map(function ($node) {

                            return [
                                'nom' => $node->nom,

                                'enfants' => $node->enfants
                                    ->map(function ($enfant) {

                                        return [
                                            'nom' => $enfant->nom
                                        ];

                                    })
                                    ->toArray()
                            ];

                        })
                        ->toArray() ?? []
                );

            @endphp


            @foreach($nodes as $i => $node)

                <div class="node-card">

                    <div class="node-header">

                        <span class="node-number">
                            {{ $i + 1 }}
                        </span>

                        <span class="node-header-title">
                            Direction {{ $i + 1 }}
                        </span>

                        <button
                            type="button"
                            class="node-remove"
                            onclick="removeNode(this)"
                        >
                            Retirer
                        </button>

                    </div>


                    <div class="mdg-field">

                        <label class="mdg-label">
                            Nom de la direction / structure
                        </label>

                        <input
                            class="node-name"
                            type="text"
                            name="nodes[{{ $i }}][nom]"
                            value="{{ $node['nom'] ?? '' }}"
                        >

                    </div>


                    <div class="children-title">
                        Services / structures rattachées
                    </div>


                    <div class="children-list">

                        @foreach($node['enfants'] ?? [] as $j => $enfant)

                            <div class="service-row">

                                <input
                                    class="service-name"
                                    type="text"
                                    name="nodes[{{ $i }}][enfants][{{ $j }}][nom]"
                                    value="{{ $enfant['nom'] ?? '' }}"
                                    placeholder="Nom du service"
                                >

                                <button
                                    type="button"
                                    class="service-remove"
                                    onclick="removeService(this)"
                                >
                                    Retirer
                                </button>

                            </div>

                        @endforeach

                    </div>


                    <button
                        type="button"
                        class="btn-add"
                        onclick="addService(this)"
                    >
                        + Ajouter un service
                    </button>

                </div>

            @endforeach

        </div>


        <button
            type="button"
            class="btn-add btn-add-direction"
            onclick="addNode()"
        >
            + Ajouter une direction
        </button>

        <div class="mdg-section-title">
            Documents officiels
        </div>


        {{-- ================================================= --}}
        {{-- PDF ORGANIGRAMME                                  --}}
        {{-- ================================================= --}}

        <div class="documents-card">

            <div class="document-title">
                PDF de l'organigramme
            </div>

            <div class="field">

                <label class="mdg-label">
                    Fichier PDF
                </label>

                <input
                    type="file"
                    name="organigramme_pdf"
                    accept=".pdf,application/pdf"
                >

                @error('organigramme_pdf')

                    <div class="mdg-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            @if(
                $organigramme &&
                $organigramme->organigramme_pdf
            )

                <div class="current-file">

                    ✓ Un fichier est actuellement enregistré.

                    <a
                        href="{{ asset('storage/' . $organigramme->organigramme_pdf) }}"
                        target="_blank"
                        style="margin-left:8px;font-weight:700;"
                    >
                        Voir le PDF
                    </a>

                </div>

            @else

                <div style="font-size:12px;color:#66707B;margin-top:8px;">
                    Aucun PDF d'organigramme enregistré.
                </div>

            @endif

        </div>


        {{-- ================================================= --}}
        {{-- PDF DECRET                                        --}}
        {{-- ================================================= --}}

        <div class="documents-card">

            <div class="document-title">
                Décret de l'organigramme
            </div>

            <div class="field">

                <label class="mdg-label">
                    Fichier PDF
                </label>

                <input
                    type="file"
                    name="decret_pdf"
                    accept=".pdf,application/pdf"
                >

                @error('decret_pdf')

                    <div class="mdg-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            @if(
                $organigramme &&
                $organigramme->decret_pdf
            )

                <div class="current-file">

                    ✓ Un fichier est actuellement enregistré.

                    <a
                        href="{{ asset('storage/' . $organigramme->decret_pdf) }}"
                        target="_blank"
                        style="margin-left:8px;font-weight:700;"
                    >
                        Voir le décret
                    </a>

                </div>

            @else

                <div style="font-size:12px;color:#66707B;margin-top:8px;">
                    Aucun décret enregistré.
                </div>

            @endif

        </div>


        {{-- ================================================= --}}
        {{-- ENREGISTRER                                      --}}
        {{-- ================================================= --}}

        <div class="mdg-actions">

            <button
                type="submit"
                class="mdg-btn-save"
            >
                Enregistrer les modifications
            </button>

        </div>

    </form>

</div>


<script>

    let nodeIndex = {{ count($nodes) }};


    /*
    |--------------------------------------------------------------------------
    | Ajouter une direction
    |--------------------------------------------------------------------------
    */

    function addNode()
    {
        const list =
            document.getElementById('nodes-list');


        const index = nodeIndex++;


        const node = document.createElement('div');

        node.className = 'node-card';


        node.innerHTML = `

            <div class="node-header">

                <span class="node-number">
                    1
                </span>

                <span class="node-header-title">
                    Nouvelle direction
                </span>

                <button
                    type="button"
                    class="node-remove"
                    onclick="removeNode(this)"
                >
                    Retirer
                </button>

            </div>


            <div class="mdg-field">

                <label class="mdg-label">
                    Nom de la direction / structure
                </label>

                <input
                    class="node-name"
                    type="text"
                    name="nodes[${index}][nom]"
                    placeholder="Ex : Direction Maritime"
                >

            </div>


            <div class="children-title">
                Services / structures rattachées
            </div>


            <div class="children-list">
            </div>


            <button
                type="button"
                class="btn-add"
                onclick="addService(this)"
            >
                + Ajouter un service
            </button>

        `;


        list.appendChild(node);

        renumberNodes();
    }


    /*
    |--------------------------------------------------------------------------
    | Ajouter un service
    |--------------------------------------------------------------------------
    */

    function addService(button)
    {
        const nodeCard =
            button.closest('.node-card');

        const childrenList =
            nodeCard.querySelector('.children-list');


        const nodeNameInput =
            nodeCard.querySelector('.node-name');


        const nodeName =
            nodeNameInput.getAttribute('name');


        const match =
            nodeName.match(/nodes\[(\d+)\]/);


        if (!match) {
            return;
        }


        const nodeIndex =
            match[1];


        const serviceIndex =
            childrenList.querySelectorAll('.service-row').length;


        const row =
            document.createElement('div');

        row.className = 'service-row';


        row.innerHTML = `

            <input
                class="service-name"
                type="text"
                name="nodes[${nodeIndex}][enfants][${serviceIndex}][nom]"
                placeholder="Nom du service"
            >

            <button
                type="button"
                class="service-remove"
                onclick="removeService(this)"
            >
                Retirer
            </button>

        `;


        childrenList.appendChild(row);
    }


    /*
    |--------------------------------------------------------------------------
    | Supprimer une direction
    |--------------------------------------------------------------------------
    */

    function removeNode(button)
    {
        const node =
            button.closest('.node-card');

        node.remove();

        renumberNodes();
    }


    /*
    |--------------------------------------------------------------------------
    | Supprimer un service
    |--------------------------------------------------------------------------
    */

    function removeService(button)
    {
        const row =
            button.closest('.service-row');

        const childrenList =
            row.parentElement;

        row.remove();


        /*
        | Réindexer les services
        */

        const nodeCard =
            childrenList.closest('.node-card');

        const nodeNameInput =
            nodeCard.querySelector('.node-name');

        const nodeName =
            nodeNameInput.getAttribute('name');

        const match =
            nodeName.match(/nodes\[(\d+)\]/);

        if (!match) {
            return;
        }

        const nodeIndex =
            match[1];


        childrenList
            .querySelectorAll('.service-row')
            .forEach((service, index) => {

                const input =
                    service.querySelector('.service-name');

                input.name =
                    `nodes[${nodeIndex}][enfants][${index}][nom]`;

            });
    }


    /*
    |--------------------------------------------------------------------------
    | Réindexer les directions
    |--------------------------------------------------------------------------
    */

    function renumberNodes()
    {
        const nodes =
            document.querySelectorAll('.node-card');


        nodes.forEach((node, index) => {

            const number =
                node.querySelector('.node-number');

            const title =
                node.querySelector('.node-header-title');

            number.textContent =
                index + 1;

            title.textContent =
                `Direction ${index + 1}`;

        });
    }

</script>

@endsection
