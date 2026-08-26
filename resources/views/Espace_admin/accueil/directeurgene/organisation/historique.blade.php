@extends('Espace_admin.layout')

@section('content')

<style>
    :root {
        --navy: #0B2340;
        --navy-2: #123A63;
        --blue: #1E7FB8;
        --orange: #E8720C;
        --green: #1F7A4D;
        --gold: #C9A227;
        --gold-soft: #FBF3DD;
        --ink: #1C2733;
        --ink-soft: #66707B;
        --line: #E7E2D6;
    }

    .mdg-wrap {
        max-width: 900px;
        margin: 0 auto;
        padding: 36px 24px 60px;
    }

    .mdg-crumb {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--orange);
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
    }

    .mdg-crumb::before {
        content: "";
        width: 14px;
        height: 2px;
        background: var(--orange);
        border-radius: 2px;
    }

    .mdg-title {
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 25px;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 26px;
    }

    .mdg-alert {
        background: #E5F5EC;
        border-left: 4px solid var(--green);
        color: var(--green);
        padding: 12px 18px;
        border-radius: 6px;
        margin-bottom: 22px;
        font-size: 13.5px;
    }

    .mdg-error {
        color: #C0392B;
        font-size: 11.5px;
        margin-top: 5px;
    }

    .mdg-field {
        margin-bottom: 26px;
    }

    .mdg-label {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--navy);
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 9px;
    }

    .mdg-icon {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .mdg-icon svg {
        width: 13px;
        height: 13px;
    }

    .i-navy {
        background: var(--navy);
    }

    .mdg-field textarea {
        width: 100%;
        border: 1.5px solid var(--line);
        border-radius: 9px;
        background: #fff;
        padding: 12px 14px;
        font-size: 14.5px;
        font-family: inherit;
        color: var(--ink);
        resize: vertical;
        box-sizing: border-box;
        min-height: 130px;
        line-height: 1.7;
    }

    .mdg-field textarea:focus {
        outline: none;
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(11,35,64,.08);
    }

    .mdg-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 700;
        color: var(--navy);
        margin: 38px 0 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--gold);
    }

    /* Styles de la grille des images */
    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }

    .image-card {
        background: #FAF9F5;
        padding: 16px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        display: flex;
        flex-direction: column;
    }

    .image-card label {
        font-size: 12px;
        font-weight: 700;
        color: var(--navy);
        display: block;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .image-preview-wrapper {
        width: 100%;
        height: 140px;
        border-radius: 7px;
        overflow: hidden;
        background: #EAE6DF;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--line);
    }

    .image-preview-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-placeholder {
        font-size: 12px;
        color: var(--ink-soft);
        font-weight: 600;
    }

    .image-card input[type="file"] {
        font-size: 12px;
        width: 100%;
        color: var(--ink);
    }

    /* Styles de la chronologie */
    .repeat-row {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        margin-bottom: 14px;
        background: #FAF9F5;
        padding: 16px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        transition: all .2s ease;
    }

    .repeat-num {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: var(--navy);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .repeat-fields {
        flex: 1;
        display: grid;
        grid-template-columns: 170px 1fr;
        gap: 12px;
        min-width: 0;
    }

    .repeat-row input,
    .repeat-row textarea {
        width: 100%;
        border: 1.5px solid var(--line);
        border-radius: 7px;
        padding: 9px 11px;
        font-size: 13px;
        font-family: inherit;
        box-sizing: border-box;
        background: #fff;
    }

    .repeat-row textarea {
        min-height: 80px;
        resize: vertical;
        line-height: 1.5;
    }

    .repeat-row input:focus,
    .repeat-row textarea:focus {
        outline: none;
        border-color: var(--navy);
    }

    .repeat-hint {
        font-size: 11px;
        color: var(--ink-soft);
        margin-top: 5px;
    }

    .timeline-actions {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex-shrink: 0;
    }

    .btn-move {
        width: 34px;
        height: 32px;
        border: 1px solid var(--line);
        background: #fff;
        color: var(--navy);
        border-radius: 7px;
        cursor: pointer;
        font-size: 17px;
        font-weight: 700;
        transition: .15s ease;
    }

    .btn-move:hover {
        background: var(--gold-soft);
        border-color: var(--gold);
    }

    .btn-remove {
        background: #FBEAEA;
        color: #C0392B;
        border: none;
        border-radius: 7px;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-remove:hover {
        background: #F5D5D5;
    }

    .btn-add {
        background: transparent;
        color: var(--navy);
        border: 1.5px dashed var(--navy);
        border-radius: 8px;
        padding: 10px 18px;
        cursor: pointer;
        font-size: 12.5px;
        font-weight: 700;
        margin-top: 2px;
    }

    .btn-add:hover {
        background: var(--gold-soft);
    }

    .mdg-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 34px;
    }

    .mdg-btn {
        border: none;
        border-radius: 6px;
        padding: 11px 24px;
        font-weight: 700;
        cursor: pointer;
        font-size: 13px;
    }

    .mdg-btn-save {
        background: linear-gradient(135deg, var(--gold), #DFAF3C);
        color: #fff;
        box-shadow: 0 4px 12px rgba(201,162,39,.35);
    }

    @media (max-width: 640px) {
        .repeat-fields {
            grid-template-columns: 1fr;
        }

        .repeat-row {
            flex-wrap: wrap;
        }

        .timeline-actions {
            flex-direction: row;
            width: 100%;
        }

        .btn-move {
            flex: 0 0 40px;
        }
    }
</style>


<div class="mdg-wrap">

    <div class="mdg-crumb">
        Connaître la DGAM &nbsp;›&nbsp; Organisation
    </div>

    <h1 class="mdg-title">
        Historique
    </h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mdg-alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Erreurs --}}
    @if($errors->any())
        <div class="mdg-alert" style="background:#FBEAEA;color:#C0392B;border-color:#C0392B;">
            <strong>Veuillez corriger les erreurs ci-dessous.</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.historique.update') }}" enctype="multipart/form-data" id="histForm">
        @csrf

        {{-- ========================= --}}
        {{-- TEXTE D'INTRODUCTION      --}}
        {{-- ========================= --}}
        <div class="mdg-field">

            <div class="mdg-label">
                <span class="mdg-icon i-navy">
                    <svg
                        viewBox="0 0 16 16"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M2 3h12v7H6l-3 3v-3H2z"/>
                    </svg>
                </span>
                Texte d'introduction
            </div>

            <textarea
                name="intro"
                placeholder="Saisissez le texte d'introduction de l'histoire..."
            >{{ old('intro', $intro) }}</textarea>

            @error('intro')
                <div class="mdg-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- ========================= --}}
        {{-- IMAGES PAGE D'ACCUEIL     --}}
        {{-- ========================= --}}
        <div class="mdg-section-title">
            Images d'illustration (Page d'accueil)
        </div>

        <div class="images-grid">

            {{-- Image 1 --}}
            <div class="image-card">
                <label>Image 1</label>
                <div class="image-preview-wrapper">
                    @if(isset($image1) && $image1)
                        <img src="{{ asset('storage/' . $image1) }}" alt="Image 1">
                    @else
                        <span class="image-placeholder">Aucune image</span>
                    @endif
                </div>
                <input type="file" name="image1" accept="image/*">
                @error('image1')
                    <div class="mdg-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image 2 --}}
            <div class="image-card">
                <label>Image 2</label>
                <div class="image-preview-wrapper">
                    @if(isset($image2) && $image2)
                        <img src="{{ asset('storage/' . $image2) }}" alt="Image 2">
                    @else
                        <span class="image-placeholder">Aucune image</span>
                    @endif
                </div>
                <input type="file" name="image2" accept="image/*">
                @error('image2')
                    <div class="mdg-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image 3 --}}
            <div class="image-card">
                <label>Image 3</label>
                <div class="image-preview-wrapper">
                    @if(isset($image3) && $image3)
                        <img src="{{ asset('storage/' . $image3) }}" alt="Image 3">
                    @else
                        <span class="image-placeholder">Aucune image</span>
                    @endif
                </div>
                <input type="file" name="image3" accept="image/*">
                @error('image3')
                    <div class="mdg-error">{{ $message }}</div>
                @enderror
            </div>

        </div>


        {{-- ========================= --}}
        {{-- CHRONOLOGIE               --}}
        {{-- ========================= --}}
        <div class="mdg-section-title">
            Chronologie
        </div>

        <div id="timeline-list">

            @foreach($timeline as $i => $item)

                <div class="repeat-row timeline-row">

                    {{-- Numéro --}}
                    <div class="repeat-num position-number">
                        {{ $i + 1 }}
                    </div>

                    {{-- Contenu --}}
                    <div class="repeat-fields">

                        <div>
                            <input
                                type="text"
                                name="date[]"
                                value="{{ old('date.' . $i, $item['date'] ?? '') }}"
                                placeholder="Ex : 1960 ou 4 septembre 2019"
                            >
                            <div class="repeat-hint">
                                Année / date
                            </div>
                        </div>

                        <div>
                            <textarea
                                name="description[]"
                                placeholder="Description de l'événement"
                            >{{ old('description.' . $i, $item['description'] ?? '') }}</textarea>
                            <div class="repeat-hint">
                                Tu peux utiliser plusieurs lignes.
                            </div>
                        </div>

                    </div>

                    {{-- Boutons --}}
                    <div class="timeline-actions">

                        <button
                            type="button"
                            class="btn-move btn-up"
                            onclick="moveUp(this)"
                            title="Monter"
                        >
                            ↑
                        </button>

                        <button
                            type="button"
                            class="btn-move btn-down"
                            onclick="moveDown(this)"
                            title="Descendre"
                        >
                            ↓
                        </button>

                        <button
                            type="button"
                            class="btn-remove"
                            onclick="removeRow(this)"
                        >
                            Retirer
                        </button>

                    </div>

                </div>

            @endforeach

        </div>

        <button type="button" class="btn-add" onclick="addRow()">
            + Ajouter une étape
        </button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">
                Enregistrer les modifications
            </button>
        </div>

    </form>

</div>

<script>

    function addRow() {
        const list = document.getElementById('timeline-list');
        const wrap = document.createElement('div');
        wrap.className = 'repeat-row timeline-row';

        wrap.innerHTML = `
            <div class="repeat-num position-number">
                0
            </div>

            <div class="repeat-fields">
                <div>
                    <input
                        type="text"
                        name="date[]"
                        placeholder="Ex : 1960 ou 4 septembre 2019"
                    >
                    <div class="repeat-hint">
                        Année / date
                    </div>
                </div>

                <div>
                    <textarea
                        name="description[]"
                        placeholder="Description de l'événement"
                    ></textarea>
                    <div class="repeat-hint">
                        Tu peux utiliser plusieurs lignes.
                    </div>
                </div>
            </div>

            <div class="timeline-actions">
                <button
                    type="button"
                    class="btn-move"
                    onclick="moveUp(this)"
                    title="Monter"
                >
                    ↑
                </button>

                <button
                    type="button"
                    class="btn-move"
                    onclick="moveDown(this)"
                    title="Descendre"
                >
                    ↓
                </button>

                <button
                    type="button"
                    class="btn-remove"
                    onclick="removeRow(this)"
                >
                    Retirer
                </button>
            </div>
        `;

        list.appendChild(wrap);
        updateNumbers();
    }

    function removeRow(button) {
        const row = button.closest('.timeline-row');
        if (row) {
            row.remove();
        }
        updateNumbers();
    }

    function moveUp(button) {
        const row = button.closest('.timeline-row');
        if (!row) return;

        const previous = row.previousElementSibling;
        if (!previous) return;

        row.parentNode.insertBefore(row, previous);
        updateNumbers();
    }

    function moveDown(button) {
        const row = button.closest('.timeline-row');
        if (!row) return;

        const next = row.nextElementSibling;
        if (!next) return;

        row.parentNode.insertBefore(next, row);
        updateNumbers();
    }

    function updateNumbers() {
        const rows = document.querySelectorAll('#timeline-list .timeline-row');
        rows.forEach((row, index) => {
            const number = row.querySelector('.position-number');
            if (number) {
                number.textContent = index + 1;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateNumbers();
    });

</script>

@endsection