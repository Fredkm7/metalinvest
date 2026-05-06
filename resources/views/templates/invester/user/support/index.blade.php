@extends($activeTemplate . 'layouts.master')
@section('content')
<style>
.chat-page { background:#0e1a35; min-height:100vh; display:flex; flex-direction:column; }
.chat-topbar { display:flex; align-items:center; justify-content:space-between; padding:0.3rem 0.3rem; background:linear-gradient(135deg,#0e3a8c,#1a56db); border-bottom:1px solid rgba(255,255,255,0.1); }
.chat-topbar-left { display:flex; align-items:center; gap:0.2rem; }
.chat-topbar-left a { color:#fff; display:flex; align-items:center; }
.chat-topbar-left img { width:0.36rem; }
.chat-topbar-title { color:#fff; font-size:0.32rem; font-weight:700; margin-left:0.1rem; }
.chat-topbar-sub { color:rgba(255,255,255,0.6); font-size:0.22rem; }
.new-btn { background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; border:none; border-radius:0.4rem; padding:0.15rem 0.3rem; font-size:0.25rem; font-weight:700; text-decoration:none; white-space:nowrap; }

.conv-list { flex:1; padding:0.2rem 0.3rem; }
.conv-item { display:flex; align-items:center; gap:0.25rem; padding:0.25rem 0; border-bottom:1px solid rgba(255,255,255,0.07); text-decoration:none; }
.conv-item:last-child { border-bottom:none; }
.conv-avatar { width:0.8rem; height:0.8rem; border-radius:50%; background:linear-gradient(135deg,#1a56db,#3b82f6); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.conv-avatar svg { width:0.45rem; height:0.45rem; }
.conv-body { flex:1; min-width:0; }
.conv-name { color:#fff; font-size:0.28rem; font-weight:700; }
.conv-preview { color:rgba(255,255,255,0.5); font-size:0.22rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-top:0.03rem; }
.conv-right { text-align:right; flex-shrink:0; }
.conv-time { color:rgba(255,255,255,0.4); font-size:0.2rem; }
.conv-dot { width:0.16rem; height:0.16rem; border-radius:50%; background:#22c55e; margin:0.06rem 0 0 auto; }
.conv-dot.closed { background:#6b7280; }
.conv-dot.replied { background:#f59e0b; }

.empty-state { text-align:center; color:rgba(255,255,255,0.5); padding:2rem 0.5rem; font-size:0.28rem; line-height:1.8; }
</style>

<div class="chat-page">
    <div class="chat-topbar">
        <div class="chat-topbar-left">
            <a href="{{ route('user.home') }}"><img src="{{ asset('assets/img/back.png') }}" alt=""></a>
            <div>
                <div class="chat-topbar-title">Support Client</div>
                <div class="chat-topbar-sub">Nous répondons rapidement</div>
            </div>
        </div>
        <a href="{{ route('ticket.open') }}" class="new-btn">+ Nouveau</a>
    </div>

    <div class="conv-list">
        @forelse($supports as $conv)
        <a href="{{ route('ticket.view', $conv->ticket) }}" class="conv-item">
            <div class="conv-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <div class="conv-body">
                <div class="conv-name">{{ $conv->subject }}</div>
                <div class="conv-preview">{{ $conv->last_reply ? \Carbon\Carbon::parse($conv->last_reply)->diffForHumans() : $conv->created_at->diffForHumans() }}</div>
            </div>
            <div class="conv-right">
                <div class="conv-time">›</div>
                @php
                    $dotClass = 'conv-dot';
                    if ($conv->status == 3) $dotClass .= ' closed';
                    elseif ($conv->status == 2) $dotClass .= ' replied';
                @endphp
                <div class="{{ $dotClass }}"></div>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <p>Aucune conversation pour l'instant.</p>
            <p>Appuyez sur <strong style="color:#f59e0b;">+ Nouveau</strong> pour nous contacter.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
