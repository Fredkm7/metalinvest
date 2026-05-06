@extends($activeTemplate.'layouts.master')
@section('content')
<style>
* { box-sizing: border-box; }
.container { background: #f0f4ff; min-height: 100vh; padding-bottom: 1.8rem; }

.header {
    background: linear-gradient(135deg, #0e3a8c, #1a56db);
    height: 1rem; line-height: 1rem; color: #fff;
    font-size: 0.32rem; padding-left: 0.3rem;
    display: flex; align-items: center; margin-bottom: 0.3rem;
}
.header a { color: #fff; display: flex; align-items: center; gap: 0.15rem; }
.header img { width: 0.36rem; }

.card {
    background: #fff; border-radius: 0.3rem;
    margin: 0 0.3rem 0.3rem; padding: 0.4rem;
    box-shadow: 0 2px 12px rgba(26,86,219,0.1);
}
.card-title {
    font-size: 0.30rem; font-weight: 700; color: #1a56db;
    border-left: 4px solid #1a56db; padding-left: 0.2rem; margin-bottom: 0.3rem;
}

/* Solde */
.balance-box {
    background: linear-gradient(135deg, #1a56db, #0e3a8c);
    border-radius: 0.25rem; padding: 0.35rem 0.4rem;
    margin-bottom: 0.3rem;
    display: flex; justify-content: space-between; align-items: center;
}
.balance-label { color: rgba(255,255,255,0.75); font-size: 0.25rem; }
.balance-amount { color: #fff; font-weight: 800; font-size: 0.38rem; }

/* Compte sélectionnable */
.account-option {
    display: flex; align-items: center; gap: 0.2rem;
    padding: 0.25rem 0.3rem; border-radius: 0.2rem;
    border: 2px solid #e5e7eb; margin-bottom: 0.18rem;
    cursor: pointer;
    transition: border-color 0.15s, background 0.15s;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
}
.account-option.selected { border-color: #1a56db; background: #eef2ff; }
.account-flag { font-size: 0.38rem; flex-shrink: 0; }
.account-info { flex: 1; min-width: 0; }
.account-name { font-size: 0.28rem; font-weight: 700; color: #1a1a2e; }
.account-detail { font-size: 0.22rem; color: #6b7280; margin-top: 0.03rem; }
.account-check {
    width: 0.38rem; height: 0.38rem; border-radius: 50%;
    border: 2px solid #d1d5db; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.account-option.selected .account-check {
    background: #1a56db; border-color: #1a56db;
}
.account-option.selected .account-check::after {
    content: ''; display: block;
    width: 0.16rem; height: 0.16rem; border-radius: 50%; background: #fff;
}

/* Aucun compte */
.no-account-box {
    text-align: center; padding: 0.3rem 0 0.1rem;
    color: #6b7280; font-size: 0.26rem; line-height: 1.8;
}
.btn-add-account {
    display: flex; align-items: center; justify-content: center; gap: 0.12rem;
    background: linear-gradient(135deg, #1a56db, #0e3a8c);
    color: #fff; border-radius: 0.5rem; padding: 0.22rem 0;
    font-size: 0.28rem; font-weight: 700; text-decoration: none;
    margin-top: 0.25rem;
    box-shadow: 0 3px 10px rgba(26,86,219,0.3);
}
.link-manage {
    display: block; text-align: right; color: #1a56db;
    font-size: 0.22rem; margin-top: 0.15rem; text-decoration: underline;
}

/* Montant */
.amount-row {
    display: flex; align-items: center;
    border-bottom: 2px solid #c7d7f7; padding: 0.18rem 0; margin-bottom: 0.1rem;
}
.amount-row input {
    flex: 1; border: none; font-size: 0.36rem; font-weight: 700;
    color: #1a1a2e; outline: none; background: transparent;
}
.amount-row span { font-size: 0.28rem; font-weight: 700; color: #1a56db; }

/* Aperçu frais */
.fee-preview {
    background: #f0f4ff; border-radius: 0.15rem;
    padding: 0.2rem 0.25rem; margin: 0.2rem 0;
    display: none;
}
.fee-row { display: flex; justify-content: space-between; font-size: 0.24rem; padding: 0.06rem 0; }
.fee-label { color: #888; }
.fee-value { font-weight: 700; color: #222; }
.fee-value.green { color: #16a34a; }
.fee-value.red { color: #dc2626; }

/* Mot de passe */
.field-label { font-size: 0.26rem; font-weight: 600; color: #374151; margin: 0.25rem 0 0.12rem; display: block; }
.field-input {
    border: none; border-bottom: 2px solid #c7d7f7;
    width: 100%; padding: 0.18rem 0; font-size: 0.28rem;
    color: #222; outline: none; background: transparent;
}
.field-input:focus { border-bottom-color: #1a56db; }
.field-input::placeholder { color: #bbb; }

.warn-box {
    background: #fef3c7; border-radius: 0.15rem; padding: 0.25rem 0.3rem;
    font-size: 0.24rem; color: #92400e; border-left: 4px solid #f59e0b;
    margin-top: 0.2rem;
}
.set-pw-link { display: block; color: #1a56db; font-size: 0.24rem; margin-top: 0.1rem; font-weight: 700; }

/* Bouton confirmer */
.btn-confirm {
    width: 100%; height: 1.1rem;
    background: linear-gradient(135deg, #1a56db, #0e3a8c);
    color: #fff; border: none; border-radius: 0.55rem;
    font-size: 0.34rem; font-weight: 800; margin-top: 0.4rem;
    box-shadow: 0 4px 15px rgba(26,86,219,0.4); cursor: pointer;
}
.btn-confirm:disabled { opacity: 0.45; cursor: not-allowed; }

/* Alerte jour/heure */
.alert-box {
    background: #fee2e2; border-left: 4px solid #dc2626; border-radius: 0.15rem;
    padding: 0.25rem 0.3rem; font-size: 0.25rem; color: #dc2626;
    margin: 0 0.3rem 0.3rem;
}

/* Règles */
.rules-card {
    background: #fff; border-radius: 0.3rem;
    margin: 0 0.3rem 0.3rem; padding: 0.35rem 0.4rem;
    box-shadow: 0 2px 12px rgba(26,86,219,0.1);
}
.rules-title { font-size: 0.27rem; font-weight: 700; color: #1a56db; margin-bottom: 0.2rem; }
.rule-item { display: flex; gap: 0.12rem; font-size: 0.24rem; color: #555; margin-bottom: 0.12rem; line-height: 1.5; }
</style>

<div class="container">
    <div class="header">
        <a href="{{ route('user.home') }}">
            <img src="{{ asset('assets/img/back.png') }}" alt="">
            <span>Retrait</span>
        </a>
    </div>

    @if($isHoliday && !gs()->holiday_withdraw)
    <div class="alert-box">
        Les retraits ne sont pas disponibles aujourd'hui.<br>
        Prochain jour ouvré : {{ \Carbon\Carbon::parse($nextWorkingDay)->translatedFormat('l d/m') }}.
    </div>
    @endif

    <div style="padding: 0 0.3rem 0.2rem;">
        @include($activeTemplate.'partials.alert')
    </div>

    <form action="{{ route('user.withdraw.money') }}" method="post" id="withdrawForm">
        @csrf

        {{-- Solde disponible --}}
        <div style="margin: 0 0.3rem 0.3rem;">
            <div class="balance-box">
                <div>
                    <div class="balance-label">Solde disponible</div>
                    <div class="balance-amount">{{ showAmount(auth()->user()->interest_wallet, 0) }} {{ $general->cur_text }}</div>
                </div>
                <svg width="0.7rem" height="0.7rem" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            </div>
        </div>

        {{-- Compte de retrait --}}
        <div class="card">
            <div class="card-title">Compte de retrait</div>

            @if($accounts->count())
                @foreach($accounts as $account)
                <div class="account-option" id="opt-{{ $account->id }}" onclick="selectAccount({{ $account->id }})">
                    <input type="radio" name="account_id" value="{{ $account->id }}"
                           id="radio-{{ $account->id }}" style="display:none">
                    <div class="account-flag">{{ $account->flag }}</div>
                    <div class="account-info">
                        <div class="account-name">{{ $account->label ?: $account->operator }}</div>
                        <div class="account-detail">{{ $account->operator }} · {{ $account->phone }} · {{ $account->country_name }}</div>
                    </div>
                    <div class="account-check" id="check-{{ $account->id }}"></div>
                </div>
                @endforeach
                <a href="{{ route('user.withdrawal.accounts.index') }}" class="link-manage">+ Gérer mes comptes</a>
            @else
                <div class="no-account-box">
                    Aucun compte enregistré.<br>Ajoutez votre numéro Mobile Money pour retirer.
                </div>
                <a href="{{ route('user.withdrawal.accounts.index') }}" class="btn-add-account">
                    <svg width="0.32rem" height="0.32rem" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Ajouter un compte de retrait
                </a>
            @endif
        </div>

        {{-- Montant --}}
        <div class="card">
            <div class="card-title">Montant</div>

            @if($method)
            <div class="amount-row">
                <input type="number" name="amount" id="amountInput"
                       placeholder="0"
                       min="{{ $method->min_limit }}"
                       max="{{ $method->max_limit }}"
                       step="any" oninput="updateFees()">
                <span>{{ $general->cur_text }}</span>
            </div>
            <div style="font-size:0.22rem; color:#9ca3af; margin-top:0.08rem;">
                Min : {{ showAmount($method->min_limit, 0) }} · Max : {{ showAmount($method->max_limit, 0) }} {{ $general->cur_text }}
            </div>

            <div class="fee-preview" id="feePreview">
                <div class="fee-row">
                    <span class="fee-label">Montant</span>
                    <span class="fee-value" id="fAmt">—</span>
                </div>
                <div class="fee-row">
                    <span class="fee-label">Frais ({{ $method->percent_charge }}%)</span>
                    <span class="fee-value red" id="fCharge">—</span>
                </div>
                <div class="fee-row">
                    <span class="fee-label">Vous recevez</span>
                    <span class="fee-value green" id="fReceive">—</span>
                </div>
            </div>
            @endif
        </div>

        {{-- Mot de passe de transaction --}}
        <div class="card">
            <div class="card-title">Mot de passe de transaction</div>

            @if(!auth()->user()->transaction_password_set)
                <div class="warn-box">
                    Vous n'avez pas encore défini de mot de passe de transaction.
                    <a href="{{ route('user.transaction.password') }}" class="set-pw-link">Définir maintenant →</a>
                </div>
            @else
                <label class="field-label">Entrez votre mot de passe</label>
                <input class="field-input" type="password" name="transaction_password"
                       placeholder="••••••" required>
            @endif
        </div>

        {{-- Bouton confirmer --}}
        @if(auth()->user()->transaction_password_set && $accounts->count() && $method)
        <div style="padding: 0 0.3rem;">
            <button type="button" class="btn-confirm" id="confirmBtn" onclick="submitWithdraw()">
                Confirmer le retrait
            </button>
        </div>
        @endif
    </form>

    {{-- Règles --}}
    <div class="rules-card" style="margin-top: 0.3rem;">
        <div class="rules-title">Règles de retrait</div>
        @if($method)
        <div class="rule-item"><span>1.</span><span>Montant minimum : <strong>{{ showAmount($method->min_limit, 0) }} {{ $general->cur_text }}</strong></span></div>
        <div class="rule-item"><span>2.</span><span>Frais : <strong>{{ $method->percent_charge }}%</strong></span></div>
        @endif
        <div class="rule-item"><span>3.</span><span>Maximum : <strong>2 retraits par jour</strong></span></div>
        <div class="rule-item"><span>4.</span><span>Disponible : <strong>Lundi – Samedi, 9h00 – 18h00</strong></span></div>
        <div class="rule-item"><span>5.</span><span>Traitement sous <strong>24h ouvrables</strong></span></div>
    </div>
</div>

<script>
@if($method)
var METHOD_FEE_FIXED   = {{ $method->fixed_charge }};
var METHOD_FEE_PCT     = {{ $method->percent_charge }};
var METHOD_RATE        = {{ $method->rate }};
var CUR_TEXT           = '{{ $general->cur_text }}';
@endif

function selectAccount(id) {
    document.querySelectorAll('.account-option').forEach(function(el) {
        el.classList.remove('selected');
    });
    document.getElementById('opt-' + id).classList.add('selected');
    document.getElementById('radio-' + id).checked = true;
}

function updateFees() {
    var amount = parseFloat(document.getElementById('amountInput').value) || 0;
    var preview = document.getElementById('feePreview');
    if (amount <= 0) { preview.style.display = 'none'; return; }
    var charge   = METHOD_FEE_FIXED + (amount * METHOD_FEE_PCT / 100);
    var receive  = (amount - charge) * METHOD_RATE;
    document.getElementById('fAmt').textContent     = amount.toLocaleString('fr') + ' ' + CUR_TEXT;
    document.getElementById('fCharge').textContent  = '- ' + charge.toLocaleString('fr', {maximumFractionDigits:0}) + ' ' + CUR_TEXT;
    document.getElementById('fReceive').textContent = Math.max(0, receive).toLocaleString('fr', {maximumFractionDigits:0}) + ' ' + CUR_TEXT;
    preview.style.display = 'block';
}

function submitWithdraw() {
    var account = document.querySelector('input[name="account_id"]:checked');
    var amount  = parseFloat(document.getElementById('amountInput').value) || 0;
    if (!account) { alert('Veuillez sélectionner un compte de retrait.'); return; }
    if (amount <= 0) { alert('Veuillez entrer un montant.'); return; }
    document.getElementById('withdrawForm').submit();
}
</script>

@endsection
