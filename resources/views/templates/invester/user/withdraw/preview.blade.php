@extends($activeTemplate.'layouts.master')
@section('content')
<style>
* { box-sizing: border-box; }
.container { background:#f0f4ff; min-height:100vh; }
.header { background: linear-gradient(135deg,#0e3a8c,#1a56db); height:1rem; line-height:1rem; color:#fff; font-size:0.32rem; padding-left:0.3rem; display:flex; align-items:center; margin-bottom:0.3rem; }
.header a { color:#fff; display:flex; align-items:center; gap:0.15rem; }
.header img { width:0.36rem; }
.card { background:#fff; border-radius:0.3rem; margin:0 0.3rem 0.3rem; padding:0.4rem; box-shadow:0 2px 12px rgba(26,86,219,0.1); }
.card-title { font-size:0.30rem; font-weight:700; color:#1a56db; border-left:4px solid #1a56db; padding-left:0.2rem; margin-bottom:0.3rem; }
.summary-row { display:flex; justify-content:space-between; align-items:center; padding:0.2rem 0; border-bottom:1px solid #f0f4ff; font-size:0.28rem; }
.summary-row:last-child { border-bottom:none; }
.summary-label { color:#888; }
.summary-value { font-weight:700; color:#222; }
.summary-value.blue { color:#1a56db; }
.summary-value.green { color:#16a34a; }
.summary-value.red { color:#dc2626; }

/* Comptes de retrait */
.account-option {
    display: flex; align-items: center; gap: 0.2rem;
    padding: 0.25rem 0.3rem; border-radius: 0.2rem;
    border: 2px solid #e5e7eb; margin-bottom: 0.2rem;
    cursor: pointer; transition: border-color 0.15s, background 0.15s;
    -webkit-tap-highlight-color: transparent;
}
.account-option.selected { border-color: #1a56db; background: #eef2ff; }
.account-radio { display: none; }
.account-flag { font-size: 0.38rem; flex-shrink: 0; }
.account-info { flex: 1; min-width: 0; }
.account-name { font-size: 0.28rem; font-weight: 700; color: #1a1a2e; }
.account-detail { font-size: 0.23rem; color: #6b7280; margin-top: 0.03rem; }
.account-check {
    width: 0.4rem; height: 0.4rem; border-radius: 50%;
    border: 2px solid #d1d5db; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.15s, border-color 0.15s;
}
.account-option.selected .account-check { background: #1a56db; border-color: #1a56db; }
.account-option.selected .account-check::after { content:''; display:block; width:0.18rem; height:0.18rem; border-radius:50%; background:#fff; }

.no-account-box {
    text-align: center; padding: 0.4rem 0;
    color: #6b7280; font-size: 0.26rem; line-height: 1.8;
}
.btn-add-account {
    display: block; text-align: center;
    background: linear-gradient(135deg,#1a56db,#0e3a8c);
    color: #fff; border-radius: 0.5rem; padding: 0.22rem 0.5rem;
    font-size: 0.28rem; font-weight: 700; text-decoration: none;
    margin: 0.2rem auto 0; width: fit-content;
    box-shadow: 0 3px 10px rgba(26,86,219,0.3);
}
.link-manage {
    display: block; text-align: center; color: #1a56db;
    font-size: 0.24rem; margin-top: 0.2rem; text-decoration: underline;
}

.field-label { font-size:0.28rem; font-weight:600; color:#444; margin-bottom:0.2rem; margin-top:0.3rem; }
.field-input { border:none; border-bottom:2px solid #c7d7f7; width:100%; padding:0.2rem 0; font-size:0.30rem; color:#222; outline:none; background:transparent; }
.field-input:focus { border-bottom-color:#1a56db; }
.field-input::placeholder { color:#bbb; }
.btn-submit { width:100%; height:1.1rem; background:linear-gradient(135deg,#1a56db,#0e3a8c); color:#fff; border:none; border-radius:0.55rem; font-size:0.34rem; font-weight:800; margin-top:0.4rem; box-shadow:0 4px 15px rgba(26,86,219,0.4); }
.warn-box { background:#fef3c7; border-radius:0.2rem; padding:0.3rem; font-size:0.26rem; color:#92400e; margin-bottom:0.3rem; line-height:1.6; border-left:4px solid #f59e0b; }
.set-pw-link { display:block; text-align:center; color:#1a56db; font-size:0.26rem; margin-top:0.2rem; text-decoration:underline; }
.info-box { background:#e0e7ff; border-radius:0.2rem; padding:0.3rem; font-size:0.26rem; color:#1e40af; margin-bottom:0.2rem; line-height:1.6; }
</style>

<div class="container">
    <div class="header">
        <a href="{{ route('user.withdraw.history') }}">
            <img src="{{ asset('assets/img/back.png') }}" alt="">
            <span>Confirmation de retrait</span>
        </a>
    </div>

    <div style="padding:0 0.3rem 0.3rem;">
        @include($activeTemplate.'partials.alert')
    </div>

    {{-- Récapitulatif --}}
    <div class="card">
        <div class="card-title">Récapitulatif</div>
        <div class="summary-row">
            <span class="summary-label">Méthode</span>
            <span class="summary-value blue">{{ $withdraw->method->name }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Montant demandé</span>
            <span class="summary-value">{{ showAmount($withdraw->amount, 0) }} {{ $general->cur_text }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Frais ({{ $withdraw->method->percent_charge }}%)</span>
            <span class="summary-value red">- {{ showAmount($withdraw->charge, 0) }} {{ $general->cur_text }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Après frais</span>
            <span class="summary-value">{{ showAmount($withdraw->after_charge, 0) }} {{ $general->cur_text }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Vous recevez</span>
            <span class="summary-value green">{{ showAmount($withdraw->final_amount, 0) }} {{ $withdraw->currency }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Traitement</span>
            <span class="summary-value">Lundi – Samedi (24h)</span>
        </div>
    </div>

    <div class="info-box" style="margin:0 0.3rem 0.3rem;">
        Le retrait sera traité sous 24h ouvrables (Lun–Sam)
    </div>

    <form action="{{ route('user.withdraw.submit') }}" method="post" id="withdrawForm">
        @csrf

        {{-- Sélection du compte de retrait --}}
        <div class="card">
            <div class="card-title">Compte de retrait</div>

            @if($accounts->count())
                @foreach($accounts as $account)
                <div class="account-option" id="opt-{{ $account->id }}" onclick="selectAccount({{ $account->id }})">
                    <input type="radio" class="account-radio" name="account_id"
                           value="{{ $account->id }}" id="radio-{{ $account->id }}">
                    <div class="account-flag">{{ $account->flag }}</div>
                    <div class="account-info">
                        <div class="account-name">{{ $account->label ?: $account->operator }}</div>
                        <div class="account-detail">{{ $account->operator }} · {{ $account->phone }} · {{ $account->country_name }}</div>
                    </div>
                    <div class="account-check" id="check-{{ $account->id }}"></div>
                </div>
                @endforeach

                <a href="{{ route('user.withdrawal.accounts.index') }}" class="link-manage">
                    + Gérer mes comptes de retrait
                </a>
            @else
                <div class="no-account-box">
                    Vous n'avez aucun compte de retrait enregistré.<br>
                    Ajoutez-en un pour pouvoir retirer.
                </div>
                <a href="{{ route('user.withdrawal.accounts.index') }}" class="btn-add-account">
                    + Ajouter un compte de retrait
                </a>
            @endif
        </div>

        {{-- Mot de passe de transaction --}}
        <div class="card">
            <div class="card-title">Mot de passe de transaction</div>
            @if(!auth()->user()->transaction_password_set)
                <div class="warn-box">
                    Vous n'avez pas encore défini de mot de passe de transaction.
                    Définissez-le avant de retirer.
                </div>
                <a href="{{ route('user.transaction.password') }}" class="set-pw-link">→ Définir mon mot de passe de transaction</a>
            @else
                <div class="field-label">Entrez votre mot de passe de transaction</div>
                <input class="field-input" type="password" name="transaction_password" placeholder="Mot de passe de transaction" required>
                <a href="{{ route('user.transaction.password') }}" class="set-pw-link">Mot de passe oublié ? Contactez le service client</a>
            @endif
        </div>

        @if(auth()->user()->transaction_password_set && $accounts->count())
        <div style="padding:0 0.3rem 1.8rem;">
            <button type="button" class="btn-submit" onclick="submitWithdraw()">Confirmer le retrait</button>
        </div>
        @endif
    </form>
</div>

<script>
function selectAccount(id) {
    // Désélectionner tous
    document.querySelectorAll('.account-option').forEach(function(el) {
        el.classList.remove('selected');
    });
    // Sélectionner celui cliqué
    document.getElementById('opt-' + id).classList.add('selected');
    document.getElementById('radio-' + id).checked = true;
}

function submitWithdraw() {
    var checked = document.querySelector('input[name="account_id"]:checked');
    if (!checked) {
        alert('Veuillez sélectionner un compte de retrait.');
        return;
    }
    document.getElementById('withdrawForm').submit();
}
</script>

@endsection
