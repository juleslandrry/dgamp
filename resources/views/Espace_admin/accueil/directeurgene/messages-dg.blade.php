@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340;
        --navy-2:#123A63;
        --blue:#1E7FB8;
        --blue-soft:#E4F2FA;
        --orange:#E8720C;
        --orange-soft:#FDEEE0;
        --green:#1F7A4D;
        --green-soft:#E5F5EC;
        --gold:#C9A227;
        --gold-soft:#FBF3DD;
        --ink:#1C2733;
        --ink-soft:#66707B;
        --line:#E7E2D6;
    }

    .mdg-wrap{max-width:1100px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);margin:0 0 20px;letter-spacing:-.01em;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}

    /* Onglets destination */
    .msg-tabs{display:flex;gap:8px;margin-bottom:22px;background:#fff;padding:10px;
        border-radius:12px;border:1.5px solid var(--line);width:fit-content;}
    .msg-tab{background:#fff;border:1.5px solid var(--line);color:var(--ink-soft);
        padding:9px 18px;border-radius:8px;font-size:13px;font-weight:700;cursor:pointer;
        transition:.15s ease;text-decoration:none;display:inline-flex;align-items:center;gap:8px;}
    .msg-tab:hover{border-color:var(--navy);color:var(--navy);}
    .msg-tab.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .msg-tab-count{background:rgba(255,255,255,.25);border-radius:20px;padding:1px 8px;font-size:11px;}
    .msg-tab:not(.active) .msg-tab-count{background:var(--gold-soft);color:#8A6D14;}

    /* Table des messages */
    .msg-table-wrap{background:#fff;border:1.5px solid var(--line);border-radius:12px;overflow:hidden;
        box-shadow:0 4px 16px rgba(11,35,64,.05);}

    .msg-table{width:100%;border-collapse:collapse;font-size:13.5px;}
    .msg-table thead th{background:var(--blue-soft);color:var(--navy);text-transform:uppercase;
        font-size:11px;letter-spacing:.05em;font-weight:700;padding:14px 16px;text-align:left;
        border-bottom:2px solid var(--line);}

    .msg-table tbody tr{border-bottom:1px solid var(--line);transition:.15s ease;}
    .msg-table tbody tr:last-child{border-bottom:none;}
    .msg-table tbody tr:hover{background:#FAFAF7;}
    .msg-table tbody tr.unread{background:var(--gold-soft);}
    .msg-table tbody tr.unread:hover{background:#F7EBC9;}

    .msg-table td{padding:14px 16px;vertical-align:top;color:var(--ink);}

    .msg-status{display:inline-flex;align-items:center;gap:6px;font-weight:700;font-size:11.5px;}
    .msg-status.new{color:var(--gold);}
    .msg-status.read{color:var(--green);}
    .msg-dot{width:7px;height:7px;border-radius:50%;background:currentColor;flex-shrink:0;}

    .msg-dest{display:inline-block;font-size:10.5px;font-weight:700;padding:2px 9px;border-radius:20px;
        text-transform:uppercase;letter-spacing:.03em;margin-top:4px;}
    .msg-dest.dg{background:var(--blue-soft);color:var(--blue);}
    .msg-dest.dgamp{background:var(--orange-soft);color:var(--orange);}

    .msg-subject{font-weight:600;color:var(--navy);}
    .msg-excerpt{color:var(--ink-soft);font-size:12.5px;max-width:320px;}

    .msg-date{color:var(--ink-soft);font-size:12px;white-space:nowrap;}

    .msg-actions{display:flex;gap:8px;white-space:nowrap;}
    .msg-btn{border:none;border-radius:6px;padding:7px 13px;font-weight:700;cursor:pointer;
        font-size:11.5px;letter-spacing:.02em;transition:.15s ease;}
    .msg-btn-read{background:var(--blue-soft);color:var(--blue);}
    .msg-btn-read:hover{background:var(--blue);color:#fff;}
    .msg-btn-delete{background:var(--orange-soft);color:var(--orange);}
    .msg-btn-delete:hover{background:var(--orange);color:#fff;}

    .msg-empty{padding:50px 20px;text-align:center;color:var(--ink-soft);font-size:14px;}

    .msg-pagination{margin-top:22px;}

    @media (max-width: 720px){
        .msg-table{font-size:12.5px;}
        .msg-excerpt{max-width:160px;}
        .msg-table thead{display:none;}
        .msg-table, .msg-table tbody, .msg-table tr, .msg-table td{display:block;width:100%;}
        .msg-table tbody tr{padding:12px 16px;}
        .msg-table td{padding:4px 0;border:none;}
        .msg-tabs{width:100%;overflow-x:auto;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Directeur Général</div>
    <h1 class="mdg-title">Messages</h1>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    {{-- ===== ONGLETS PAR DESTINATION ===== --}}
    <div class="msg-tabs">
        <a href="{{ route('messagesdg.index') }}" class="msg-tab {{ !$filter ? 'active' : '' }}">
            Tous
            <span class="msg-tab-count">{{ $totalTous ?? '' }}</span>
        </a>
        <a href="{{ route('messagesdg.index', ['destination' => 'dg']) }}" class="msg-tab {{ $filter === 'dg' ? 'active' : '' }}">
            Message au DG
        </a>
        <a href="{{ route('messagesdg.index', ['destination' => 'dgamp']) }}" class="msg-tab {{ $filter === 'dgamp' ? 'active' : '' }}">
            Message à la DGAMP
        </a>
    </div>

    <div class="msg-table-wrap">
        @if($messages->count() > 0)
            <table class="msg-table">
                <thead>
                    <tr>
                        <th>Statut</th>
                        <th>Expéditeur</th>
                        <th>Objet / Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr class="{{ !$msg->lu ? 'unread' : '' }}">
                            <td>
                                @if($msg->lu)
                                    <span class="msg-status read"><span class="msg-dot"></span>Lu</span>
                                @else
                                    <span class="msg-status new"><span class="msg-dot"></span>Nouveau</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight:600;color:var(--navy);">{{ $msg->name }}</div>
                                <div style="color:var(--ink-soft);font-size:12px;">{{ $msg->email }}</div>
                                <span class="msg-dest {{ $msg->destination }}">
                                    {{ $msg->destination === 'dg' ? 'Message au DG' : 'Message à la DGAMP' }}
                                </span>
                            </td>
                            <td>
                                <div class="msg-subject">{{ $msg->subject ?? 'Sans objet' }}</div>
                                <div class="msg-excerpt">{{ Str::limit($msg->message, 100) }}</div>
                            </td>
                            <td class="msg-date">{{ $msg->created_at->format('d/m/Y à H:i') }}</td>
                            <td>
                                <div class="msg-actions">
                                    @if(!$msg->lu)
                                        <form action="{{ route('messagesdg.read', $msg->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="msg-btn msg-btn-read">Marquer lu</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('messagesdg.destroy', $msg->id) }}" method="POST"
                                          onsubmit="return confirm('Supprimer ce message définitivement ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="msg-btn msg-btn-delete">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="msg-empty">Aucun message reçu pour le moment.</div>
        @endif
    </div>

    <div class="msg-pagination">
        {{ $messages->links() }}
    </div>
</div>

@endsection