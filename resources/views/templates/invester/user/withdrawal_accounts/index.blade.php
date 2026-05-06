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

/* Carte compte */
.account-card {
    background: #fff; border-radius: 0.25rem;
    margin: 0 0.3rem 0.25rem; padding: 0.3rem 0.35rem;
    box-shadow: 0 2px 10px rgba(26,86,219,0.08);
    display: flex; align-items: center; gap: 0.25rem;
}
.account-icon {
    width: 0.9rem; height: 0.9rem; border-radius: 50%;
    background: linear-gradient(135deg, #1a56db, #3b82f6);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 0.38rem;
}
.account-info { flex: 1; min-width: 0; }
.account-label { font-size: 0.28rem; font-weight: 700; color: #1a1a2e; margin-bottom: 0.05rem; }
.account-detail { font-size: 0.24rem; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.account-delete {
    background: #fef2f2; border: none; border-radius: 0.15rem;
    color: #dc2626; font-size: 0.22rem; padding: 0.12rem 0.2rem; cursor: pointer;
    flex-shrink: 0;
}

/* Section titre */
.section-title {
    font-size: 0.28rem; font-weight: 700; color: #1a56db;
    padding: 0 0.3rem 0.15rem; border-left: 4px solid #1a56db;
    margin: 0 0.3rem 0.2rem;
}

/* Formulaire ajout */
.add-card {
    background: #fff; border-radius: 0.25rem;
    margin: 0 0.3rem 0.3rem; padding: 0.35rem;
    box-shadow: 0 2px 10px rgba(26,86,219,0.08);
}
.form-label { font-size: 0.26rem; font-weight: 600; color: #374151; margin-bottom: 0.15rem; margin-top: 0.25rem; display: block; }
.form-label:first-child { margin-top: 0; }

/* Grille pick-btn */
.pick-grid { display: flex; flex-wrap: wrap; gap: 0.15rem; margin-bottom: 0.05rem; }
.pick-btn {
    padding: 0.15rem 0.22rem; border-radius: 0.25rem;
    background: #eef2ff; color: #374151;
    font-size: 0.24rem; font-weight: 600; cursor: pointer;
    border: 2px solid transparent; user-select: none;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
    -webkit-tap-highlight-color: transparent;
}
.pick-btn.active { background: #1a56db; color: #fff; border-color: #1a56db; }
.op-section[hidden] { display: none; }

.form-input {
    width: 100%; border: none; border-bottom: 2px solid #c7d7f7;
    padding: 0.18rem 0; font-size: 0.28rem; color: #222;
    outline: none; background: transparent;
}
.form-input:focus { border-bottom-color: #1a56db; }
.form-input::placeholder { color: #bbb; }

.btn-add {
    width: 100%; height: 1rem; margin-top: 0.3rem;
    background: linear-gradient(135deg, #1a56db, #0e3a8c);
    color: #fff; border: none; border-radius: 0.5rem;
    font-size: 0.30rem; font-weight: 700; cursor: pointer;
    box-shadow: 0 4px 15px rgba(26,86,219,0.3);
}

.empty-box {
    text-align: center; padding: 0.5rem 0.3rem;
    color: #9ca3af; font-size: 0.26rem;
}
.info-box {
    background: #e0e7ff; border-radius: 0.2rem;
    padding: 0.25rem 0.3rem; font-size: 0.24rem; color: #1e40af;
    margin: 0 0.3rem 0.3rem; line-height: 1.6;
}
</style>

<div class="container">
    <div class="header">
        <a href="{{ route('user.home') }}">
            <img src="{{ asset('assets/img/back.png') }}" alt="">
            <span>Mes comptes de retrait</span>
        </a>
    </div>

    <div style="padding: 0 0.3rem 0.2rem;">
        @include($activeTemplate.'partials.alert')
    </div>

    {{-- Liste des comptes enregistrés --}}
    @if($accounts->count())
    <div class="section-title">Comptes enregistrés</div>
    @foreach($accounts as $account)
    <div class="account-card">
        <div class="account-icon">{{ $account->flag }}</div>
        <div class="account-info">
            <div class="account-label">
                {{ $account->label ?: $account->operator }}
            </div>
            <div class="account-detail">
                {{ $account->operator }} · {{ $account->phone }} · {{ $account->country_name }}
            </div>
        </div>
        <form method="post" action="{{ route('user.withdrawal.accounts.destroy', $account->id) }}"
              onsubmit="return confirm('Supprimer ce compte ?')">
            @csrf @method('DELETE')
            <button type="submit" class="account-delete">Supprimer</button>
        </form>
    </div>
    @endforeach
    @else
    <div class="empty-box">Aucun compte enregistré pour l'instant.</div>
    @endif

    <div class="info-box">
        Vous pouvez enregistrer <strong>1 seul compte</strong> Mobile Money.<br>
        Supprimez-le pour en enregistrer un nouveau.
    </div>

    {{-- Formulaire d'ajout --}}
    @if($accounts->count() < 1)
    <div class="section-title">Ajouter un compte</div>
    <div class="add-card">
        <form method="post" action="{{ route('user.withdrawal.accounts.store') }}" id="addForm">
            @csrf

            {{-- Champs cachés remplis par JS --}}
            <input type="hidden" name="country"  id="countryVal">
            <input type="hidden" name="operator" id="operatorVal">

            <label class="form-label">1. Pays</label>
            <div class="pick-grid" id="countryGrid">
                <div class="pick-btn" onclick="pickCountry('CM','🇨🇲 Cameroun',this)">🇨🇲 CM</div>
                <div class="pick-btn" onclick="pickCountry('CI','🇨🇮 Côte d\'Ivoire',this)">🇨🇮 CI</div>
                <div class="pick-btn" onclick="pickCountry('BJ','🇧🇯 Bénin',this)">🇧🇯 BJ</div>
                <div class="pick-btn" onclick="pickCountry('BF','🇧🇫 Burkina',this)">🇧🇫 BF</div>
                <div class="pick-btn" onclick="pickCountry('TG','🇹🇬 Togo',this)">🇹🇬 TG</div>
            </div>

            <div id="opSection" hidden>
                <label class="form-label">2. Opérateur</label>
                <div class="pick-grid" id="operatorGrid"></div>
            </div>

            <label class="form-label" style="margin-top:0.3rem;">3. Numéro Mobile Money</label>
            <input class="form-input" type="tel" name="phone" id="phoneInput"
                   placeholder="Ex : 6XXXXXXXX" maxlength="15" required>

            <label class="form-label">4. Libellé (optionnel)</label>
            <input class="form-input" type="text" name="label"
                   placeholder="Ex : Mon compte MTN principal" maxlength="60">

            <button type="button" class="btn-add" onclick="submitForm()">Enregistrer le compte</button>
        </form>
    </div>
    @endif
</div>

<script>
var opMap = {
    CM: ['MTN Mobile Money', 'Orange Money'],
    CI: ['MTN Mobile Money', 'Orange Money', 'Moov Money', 'Wave'],
    BJ: ['MTN Mobile Money', 'Moov Money'],
    BF: ['Orange Money', 'Moov Money'],
    TG: ['Flooz (Moov)', 'T-Money']
};

function pickCountry(code, label, el) {
    document.querySelectorAll('#countryGrid .pick-btn').forEach(function(b){ b.classList.remove('active'); });
    el.classList.add('active');
    document.getElementById('countryVal').value = code;
    document.getElementById('operatorVal').value = '';
    var grid = document.getElementById('operatorGrid');
    grid.innerHTML = '';
    (opMap[code] || []).forEach(function(op) {
        var btn = document.createElement('div');
        btn.className = 'pick-btn';
        btn.textContent = op;
        btn.onclick = function() { pickOperator(op, this); };
        grid.appendChild(btn);
    });
    document.getElementById('opSection').removeAttribute('hidden');
}

function pickOperator(op, el) {
    document.querySelectorAll('#operatorGrid .pick-btn').forEach(function(b){ b.classList.remove('active'); });
    el.classList.add('active');
    document.getElementById('operatorVal').value = op;
}

function submitForm() {
    var country  = document.getElementById('countryVal').value;
    var operator = document.getElementById('operatorVal').value;
    var phone    = document.getElementById('phoneInput').value.trim();
    if (!country)  { alert('Veuillez sélectionner votre pays.'); return; }
    if (!operator) { alert('Veuillez sélectionner votre opérateur.'); return; }
    if (!phone)    { alert('Veuillez entrer votre numéro.'); return; }
    document.getElementById('addForm').submit();
}
</script>

@endsection
