@extends($activeTemplate.'layouts.master')
@section('content')

<style>
    .container {
        background: #FFFFFF;
        padding-bottom: 0.94rem;
    }
    .header {
        background: #ffffff;
        height: 1rem;
        line-height: 1rem;
        color: #131A22;
        font-size: 0.32rem;
        z-index: 3;
        margin-bottom: 0.3rem;
        border-bottom: #d5d5d7 1px solid;
        padding-left: 0.3rem;
    }
    .header .img-box {
        height: 100%;
        display: flex;
        align-items: center;
        padding-right: 0.26rem;
    }
    .header img {
        width: 0.36rem;
    }
    .continue {
        margin-top: 0.16rem;
        margin-bottom: 0.6rem;
    }
    .continue div, .continue button {
        height: 1.0rem;
        line-height: 1.0rem;
        text-align: center;
        background: #3586ff;
        border-radius: 0.1rem;
        font-weight: 500;
        color: #FFFFFF;
        font-size: 0.32rem;
        width: 100%;
        border: 0px;
    }
    .content {
        padding: 0 0.6rem;
    }
    .amoun {
        background: url("{{ asset('core/recharge.png') }}") no-repeat;
        background-size: contain;
        height: 3.4rem;
        margin-top: -0.8rem;
        display: flex;
        justify-content: space-between;
    }
    .amoun .left {
        font-weight: 300;
        color: #132215;
        font-size: 0.36rem;
        padding-top: 1.48rem;
        padding-left: 0.64rem;
        line-height: 0.42rem;
    }
    .amoun .num {
        font-weight: 500;
        color: #FFFFFF;
        font-size: 0.48rem;
        display: flex;
        align-items: center;
        line-height: 0.56rem;
        margin-top: 0.06rem;
    }
    .input-container {
        margin: 0.52rem 0.26rem;
    }
    .input-container p {
        font-size: 0.32rem;
        font-weight: 500;
        color: #131A22;
    }
    .input-box {
        border-bottom: 0.02rem solid rgba(234, 235, 237, 0.8);
        flex: 1;
    }
    input[type=text], input[type=number] {
        border: none;
        padding: 0.3rem 0;
        height: 0.38rem;
        width: 100%;
        outline: none;
        font-weight: 400;
        color: #131A22;
        font-size: 0.32rem;
        line-height: 0.38rem;
    }
    input::placeholder {
        color: #B8B8B8;
        font-size: 0.32rem;
    }
    .amount-tk {
        display: flex;
        font-weight: 500;
        color: #2d2d2d;
        font-size: 0.4rem;
        align-items: center;
        justify-content: space-between;
    }
    .list {
        display: flex;
        flex-wrap: wrap;
        font-size: 0.36rem;
        color: #848487;
        font-weight: 500;
    }
    .list div {
        height: 0.8rem;
        line-height: 0.8rem;
        border-radius: 0.1rem;
        width: 30%;
        text-align: center;
        margin-bottom: 0.32rem;
        background: #eeedf3;
        cursor: pointer;
    }
    .list div:not(:nth-child(3n)) {
        margin-right: 0.3rem;
    }
    .list div.active {
        background: #3586ff;
        color: #fff;
    }


    .introduce {
        background: #FFFFFF;
        box-shadow: 0 0 0.4rem 0 rgba(0,0,0,0.05);
        border-radius: 0.4rem;
        padding: 0.32rem 0.48rem;
        color: #7A9283;
        font-size: 0.2rem;
        line-height: 0.46rem;
        word-wrap: break-word;
        margin: 0 0.26rem;
    }
    .introduce .title {
        color: #486252;
        line-height: 0.33rem;
        font-size: 0.28rem;
        margin-bottom: 0.14rem;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="header">
        <a href="{{ route('user.home') }}">
            <div class="img-box">
                <img src="{{ asset('assets/img/back.png') }}" alt=""> &nbsp; <span>Recharge</span>
            </div>
        </a>
    </div>

    <div class="content">
        <div class="amoun">
            <div class="left">
                <p>Solde disponible</p>
                <p class="num">
                    {{ number_format(auth()->user()->deposit_wallet + auth()->user()->interest_wallet, 0, ',', ' ') }}
                    {{ $general->cur_text }}
                </p>
            </div>
        </div>

        <form action="{{ route('user.deposit.westpay.initiate') }}" method="post">
            @csrf

            <div class="input-container">
                <p>Montant</p>
                <div class="amount-tk">
                    <div class="input-box">
                        <input id="amountInput" name="amount" type="number"
                               placeholder="Entrez le montant"
                               min="{{ config('westpay.min_amount', 3000) }}"
                               max="{{ config('westpay.max_amount', 500000) }}"
                               value="{{ old('amount') }}" required>
                    </div>
                    <span>{{ $general->cur_text }}</span>
                </div>
            </div>

            <div class="list" style="margin: 0 0.26rem 0.3rem;">
                @foreach([3000, 5000, 10000, 20000, 50000, 100000, 200000, 500000] as $q)
                <div onclick="setAmount({{ $q }}, this)">{{ number_format($q, 0, '.', ' ') }}</div>
                @endforeach
            </div>

            <div class="continue" style="margin: 0 0.26rem 0.4rem;">
                <button type="submit">Continuer</button>
            </div>
        </form>

        <div class="introduce">
            <div class="title">Informations</div>
            <p>• Dépôt instantané crédité automatiquement sur votre compte.</p>
            <p>• Montant minimum : {{ number_format(config('westpay.min_amount', 3000), 0, '.', ' ') }} FCFA.</p>
            <p>• Montant maximum : {{ number_format(config('westpay.max_amount', 500000), 0, '.', ' ') }} FCFA.</p>
            <p>• Aucun frais de dépôt.</p>
            <p>• Paiement sécurisé (SSL).</p>
            <p>• Disponible 24h/24, 7j/7.</p>
            <p>• En cas de problème, contactez notre support client.</p>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
function setAmount(val, el) {
    document.getElementById('amountInput').value = val;
    document.querySelectorAll('.list div').forEach(d => d.classList.remove('active'));
    el.classList.add('active');
}
</script>
@endpush
