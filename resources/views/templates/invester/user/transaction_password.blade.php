@extends($activeTemplate . 'layouts.master')
@section('content')
<style>
.container { background:#f6f7fb; min-height:100vh; }
.header { background:#1a56db; height:1rem; line-height:1rem; color:#fff; font-size:0.32rem; padding-left:0.3rem; margin-bottom:0.3rem; display:flex; align-items:center; }
.header a { color:#fff; display:flex; align-items:center; gap:0.2rem; }
.header img { width:0.36rem; }
.card { background:#fff; border-radius:0.3rem; margin:0 0.3rem 0.3rem; padding:0.5rem; box-shadow:0 2px 10px rgba(26,86,219,0.08); }
.card-title { font-size:0.36rem; font-weight:700; color:#1a56db; margin-bottom:0.1rem; }
.card-sub { font-size:0.26rem; color:#888; margin-bottom:0.4rem; }
.field-label { font-size:0.28rem; font-weight:600; color:#333; margin-bottom:0.1rem; }
.field-input { border:none; border-bottom:2px solid #e0e7ff; width:100%; padding:0.2rem 0; font-size:0.32rem; color:#222; outline:none; background:transparent; margin-bottom:0.3rem; }
.field-input::placeholder { color:#bbb; }
.btn-primary { background:#1a56db; color:#fff; border:none; width:100%; height:1rem; border-radius:0.5rem; font-size:0.32rem; font-weight:700; margin-top:0.2rem; }
.alert-info { background:#e0e7ff; border-radius:0.2rem; padding:0.3rem; font-size:0.26rem; color:#1a56db; margin-bottom:0.4rem; line-height:1.6; }
.badge-set { background:#16a34a; color:#fff; padding:0.1rem 0.3rem; border-radius:0.2rem; font-size:0.24rem; display:inline-block; margin-bottom:0.3rem; }
.badge-unset { background:#ef4444; color:#fff; padding:0.1rem 0.3rem; border-radius:0.2rem; font-size:0.24rem; display:inline-block; margin-bottom:0.3rem; }
</style>

<div class="container">
    <div class="header">
        <a href="{{ route('user.profile.setting') }}">
            <img src="{{ asset('assets/img/back.png') }}" alt="">
            <span>Mot de passe de transaction</span>
        </a>
    </div>

    <div style="padding:0 0.3rem 0.3rem;">
        @include($activeTemplate.'partials.alert')
    </div>

    <div class="card">
        <div class="card-title">Mot de passe de transaction</div>
        @if($user->transaction_password_set)
            <span class="badge-set">Défini</span>
            <div class="alert-info">
                Votre mot de passe de transaction est déjà configuré.<br><br>
                Pour le modifier, veuillez contacter notre <strong>service client</strong> via le chat ou Telegram.<br>
                Ce mot de passe protège toutes vos demandes de retrait.
            </div>
            <a href="{{ route('ticket.open') }}" style="display:block; background:#0e3a8c; color:#fff; text-align:center; padding:0.3rem; border-radius:0.5rem; font-size:0.30rem; font-weight:700; margin-bottom:0.2rem;">
                Contacter le service client
            </a>
        @else
            <span class="badge-unset">✗ Non défini</span>
            <div class="alert-info">
                Définissez un mot de passe de transaction pour sécuriser vos retraits.<br>
                Ce mot de passe ne pourra être modifié qu'en contactant le service client.
            </div>
            <form action="{{ route('user.transaction.password.set') }}" method="POST">
                @csrf
                <div class="field-label">Nouveau mot de passe (min. 6 caractères)</div>
                <input class="field-input" type="password" name="transaction_password" placeholder="Entrez un mot de passe" required minlength="6">
                <div class="field-label">Confirmer le mot de passe</div>
                <input class="field-input" type="password" name="transaction_password_confirmation" placeholder="Confirmez le mot de passe" required minlength="6">
                <button type="submit" class="btn-primary">Définir le mot de passe</button>
            </form>
        @endif
    </div>
</div>
@endsection
