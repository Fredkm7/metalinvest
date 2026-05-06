@extends($activeTemplate . 'layouts.master')
@section('content')
<style>
.pay-page { background: linear-gradient(160deg, #0e3a8c 0%, #1a56db 50%, #3b82f6 100%); min-height: 100vh; padding-bottom: 2rem; }
.pay-header { display:flex; align-items:center; gap:0.2rem; padding:0.3rem; color:#fff; }
.pay-header a { color:#fff; display:flex; align-items:center; }
.pay-header img { width:0.36rem; }
.pay-header-title { font-size:0.32rem; font-weight:700; }

.pay-hero { text-align:center; padding:0.5rem 0.3rem 0.3rem; }
.pay-hero-icon { font-size:1rem; margin-bottom:0.1rem; }
.pay-hero-title { color:#fff; font-size:0.46rem; font-weight:800; text-shadow:0 2px 10px rgba(0,0,0,0.3); }
.pay-hero-sub { color:rgba(255,255,255,0.75); font-size:0.24rem; margin-top:0.05rem; }

.operators-row { display:flex; justify-content:center; gap:0.2rem; padding:0.2rem 0.3rem 0.4rem; flex-wrap:wrap; }
.op-badge { background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25); border-radius:0.3rem; padding:0.1rem 0.25rem; color:#fff; font-size:0.22rem; font-weight:600; }

.pay-card { background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:0.3rem; margin:0 0.3rem; padding:0.4rem; }

.amount-label { color:rgba(255,255,255,0.8); font-size:0.26rem; margin-bottom:0.2rem; display:block; }
.amount-input-wrap { display:flex; align-items:center; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.3); border-radius:0.2rem; padding:0 0.25rem; margin-bottom:0.25rem; }
.amount-currency { color:rgba(255,255,255,0.6); font-size:0.28rem; font-weight:700; padding-right:0.15rem; border-right:1px solid rgba(255,255,255,0.2); margin-right:0.15rem; }
.amount-input { flex:1; background:transparent; border:none; color:#fff; font-size:0.4rem; font-weight:700; padding:0.22rem 0; outline:none; }
.amount-input::placeholder { color:rgba(255,255,255,0.3); font-weight:400; font-size:0.3rem; }

.quick-amounts { display:flex; gap:0.15rem; flex-wrap:wrap; margin-bottom:0.3rem; }
.qa-btn { background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.25); border-radius:0.4rem; color:#fff; font-size:0.24rem; font-weight:600; padding:0.1rem 0.25rem; cursor:pointer; }
.qa-btn:active, .qa-btn.active { background:#f59e0b; border-color:#f59e0b; }

.pay-limit { color:rgba(255,255,255,0.5); font-size:0.2rem; text-align:center; margin-bottom:0.25rem; }

.pay-btn { display:block; width:100%; height:1rem; line-height:1rem; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; border:none; border-radius:0.5rem; font-size:0.32rem; font-weight:800; text-align:center; cursor:pointer; box-shadow:0 4px 20px rgba(245,158,11,0.4); margin-top:0.1rem; }

.info-box { background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); border-radius:0.2rem; padding:0.25rem 0.3rem; margin:0.3rem 0.3rem 0; }
.info-row { display:flex; justify-content:space-between; align-items:center; padding:0.1rem 0; border-bottom:1px solid rgba(255,255,255,0.07); }
.info-row:last-child { border-bottom:none; }
.info-key { color:rgba(255,255,255,0.6); font-size:0.22rem; }
.info-val { color:#fff; font-size:0.22rem; font-weight:600; }
.info-val.green { color:#22c55e; }
</style>

<div class="pay-page">
    <div class="pay-header">
        <a href="{{ route('user.home') }}"><img src="{{ asset('assets/img/back.png') }}" alt=""></a>
        <span class="pay-header-title">Recharger mon compte</span>
    </div>

    <div class="pay-hero">
        <div class="pay-hero-icon">💳</div>
        <div class="pay-hero-title">Mobile Money</div>
        <div class="pay-hero-sub">Paiement sécurisé via WestPay</div>
    </div>

    <div class="operators-row">
        <span class="op-badge">🇹🇬 TMoney</span>
        <span class="op-badge">🇹🇬 Moov</span>
        <span class="op-badge">🇧🇯 MTN</span>
        <span class="op-badge">🇧🇯 Moov</span>
        <span class="op-badge">🇸🇳 Wave</span>
        <span class="op-badge">🇨🇮 Orange</span>
    </div>

    <div class="pay-card">
        <form action="{{ route('user.deposit.westpay.initiate') }}" method="post" id="payForm">
            @csrf
            <label class="amount-label">Montant à déposer</label>
            <div class="amount-input-wrap">
                <span class="amount-currency">FCFA</span>
                <input type="number" name="amount" id="amountInput" class="amount-input"
                    placeholder="ex: 5 000"
                    min="{{ $min }}" max="{{ $max }}"
                    value="{{ old('amount') }}" required>
            </div>

            <div class="quick-amounts">
                @foreach([1000, 2000, 5000, 10000, 25000, 50000] as $q)
                <button type="button" class="qa-btn" onclick="setAmount({{ $q }})">
                    {{ number_format($q, 0, '.', ' ') }}
                </button>
                @endforeach
            </div>

            <div class="pay-limit">Min : {{ number_format($min, 0, '.', ' ') }} FCFA &nbsp;·&nbsp; Max : {{ number_format($max, 0, '.', ' ') }} FCFA</div>

            <button type="submit" class="pay-btn">Payer maintenant →</button>
        </form>
    </div>

    <div class="info-box">
        <div class="info-row">
            <span class="info-key">Frais</span>
            <span class="info-val green">Gratuit</span>
        </div>
        <div class="info-row">
            <span class="info-key">Crédit immédiat</span>
            <span class="info-val green">Oui</span>
        </div>
        <div class="info-row">
            <span class="info-key">Sécurité</span>
            <span class="info-val">Chiffrement SSL</span>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
function setAmount(val) {
    document.getElementById('amountInput').value = val;
    document.querySelectorAll('.qa-btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
}
</script>
@endpush
