@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C; --green:#1F7A4D;
        --gold:#C9A227; --gold-soft:#FBF3DD; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6;
    }
    .mdg-wrap{max-width:900px;margin:0 auto;padding:36px 24px 60px;}
    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .mdg-title{font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;letter-spacing:-.01em;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 22px;}
    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    .tabs{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:28px;background:#fff;padding:16px;
        border-radius:10px;border:1.5px solid var(--line);}
    .tab-btn{background:#fff;border:1.5px solid var(--line);color:var(--ink-soft);
        padding:9px 16px;border-radius:8px;font-size:12.5px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .tab-btn:hover{border-color:var(--navy);color:var(--navy);}
    .tab-btn.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .tab-panel{display:none;}
    .tab-panel.active{display:block;}

    .card-block{background:#FAF9F5;border:1.5px solid var(--line);border-radius:12px;
        padding:22px 24px;margin-bottom:18px;}
    .card-block-label{display:flex;align-items:center;gap:10px;margin-bottom:16px;}
    .card-num{width:26px;height:26px;border-radius:8px;background:var(--navy);color:#fff;
        display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;}
    .card-block-label span.txt{font-size:12.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;}

    .mdg-field{margin-bottom:16px;}
    .mdg-field:last-child{margin-bottom:0;}
    .mdg-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;
        letter-spacing:.05em;margin-bottom:8px;display:block;}
    .mdg-field input[type=text],.mdg-field select,.mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);box-sizing:border-box;
    }
    .mdg-field textarea{min-height:80px;resize:vertical;line-height:1.6;}
    .mdg-field input:focus,.mdg-field select:focus,.mdg-field textarea:focus{
        outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

    .mdg-actions{display:flex;justify-content:flex-end;margin-top:30px;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;border:none;
        border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;font-size:13px;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);}

    @media (max-width:640px){ .mdg-row2{grid-template-columns:1fr;} }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM</div>
    <h1 class="mdg-title">Services en Ligne</h1>
    <p class="mdg-sub">Choisis un service ci-dessous, puis modifie sa description, son icône ou son lien.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <div class="tabs">
        @foreach($services as $s)
            <button type="button" class="tab-btn @if($loop->first) active @endif" onclick="switchTab('{{ $loop->index }}', event)">{{ $s['key'] }}</button>
        @endforeach
    </div>

    <form method="POST" action="{{ route('services-en-ligne.update') }}" enctype="multipart/form-data">
        @csrf

        @foreach($services as $i => $s)
            <div id="tab-{{ $i }}" class="tab-panel @if($loop->first) active @endif">

                @if(!$s['ok'])
                    <div class="mdg-alert warn">⚠️ Ce service n'a pas pu être détecté automatiquement dans le fichier.</div>
                @endif

                <div class="card-block">
                    <div class="card-block-label">
                        <span class="card-num">{{ $i + 1 }}</span>
                        <span class="txt">{{ $s['key'] }}</span>
                    </div>

                    <div class="mdg-field">
                        <label class="mdg-label">Description</label>
                        <textarea name="desc[]">{{ $s['desc'] }}</textarea>
                    </div>

                    <div class="mdg-row2">
                        <div class="mdg-field">
                            <label class="mdg-label">Couleur d'accent</label>
                            <select name="accent[]">
                                @foreach(['navy'=>'Navy','blue'=>'Bleu','orange'=>'Orange','green'=>'Vert','gold'=>'Doré'] as $val => $label)
                                    <option value="{{ $val }}" @selected($s['accent'] === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mdg-field">
                            <label class="mdg-label">Icône</label>
                            <select name="icon[]">
                                @foreach(['stamp'=>'Tampon','shield'=>'Bouclier','anchor'=>'Ancre','booklet'=>'Livret','wheel'=>'Barre à roue','gear-ship'=>'Navire/Engrenage','folder'=>'Dossier'] as $val => $label)
                                    <option value="{{ $val }}" @selected($s['icon'] === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mdg-field">
                        <label class="mdg-label">Lien du guichet</label>
                        <input type="text" name="lien[]" value="{{ $s['lien'] }}" placeholder="#">
                    </div>

                    <div class="mdg-field">
                        <label class="mdg-label">Fichier PDF</label>
                        @if(!empty($s['lien']) && str_ends_with(strtolower($s['lien']), '.pdf'))
                            <p style="font-size:12.5px;color:var(--ink-soft);margin:0 0 8px;">
                                Fichier actuel :
                                <a href="{{ asset($s['lien']) }}" target="_blank">{{ basename($s['lien']) }}</a>
                            </p>
                            <label style="font-size:12.5px;color:var(--ink);display:flex;align-items:center;gap:6px;margin-bottom:8px;">
                                <input type="checkbox" name="retirer_fichier[{{ $i }}]" value="1">
                                Retirer ce fichier
                            </label>
                        @endif
                        <input type="file" name="fichier[{{ $i }}]" accept="application/pdf">
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
function switchTab(index, event) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + index).classList.add('active');
    event.target.classList.add('active');
}
</script>

@endsection