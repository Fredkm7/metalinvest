@extends($activeTemplate . 'layouts.master')
@section('content')
<style>
.pending-page { background: linear-gradient(160deg, #0e3a8c 0%, #1a56db 50%, #3b82f6 100%); min-height: 100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:0.5rem; }
.pending-card { background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:0.35rem; padding:0.6rem 0.5rem; text-align:center; width:100%; max-width:6rem; }
.pending-icon { font-size:1.2rem; margin-bottom:0.2rem; }
.pending-title { color:#fff; font-size:0.42rem; font-weight:800; margin-bottom:0.1rem; }
.pending-sub { color:rgba(255,255,255,0.75); font-size:0.24rem; line-height:1.6; margin-bottom:0.4rem; }
.pending-amount { font-size:0.7rem; font-weight:900; color:#f59e0b; margin:0.2rem 0; }
.pending-amount span { font-size:0.28rem; color:rgba(255,255,255,0.7); }
.pulse-dot { display:inline-block; width:0.2rem; height:0.2rem; border-radius:50%; background:#22c55e; margin:0 0.06rem; animation:pulse 1.2s infinite; }
.pulse-dot:nth-child(2) { animation-delay:0.2s; }
.pulse-dot:nth-child(3) { animation-delay:0.4s; }
@keyframes pulse { 0%,100%{opacity:0.3;transform:scale(0.8)} 50%{opacity:1;transform:scale(1.2)} }
.home-btn { display:block; width:100%; height:0.9rem; line-height:0.9rem; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; border:none; border-radius:0.45rem; font-size:0.28rem; font-weight:700; text-decoration:none; margin-top:0.4rem; }
.trx-ref { color:rgba(255,255,255,0.4); font-size:0.2rem; margin-top:0.25rem; }
</style>

<div class="pending-page">
    <div class="pending-card">
        <div class="pending-icon">⏳</div>
        <div class="pending-title">Paiement reçu</div>
        <div class="pending-sub">Votre paiement a été transmis avec succès. La confirmation est en cours…</div>
        <div class="pending-amount">
            {{ number_format($deposit->amount, 0, '.', ' ') }}
            <span>FCFA</span>
        </div>
        <div style="margin:0.3rem 0;">
            <span class="pulse-dot"></span>
            <span class="pulse-dot"></span>
            <span class="pulse-dot"></span>
        </div>
        <div class="pending-sub">Votre solde sera crédité automatiquement dans quelques secondes.</div>
        <a href="{{ route('user.home') }}" class="home-btn">Retour à l'accueil</a>
        <div class="trx-ref">Réf : {{ $deposit->trx }}</div>
    </div>
</div>
@endsection
