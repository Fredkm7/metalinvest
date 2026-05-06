@extends($activeTemplate.'layouts.master')
@section('content')
   

<style>
.mi-hero {
    background: linear-gradient(160deg, #0a2463 0%, #1a56db 100%);
    padding: 0.5rem 0.4rem 0;
    position: relative;
    overflow: hidden;
}
.mi-hero::after {
    content: '';
    position: absolute;
    top: -1rem;
    right: -1rem;
    width: 4rem;
    height: 4rem;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
}
.mi-hero-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.4rem;
}
.mi-logo-text {
    font-size: 0.32rem;
    font-weight: 700;
    color: rgba(255,255,255,0.9);
    letter-spacing: 0.08rem;
    text-transform: uppercase;
}
.mi-logo-sub {
    font-size: 0.2rem;
    color: rgba(255,255,255,0.5);
    letter-spacing: 0.04rem;
    margin-top: 0.04rem;
}
.mi-greeting {
    font-size: 0.24rem;
    color: rgba(255,255,255,0.6);
    text-align: right;
}
.mi-username {
    font-size: 0.3rem;
    color: #fff;
    font-weight: 600;
    text-align: right;
    margin-top: 0.02rem;
}
.mi-balance-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 0.2rem;
    padding: 0.35rem 0.4rem;
    margin-bottom: 0.4rem;
}
.mi-balance-label {
    font-size: 0.22rem;
    color: rgba(255,255,255,0.55);
    letter-spacing: 0.02rem;
    text-transform: uppercase;
}
.mi-balance-amount {
    font-size: 0.72rem;
    font-weight: 300;
    color: #fff;
    letter-spacing: -0.01rem;
    margin-top: 0.06rem;
    line-height: 1;
}
.mi-balance-currency {
    font-size: 0.28rem;
    color: rgba(255,255,255,0.6);
    margin-left: 0.1rem;
    font-weight: 400;
}
.mi-sub-balances {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.25rem;
    padding-top: 0.2rem;
    border-top: 1px solid rgba(255,255,255,0.1);
}
.mi-sub-bal {
    flex: 1;
}
.mi-sub-label { font-size: 0.2rem; color: rgba(255,255,255,0.45); }
.mi-sub-value { font-size: 0.26rem; color: rgba(255,255,255,0.85); font-weight: 500; margin-top: 0.03rem; }

.mi-slides {
    display: flex;
    gap: 0.2rem;
    overflow-x: auto;
    scrollbar-width: none;
    padding-bottom: 0.4rem;
}
.mi-slides::-webkit-scrollbar { display: none; }
.mi-slide {
    flex-shrink: 0;
    width: 5.5rem;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 0.16rem;
    padding: 0.28rem 0.3rem;
}
.mi-slide-tag {
    font-size: 0.18rem;
    color: rgba(255,255,255,0.5);
    text-transform: uppercase;
    letter-spacing: 0.04rem;
    margin-bottom: 0.1rem;
}
.mi-slide-title {
    font-size: 0.3rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 0.06rem;
}
.mi-slide-desc {
    font-size: 0.22rem;
    color: rgba(255,255,255,0.6);
    line-height: 1.5;
}
.mi-slide-highlight {
    display: inline-block;
    margin-top: 0.1rem;
    font-size: 0.22rem;
    color: #93c5fd;
    font-weight: 500;
}

.mi-actions {
    background: #fff;
    padding: 0.35rem 0.3rem;
    display: flex;
    justify-content: space-around;
    border-bottom: 1px solid #f1f5f9;
}
.mi-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    gap: 0.12rem;
}
.mi-action-icon {
    width: 0.9rem;
    height: 0.9rem;
    border-radius: 0.22rem;
    background: #f0f4ff;
    display: flex;
    align-items: center;
    justify-content: center;
}
.mi-action-icon svg {
    width: 0.42rem;
    height: 0.42rem;
    stroke: #1a56db;
    fill: none;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.mi-action-label {
    font-size: 0.22rem;
    color: #374151;
    font-weight: 500;
}
</style>

<div class="mi-hero">
    <div class="mi-hero-top">
        <div>
            <div class="mi-logo-text">Metal Invest</div>
            <div class="mi-logo-sub">Plateforme d'investissement</div>
        </div>
        <div>
            <div class="mi-greeting">Bonjour,</div>
            <div class="mi-username">{{ auth()->user()->fullname ?? auth()->user()->username }}</div>
        </div>
    </div>

    <div class="mi-balance-card">
        <div class="mi-balance-label">Solde total</div>
        <div class="mi-balance-amount">
            {{ number_format(auth()->user()->interest_wallet + auth()->user()->deposit_wallet, 0, ',', ' ') }}<span class="mi-balance-currency">FCFA</span>
        </div>
        <div class="mi-sub-balances">
            <div class="mi-sub-bal">
                <div class="mi-sub-label">Intérêts</div>
                <div class="mi-sub-value">{{ number_format(auth()->user()->interest_wallet, 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="mi-sub-bal">
                <div class="mi-sub-label">Dépôts</div>
                <div class="mi-sub-value">{{ number_format(auth()->user()->deposit_wallet, 0, ',', ' ') }} FCFA</div>
            </div>
        </div>
    </div>

    <div class="mi-slides">
        <div class="mi-slide">
            <div class="mi-slide-tag">Bienvenue</div>
            <div class="mi-slide-title">Metal Invest</div>
            <div class="mi-slide-desc">Investissez en FCFA et percevez des revenus quotidiens garantis.</div>
            <div class="mi-slide-highlight">Cameroun · Côte d'Ivoire · Bénin · Burkina · Togo</div>
        </div>
        <div class="mi-slide">
            <div class="mi-slide-tag">Plans VIP</div>
            <div class="mi-slide-title">Dès 3 000 FCFA</div>
            <div class="mi-slide-desc">300 FCFA par jour — sur 50 jours. Gains versés chaque jour ouvrable.</div>
            <div class="mi-slide-highlight">VIP 1 à VIP 4 disponibles</div>
        </div>
        <div class="mi-slide">
            <div class="mi-slide-tag">Parrainage</div>
            <div class="mi-slide-title">Jusqu'à 20 %</div>
            <div class="mi-slide-desc">Niveau 1 : 20 % · Niveau 2 : 3 % · Niveau 3 : 2 % sur chaque investissement.</div>
            <div class="mi-slide-highlight">Bonus roue inclus pour chaque achat</div>
        </div>
    </div>
</div>

<div class="mi-actions">
    <a class="mi-action" href="{{ route('user.deposit.index') }}">
        <div class="mi-action-icon">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
        </div>
        <span class="mi-action-label">Recharge</span>
    </a>
    <a class="mi-action" href="{{ route('user.withdraw') }}">
        <div class="mi-action-icon">
            <svg viewBox="0 0 24 24"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
        </div>
        <span class="mi-action-label">Retrait</span>
    </a>
    <a class="mi-action" href="{{ route('user.lucky.wheel.index') }}">
        <div class="mi-action-icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><line x1="12" y1="3" x2="12" y2="12"/><line x1="12" y1="12" x2="19.5" y2="16.5"/><line x1="12" y1="12" x2="4.5" y2="16.5"/><circle cx="12" cy="12" r="2"/></svg>
        </div>
        <span class="mi-action-label">Roue</span>
    </a>
    <a class="mi-action" href="{{ route('user.referrals') }}">
        <div class="mi-action-icon">
            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <span class="mi-action-label">Équipe</span>
    </a>
    <a class="mi-action" href="{{ route('ticket.index') }}">
        <div class="mi-action-icon">
            <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <span class="mi-action-label">Support</span>
    </a>
</div>


@php
        $plans = App\Models\Plan::orderBy('id')->get();
        $gatewayCurrency = null;
        if (auth()->check()) {
            $gatewayCurrency = App\Models\GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', 1);
            })
                ->with('method')
                ->orderby('method_code')
                ->get();
        }
    @endphp



    <div class="project content">
        <div class="title">Nos Plans VIP</div>

         @foreach ($plans as $plan)
         @php $unavailable = !$plan->status; @endphp

         <div class="sub_title">Durée : @if ($plan->lifetime == 0)
                            {{ __($plan->repeat_time) }} @php
                                $tn = strtolower($plan->time_name);
                                echo $tn === 'days' ? 'jours' : ($tn === 'hours' ? 'heures' : ($tn === 'months' ? 'mois' : $tn));
                            @endphp
                        @else
                            À vie
                        @endif</div>
                <div class="item" style="{{ $unavailable ? 'opacity:0.6;' : '' }}">
                    <div class="top">
                        <div class="right">
                            <div class="item_title">
                                <span class="subtitle">{{ __($plan->name) }}</span>
                                @if($unavailable)
                                    <span style="display:inline-block;margin-left:0.15rem;background:#94a3b8;color:#fff;font-size:0.2rem;padding:0.04rem 0.18rem;border-radius:0.2rem;font-weight:600;vertical-align:middle;">Bientôt</span>
                                @endif
                            </div>
                            <div class="des"></div>
                            <section class="item_price">
                                <div><span class="num">{{ showAmount($plan->interest, 0) }}{{ $plan->interest_type == 1 ? '%' : '' }}</span>Revenu/Jour</div>

                                <div style="padding-left: 0.1rem"><span class="num usdt_num">@if ($plan->lifetime == 0)
                                @if ($plan->capital_back == 1)
                                    Capital +
                                @endif
                                {{ showAmount($plan->interest * $plan->repeat_time, 0) }}{{ $plan->interest_type == 1 ? '%' : ' ' . $general->cur_text }}
                            @else
                                Illimité
                            @endif </span> Revenu Total </div>

                                <div style="display: none">Hourly revenue: <span class="num">15</span></div>
                                <div style="display: none">Cycle: <span class="num">30</span></div>
                            </section>
                        </div>
                        <div class="left">
                            <div style="width:2.2rem;height:2.2rem;background:{{ $unavailable ? 'linear-gradient(135deg,#64748b,#94a3b8)' : 'linear-gradient(135deg,#0e3a8c,#1a56db)' }};border-radius:0.3rem;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                @if($plan->image)
                                    <img src="{{ asset('assets/images/plan/'.$plan->image) }}" alt="{{ $plan->name }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <svg width="1rem" height="1rem" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                @endif
                            </div>
      @if(!$unavailable)
                       <div class="continue">
             <button class="investModal" data-plan="{{ $plan }}" type="button">@if ($plan->fixed_amount == 0)
                                {{ showAmount($plan->minimum, 0) }} - {{ showAmount($plan->maximum, 0) }} {{ $general->cur_text }}
                            @else
                                {{ showAmount($plan->fixed_amount, 0) }} {{ $general->cur_text }}
                            @endif</button>
        </div>
      @else
                       <div class="continue">
             <button disabled style="background:#94a3b8;cursor:not-allowed;">Indisponible</button>
        </div>
      @endif

                     </div>
                    </div>
                    </div>

@endforeach
 </div>
</div>



<!-- ===== INVEST BOTTOM SHEET ===== -->
<style>
.inv-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 9998;
    backdrop-filter: blur(2px);
}
.inv-overlay.active { display: block; }

.inv-sheet {
    position: fixed;
    left: 0; right: 0; bottom: 0;
    z-index: 9999;
    background: #fff;
    border-radius: 1rem 1rem 0 0;
    transform: translateY(100%);
    transition: transform 0.32s cubic-bezier(.4,0,.2,1);
    max-height: 92vh;
    overflow-y: auto;
}
.inv-sheet.active { transform: translateY(0); }

.inv-handle {
    width: 2.2rem; height: 0.18rem;
    background: #e2e8f0;
    border-radius: 0.1rem;
    margin: 0.3rem auto 0;
}

.inv-header {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.4rem 0.4rem 0.3rem;
    border-bottom: 1px solid #f1f5f9;
}
.inv-plan-icon {
    width: 1.1rem; height: 1.1rem;
    border-radius: 0.25rem;
    background: linear-gradient(135deg,#0e3a8c,#1a56db);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; flex-shrink: 0;
}
.inv-plan-icon img { width:100%; height:100%; object-fit:cover; }
.inv-plan-name {
    font-size: 0.36rem;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
}
.inv-plan-sub {
    font-size: 0.24rem;
    color: #64748b;
    margin-top: 0.04rem;
}
.inv-close-btn {
    margin-left: auto;
    width: 0.7rem; height: 0.7rem;
    border-radius: 50%;
    background: #f1f5f9;
    border: none;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; flex-shrink: 0;
    font-size: 0.32rem; color: #64748b;
}

.inv-stats {
    display: flex;
    gap: 0;
    border-bottom: 1px solid #f1f5f9;
}
.inv-stat {
    flex: 1;
    text-align: center;
    padding: 0.3rem 0.2rem;
    border-right: 1px solid #f1f5f9;
}
.inv-stat:last-child { border-right: none; }
.inv-stat-val {
    font-size: 0.36rem;
    font-weight: 700;
    color: #1a56db;
    line-height: 1;
}
.inv-stat-lbl {
    font-size: 0.22rem;
    color: #94a3b8;
    margin-top: 0.06rem;
}

.inv-body { padding: 0.4rem; }

.inv-field-label {
    font-size: 0.24rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.15rem;
    text-transform: uppercase;
    letter-spacing: 0.03rem;
}
.inv-select, .inv-input {
    width: 100%;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 0.22rem;
    padding: 0.28rem 0.3rem;
    font-size: 0.3rem;
    color: #0f172a;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    margin-bottom: 0.3rem;
    box-sizing: border-box;
}
.inv-select:focus, .inv-input:focus {
    border-color: #1a56db;
    background: #fff;
}
.inv-amount-row {
    position: relative;
}
.inv-amount-row .inv-input {
    padding-right: 1.4rem;
    margin-bottom: 0;
}
.inv-amount-cur {
    position: absolute;
    right: 0.25rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.26rem;
    color: #94a3b8;
    font-weight: 600;
    pointer-events: none;
}
.inv-range-hint {
    font-size: 0.22rem;
    color: #94a3b8;
    margin-top: 0.1rem;
    margin-bottom: 0.3rem;
}
.inv-range-hint span { color: #1a56db; font-weight: 600; }

.inv-charge-box {
    display: none;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 0.2rem;
    padding: 0.2rem 0.25rem;
    font-size: 0.24rem;
    color: #1e40af;
    margin-bottom: 0.3rem;
}
.inv-charge-box.visible { display: block; }

.inv-btn {
    width: 100%;
    padding: 0.38rem;
    background: linear-gradient(135deg, #0e3a8c, #1a56db);
    color: #fff;
    font-size: 0.32rem;
    font-weight: 700;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    letter-spacing: 0.02rem;
    margin-top: 0.1rem;
}
.inv-btn:active { opacity: 0.9; }
.inv-login-btn {
    width: 100%;
    padding: 0.38rem;
    background: linear-gradient(135deg, #0e3a8c, #1a56db);
    color: #fff;
    font-size: 0.32rem;
    font-weight: 700;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    text-align: center;
    display: block;
    text-decoration: none;
    margin-top: 0.1rem;
}
</style>

<div class="inv-overlay" id="invOverlay"></div>
<div class="inv-sheet" id="invSheet">
    <div class="inv-handle"></div>
    <div class="inv-header">
        <div class="inv-plan-icon" id="invPlanIcon">
            <svg width="60%" height="60%" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <div>
            <div class="inv-plan-name" id="invPlanName">—</div>
            <div class="inv-plan-sub" id="invPlanSub">—</div>
        </div>
        <button class="inv-close-btn" id="invCloseBtn" type="button">✕</button>
    </div>

    <div class="inv-stats">
        <div class="inv-stat">
            <div class="inv-stat-val" id="invStatRevDay">—</div>
            <div class="inv-stat-lbl">Revenu/Jour</div>
        </div>
        <div class="inv-stat">
            <div class="inv-stat-val" id="invStatRevTotal">—</div>
            <div class="inv-stat-lbl">Revenu Total</div>
        </div>
        <div class="inv-stat">
            <div class="inv-stat-val" id="invStatDuration">—</div>
            <div class="inv-stat-lbl">Durée</div>
        </div>
    </div>

    <div class="inv-body">
        @if(auth()->check())
        <form action="{{ route('user.invest.submit') }}" method="post" id="invForm">
            @csrf
            <input type="hidden" name="plan_id" id="invPlanId">

<input type="hidden" name="amount" id="invAmount">
            <input type="hidden" name="wallet_type" value="deposit_wallet">

            @php $totalBal = auth()->user()->deposit_wallet + auth()->user()->interest_wallet; @endphp
            <div style="background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:0.22rem;padding:0.3rem 0.35rem;margin-bottom:0.35rem;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.18rem;">
                    <span style="font-size:0.26rem;color:#64748b;">Solde disponible</span>
                    <span style="font-size:0.28rem;font-weight:600;color:#0f172a;">{{ showAmount($totalBal, 0) }} {{ $general->cur_text }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:0.26rem;color:#64748b;">Montant débité</span>
                    <span style="font-size:0.38rem;font-weight:700;color:#1a56db;" id="invAmountDisplay">—</span>
                </div>
            </div>

            <button type="submit" class="inv-btn">Confirmer l'investissement</button>
        </form>
        @else
        <a href="{{ route('user.login') }}" class="inv-login-btn">Se connecter pour investir</a>
        @endif
    </div>
</div>
@push('script')
<script>
    (function($){
        "use strict";

        var currency = '{{ $general->cur_text }}';
        var baseAsset = '{{ asset("assets/images/plan") }}';

        function openInvSheet(plan) {
            // header
            $('#invPlanId').val(plan.id);
            $('#invPlanName').text(plan.name);

            // icon
            var iconEl = $('#invPlanIcon');
            iconEl.empty();
            if (plan.image) {
                iconEl.html('<img src="' + baseAsset + '/' + plan.image + '" alt="">');
            } else {
                iconEl.html('<svg width="60%" height="60%" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>');
            }

            // stats
            var interest = parseFloat(plan.interest);
            var interestStr = plan.interest_type == 1 ? Math.round(interest) + '%' : Math.round(interest) + ' ' + currency;
            $('#invStatRevDay').text(interestStr);

            if (plan.lifetime == 1) {
                $('#invStatRevTotal').text('Illimité');
                var timeName = plan.time_name.toLowerCase();
                timeName = timeName === 'days' ? 'jours' : timeName === 'hours' ? 'heures' : timeName === 'months' ? 'mois' : timeName;
                $('#invStatDuration').text('À vie');
                $('#invPlanSub').text('Revenu à vie');
            } else {
                var totalVal = interest * plan.repeat_time;
                var totalStr = plan.interest_type == 1 ? Math.round(totalVal) + '%' : Math.round(totalVal) + ' ' + currency;
                if (plan.capital_back == 1) totalStr = 'Capital + ' + totalStr;
                $('#invStatRevTotal').text(totalStr);
                var timeName = plan.time_name.toLowerCase();
                timeName = timeName === 'days' ? 'j' : timeName === 'hours' ? 'h' : timeName === 'months' ? 'mois' : timeName;
                $('#invStatDuration').text(plan.repeat_time + ' ' + timeName);
                $('#invPlanSub').text(plan.repeat_time + ' versements');
            }

            // amount (fixed per plan)
            var amount = plan.fixed_amount > 0 ? plan.fixed_amount : plan.minimum;
            $('#invAmount').val(Math.round(amount));
            $('#invAmountDisplay').text(Math.round(amount) + ' ' + currency);

            // open
            $('#invOverlay').addClass('active');
            $('#invSheet').addClass('active');
            $('body').css('overflow', 'hidden');
        }

        function closeInvSheet() {
            $('#invOverlay').removeClass('active');
            $('#invSheet').removeClass('active');
            $('body').css('overflow', '');
        }

        $('.investModal').on('click', function() {
            var plan = $(this).data('plan');
            openInvSheet(plan);
        });

        $('#invCloseBtn, #invOverlay').on('click', closeInvSheet);

    })(jQuery);
</script>
@endpush







  @php
        $content = getContent('footer.content',true);
    @endphp
<!-- notice METAL INVEST -->
<div class="dialog-mask notice-dialog">
    <div class="dialog">
        <div class="dialog-header" style="background:linear-gradient(135deg,#0e3a8c,#1a56db);border-radius:0.4rem 0.4rem 0 0;height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 0.3rem;">
            <span style="color:#fff;font-size:0.32rem;font-weight:700;">METAL INVEST</span>
            <div class="dialog_close"> <img src="{{ asset('assets/img/close.png') }}" alt=""></div>
        </div>
        <div class="dialog-content ggindex" style="padding:0.4rem 0.35rem;font-size:0.28rem;line-height:1.8;color:#333;">
            <p style="margin-bottom:0.2rem;"><strong>Bienvenue sur METAL INVEST !</strong></p>
            <p style="margin-bottom:0.2rem;">Bonus d'inscription : <strong style="color:#1a56db;">500 FCFA</strong> offerts à l'inscription.</p>
            <p style="margin-bottom:0.2rem;">Achetez un plan et gagnez un tour de <strong>Roue de la Chance</strong>.</p>
            <p style="margin-bottom:0.2rem;">Parrainez et gagnez <strong>20%</strong> sur chaque investissement.</p>
            <p style="margin-bottom:0.2rem;">Rejoignez notre canal Telegram officiel pour les annonces :</p>
            <p><a href="https://t.me/METALINVEST01" target="_blank" style="color:#1a56db;font-weight:700;">➜ t.me/METALINVEST01</a></p>
        </div>
        <div class="dialog-footer" style="text-align:center;padding-bottom:0.4rem;">
           <a href="https://t.me/METALINVEST01" target="_blank">
               <span id="notice_btn000" style="background:linear-gradient(135deg,#1a56db,#0e3a8c);color:#fff;padding:0.15rem 0.6rem;border-radius:1rem;font-size:0.30rem;font-weight:700;">Rejoindre Telegram</span>
           </a>
        </div>
    </div>
</div>
<style>
    .ggindex a { color: #1a56db; }
</style>


<div class="dialog-mask product-dialog" id="pro_msg_div">
    <div class="dialog" style="background:#ffffff; ">
        <div class="dialog-header my_dialog-header">

            <div class="dialog_close"> <img src="https://webs5g.com/static/index/close.png" alt="" ></div>
        </div>
        <div class="dialog-content">
            <div class="top">


                <p id="pro_msg"></p>

            </div>

        </div>
    </div>
</div>
<div class="my_customer_service">
    <a href="{{ route('ticket.index') }}"><img src="{{asset ('assets/img/customer_service.png')}}"/></a>
</div>
   
<style>
    .notice-dialog .dialog-content{
        overflow-y: scroll;
        max-height: 6rem;
        height: auto;
    }
    .copy {
        margin-top: 0.2rem;
        background: #E8F3ED;
        border-radius: 0.24rem;
        font-weight: 600;
        color: #132219;
        font-size: 0.28rem;
        line-height: 0.4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.36rem;
    }
    .copy img {
        width: 0.75rem;
    }
    .copy .left {
        flex: 1;
        overflow: hidden;
    }
    .copy .code {
        font-weight: 400;
        color: #99A18F;
    }
</style>







<script>
function buy(id){
 
    var json='{"id":"'+id+'"}';
   

    $.ajax({
        type:"post",
url:"product.php",
data:json,
success:function(op){
   
   var res=JSON.parse(op);
   var rescode=res.code;
   var msg=res.msg;
Toast(msg);

if(rescode=='200'){
    
  Toast(msg);
}
}
    })


    }
    
    </script>
<script>

 let selectHidden = true;
    var pay_mode ='₹';
    var item_id;
    var item_uprice =0.00;
    var item_price =0.00;
    var pay_money = 0.00;
    var coupon_id = '';

    $('.select').click(function() {
        openSelect()
    })

    function openSelect() {
        selectHidden = !selectHidden
        $('.option')[selectHidden ? 'hide' : 'show']()
    }

    if (enLanguage) {
        $('.english img').css('visibility', 'visible')
        $('.english').addClass('green')
    } else {
        $('.hebrew img').css('visibility', 'visible')
        $('.hebrew').addClass('green')
    }

    $('.english').click(function(e) {
        e.stopPropagation()
        if ($(this).hasClass('green')) {
            return
        }
        openSelect()
        setCookie('en')
        switchLanguage('en-us')
        $('.english img').css('visibility', 'visible')
        $('.english').addClass('green')
        $('.hebrew img').css('visibility', 'hidden')
        $('.hebrew').removeClass('green')
        $('.en-text').show()
        $('.zh-text').hide()
    })
    $('.hebrew').click(function(e) {
        e.stopPropagation()
        if ($(this).hasClass('green')) {
            return
        }
        openSelect()
        setCookie('zh')
        switchLanguage('zh-cn')
        $('.hebrew img').css('visibility', 'visible')
        $('.hebrew').addClass('green')
        $('.english img').css('visibility', 'hidden')
        $('.english').removeClass('green')
        $('.en-text').hide()
        $('.zh-text').show()
    })


    function switchLanguage(param) {

        var url = "/handle/switchLanguage";
        let params = {};
        params.lang = param;
        $.ajax({
            type: "POST",
            url: url,
            data: params,
            dataType: "json",
            cache: false,
            async: false,
            success: function (result) {
                document.location.reload();
            },
            error: function () {
                message("Failed, the network is busy..");
            }
        });
    }

    // 轮播
    var mySwiper =  new Swiper('.swiper-container', {
        loop: true,
        autoplay: true,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
        },
    });
    var show_notice = 0
    var show_voucher = 0
    if (!localStorage.getItem('mi_notice_seen')) {
        $('.notice-dialog').show()
        show_notice = 1
    }
    if(show_notice == 0 && show_voucher ==1){
        $('.voucher-dialog').show()
    }

    $('.buy').click(function() {
        coupon_id = '';//clear coupon id
       // $('.product-dialog').show()
        var url = "/mobile/ajaxDetail";
        var id = $(this).data('id');
        var params = {'id': id};
        $.ajax({
            type: "POST",
            url: url,
            data: params,
            dataType: "json",
            cache: false,
            async: false,
            success: function (result) {

                if(result['code']==0){
                    $('.product-dialog').show()
                    $('#pro_msg_div').hide();
                    let hourlyIncome = result['data']['rate'];
                    let day = parseInt(result['data']['day']);
                    $('#item_title').html(result['data']['title'])
                    $('#item_content').html(result['data']['desc'])
                    $('#expires_num').html(result['data']['day'])
                    $('.buy_tk').html(result['data']['min'])
                    $('#buy_usdt').html(result['data']['usdt_money'])
                    $('.usdt_price').html(result['data']['usdt_money'])
                    $('#hourly_income').html(hourlyIncome);
                    $('#day_income').html( (parseFloat(hourlyIncome) * 24).toFixed(2))
                    $('#total_income').html((parseFloat(hourlyIncome) * 24 * day).toFixed(2))

                    item_id = id;
                    item_price = result['data']['min'];
                    item_uprice = result['data']['usdt_money'];
                    if(result['data']['img']!=''){
                        $('#item_img').attr('src', '/Public/uploads/item/'+ result['data']['img'])
                    }

                }else{
                    $('.product-dialog').hide();
                    //$('#pro_msg_div').show();
                    // alert(result['msg']);
                    //$("#pro_msg").html(result['msg']);
                      message(result['msg']);
                }

            },
            error: function () {
                message("Failed, the network is busy..");
            }
        });

        var UserVoucherUrl = "/user/getUserVoucher";
        $.ajax({
            type: "POST",
            url: UserVoucherUrl,
            data: params,
            dataType: "json",
            cache: false,
            async: false,
            success: function (result) {
                if(result['code']==0){
                    let datas = result['data'];
                    let selectOption = '';
                    datas.forEach((param)=>{
                        selectOption += '<span data-id="'+param['id']+'" data-reduction="'+param['reduction_amount']+'"  data-ureduction="'+param['u_reduction_amount']+'">'+param['description']+'</span>';
                    });
                    $('#voucher_list').html(selectOption);
                }
            },
            error: function () {
                message("Failed, the network is busy..");
            }
        });


        //$('.pay-dialog').show()
        // $('.success-dialog').show()
        // $('.no-amount-dialog').show()
        // $('.voucher-dialog').show()
        // $('.check-dialog').show()
    })

    $('.cancel').click(function(){
        $('.product-dialog').hide()
    })

    $('.buy-now').click(function(){
        pay_mode = $(this).data('id');
        $('.pay_mode').html(pay_mode);
        $(".code-select .target").text('')

        if(pay_mode=='USDT'){
            if(item_uprice){
                $("#total_payment").html(item_uprice);
            }else{
                item_uprice =0.00
                $("#total_payment").html(item_uprice);
            }
            pay_money = item_uprice;
        }else{
            pay_money = item_price;
            $("#total_payment").html(item_price);
        }

        $('.product-dialog').hide();
        $('.pay-dialog').show()
    })

    $('.product-dialog .dialog_close').click(function(){
        $('.product-dialog').hide()
    })

    $('.pay-dialog .dialog_close').click(function(){
        $('.pay-dialog').hide()
    })
    $('.success-dialog .dialog_close').click(function(){
        $('.success-dialog').hide()
    })
    $('.no-amount-dialog .dialog_close').click(function(){
        $('.no-amount-dialog').hide()
    })
    $('.check-dialog').click(function(){
        $('.check-dialog').hide()
    })

    // 签到
    $('#check-in').click(function(){
        var url = "/handle/qiandao";
        $.ajax({
            type: "POST",
            url: url,
            data: {phone: 1},
            dataType: "json",
            cache: false,
            async: false,
            success: function (result) {
                if (result['code'] == "000") {
                    $("#sign_in_money").html(result['reward_money'])
                    $('.check-dialog').show()
                } else {
                    if(result['code'] == "003"){
                        message(result['msg']);
                        window.document.location.href = '/user/certification.html'
                    }
                    else{
                        message(result['msg']);
                    }
                }
            },
            error: function () {
                message("Failed, the network is busy..");
            }
        });


    })


    let openVoucherSelect = false
    $(".code-select").click(function(){
        openVoucherSelect = !openVoucherSelect
        const list = $(this).find('.list')
        $(this).find('.list')[openVoucherSelect ? 'show' : 'hide']()
    })

    $(document).on('click',".code-select .list span",function (param) {

        let reduction = $(this).data('reduction');
        let ureduction = $(this).data('ureduction');
        coupon_id = $(this).data('id');

        if(pay_mode=='USDT'){
            $("#discount_amount").html(ureduction)
            pay_money = parseFloat(item_uprice) - parseFloat(ureduction);
        }else{
            $("#discount_amount").html(reduction)
            pay_money = parseFloat(item_price) - parseFloat(reduction);
        }
        $("#total_payment").html(pay_money)
        $(".code-select .list span").removeClass('active')
        $(this).addClass('active')
        $(".code-select .target").text( $(this).text())
    })

    $(document).on('click',"#payItem",function (param) {
        if(!item_id){
            message("Please select an item");
            return;
        }
        if(pay_money == 0){
           // message("Please select an item");
           // return;
        }

        var url = "/user/itemPlay";
        let params = {};
        params.id = item_id
        params.money = pay_money;
        params.payMode = pay_mode;
        params.couponId = coupon_id;

        $.ajax({
            type: "POST",
            url: url,
            data: params,
            dataType: "json",
            cache: false,
            async: false,
            success: function (result) {
                if (result['code'] == 0) {
                    $('.pay-dialog').hide()
                    $('.success-dialog').show()
                    setTimeout(function () {
                        window.document.location.href = result['url']
                    },1000)
                } else if(result['code'] == 2) {
                    $('.pay-dialog').hide()
                    setTimeout(function () {
                        window.document.location.href = result['url']
                    },1000)
                } else if(result['code'] == 3) {
                    $('.pay-dialog').hide()
                    $('.no-amount-dialog').show()
                    setTimeout(function () {
                        window.document.location.href = result['url']
                    },1000)
                }
                else{
                    $('.pay-dialog').hide()
                    message(result['msg']);
                }
            },
            error: function () {
                message("Failed, the network is busy..");
            }
        });
    })


    $(".code-select .list span").click(function(){

    })

    $(".getCoupon").click(
        function () {
            var url = "/user/getVoucher";
            var id_coupon = $(this).data('id')
            var params = {'id_coupon': id_coupon};
            $.ajax({
                type: "POST",
                url: url,
                data: params,
                dataType: "json",
                cache: false,
                async: false,
                success: function (result) {
                    if(result['code']==0 || result['code']==2){
                        //window.document.location.href = '/user/voucher.html'
                        message(result['message']);
                        setTimeout(function () {
                            $('.voucher-dialog').hide()
                        },2000)
                    }
                    else{
                        message(result['message']);
                    }
                },
                error: function () {
                    message("Failed, the network is busy..");
                }
            });
        }
    );

    $(".voucher").click(function(){
        $('.voucher-dialog').hide()
    })

    $(document).on('click',".notice-dialog .dialog_close,#notice_btn,#notice_btn000",function (param) {
        localStorage.setItem('mi_notice_seen', '1');
        $('.notice-dialog').hide();
    })

    function inviteFriend() {
        $(".invite-dialog").show();
    }

    $(document).on('click','.invite-dialog .dialog_close',function() {
        $(".invite-dialog").hide();
    })
    function clipBoard(text) {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text;
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message("Copy success")
    }

    $(document).on('click','#copyCode',function() {
        clipBoard($("#code").text())
    })

    $(document).on('click','#copy-link',function() {
        clipBoard($("#link").text())
    })

</script>

<style>
    .my_customer_service{
        height: 1rem;
        width: 1rem;
        position: fixed;
        bottom: 3rem;
        right: 0.28rem;
    }
    .my_customer_service img{
        width: 1rem;
    }
</style>
<script>
    /*
    $(function () {
        var url = "/handle/userOwn";
        let params = {};
        $.ajax({
            type: "POST",
            url: url,
            data: params,
            cache: false,
            async: true,
            success: function (result) {
                console.log(result);
            },
            error: function (param) {
                console.log(param);
            }
        });

    })
     */
</script>

{{-- ===== POPUP TELEGRAM ===== --}}
<div id="tgPopupOverlay" style="
    display:none;
    position:fixed;
    top:0;left:0;right:0;bottom:0;
    background:rgba(0,0,0,0.55);
    z-index:9999;
    align-items:center;
    justify-content:center;
">
    <div style="
        background:#fff;
        border-radius:0.32rem;
        margin:0 0.5rem;
        padding:0.6rem 0.5rem 0.5rem;
        text-align:center;
        box-shadow:0 8px 40px rgba(0,0,0,0.25);
        position:relative;
        max-width:6rem;
        margin:auto;
    ">
        <!-- Bouton fermer -->
        <button onclick="document.getElementById('tgPopupOverlay').style.display='none';" style="
            position:absolute;
            top:0.2rem;right:0.3rem;
            background:none;border:none;
            font-size:0.5rem;
            color:#888;
            cursor:pointer;
            line-height:1;
        ">×</button>

        <!-- Icône Telegram -->
        <div style="
            width:1.2rem;height:1.2rem;
            background:linear-gradient(135deg,#2AABEE,#229ED9);
            border-radius:50%;
            margin:0 auto 0.3rem;
            display:flex;align-items:center;justify-content:center;
        ">
            <svg viewBox="0 0 24 24" width="0.65rem" height="0.65rem" fill="#fff">
                <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/>
            </svg>
        </div>

        <div style="font-size:0.34rem;font-weight:700;color:#0a2463;margin-bottom:0.2rem;">
            Rejoignez notre canal officiel !
        </div>
        <div style="font-size:0.26rem;color:#555;line-height:1.6;margin-bottom:0.4rem;padding:0 0.1rem;">
            Restez informé des nouvelles offres, des mises à jour et des annonces importantes en rejoignant notre canal Telegram.
        </div>

        <a href="https://t.me/METALINVEST01" target="_blank" style="
            display:block;
            background:linear-gradient(135deg,#2AABEE,#229ED9);
            color:#fff;
            border-radius:0.55rem;
            padding:0.28rem 0;
            font-size:0.30rem;
            font-weight:700;
            text-decoration:none;
            margin-bottom:0.2rem;
        " onclick="document.getElementById('tgPopupOverlay').style.display='none';">
            📣 Rejoindre le canal
        </a>

        <button onclick="document.getElementById('tgPopupOverlay').style.display='none';" style="
            background:none;border:none;
            color:#aaa;font-size:0.24rem;
            cursor:pointer;
            margin-top:0.05rem;
        ">Plus tard</button>
    </div>
</div>
{{-- ===== FIN POPUP TELEGRAM ===== --}}

@endsection

@push('script')
<script src="{{ asset($activeTemplateTrue.'/js/lib/apexcharts.min.js') }}"></script>

<script>

    // apex-line chart
    var options = {
        chart: {
            height: 350,
            type: "area",
            toolbar: {
                show: false
            },
            dropShadow: {
                enabled: true,
                enabledSeries: [0],
                top: -2,
                left: 0,
                blur: 10,
                opacity: 0.08,
            },
            animations: {
                enabled: true,
                easing: 'linear',
                dynamicAnimation: {
                    speed: 1000
                }
            },
        },
        dataLabels: {
            enabled: false
        },
        series: [
            {
                name: "Price",
                data: [
                    @foreach($chartData as $cData)
                        {{ getAmount($cData->amount) }},
                    @endforeach

                ]
            }
        ],
        fill: {
            type: "gradient",
            colors: ['#4c7de6', '#4c7de6', '#4c7de6'],
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.6,
                opacityTo: 0.9,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            title: "Value",
            categories: [
                @foreach($chartData as $cData)
                "{{ Carbon\Carbon::parse($cData->date)->format('d F') }}",
                @endforeach
            ]
        },
        grid: {
            padding: {
                left: 5,
                right: 5
            },
            xaxis: {
                lines: {
                    show: false
                }
            },
            yaxis: {
                lines: {
                    show: false
                }
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

    @if($isHoliday)
        function createCountDown(elementId, sec) {
            var tms = sec;
            var x = setInterval(function () {
                var distance = tms * 1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                var days = `<span>${days}d</span>`;
                var hours = `<span>${hours}h</span>`;
                var minutes = `<span>${minutes}m</span>`;
                var seconds = `<span>${seconds}s</span>`;
                document.getElementById(elementId).innerHTML = days +' '+ hours + " " + minutes + " " + seconds;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                tms--;
            }, 1000);
        }

        createCountDown('counter', {{\Carbon\Carbon::parse($nextWorkingDay)->diffInSeconds()}});
    @endif

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Popup Telegram — affiché à chaque visite de l'accueil
    setTimeout(function() {
        var overlay = document.getElementById('tgPopupOverlay');
        if (overlay) overlay.style.display = 'flex';
    }, 800);

</script>
@endpush
