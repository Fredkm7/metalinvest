@extends($activeTemplate.'layouts.master')
@section('content')

<style>
.il-page { background:#f1f5f9; min-height:100vh; padding-bottom:1.5rem; }

.il-top {
    background: linear-gradient(160deg, #0a2463 0%, #1a56db 100%);
    padding: 0.4rem 0.4rem 0.7rem;
}
.il-top-title {
    font-size: 0.34rem;
    font-weight: 700;
    color: #fff;
    text-align: center;
}
.il-summary {
    display: flex;
    gap: 0.3rem;
    margin: -0.4rem 0.3rem 0;
    position: relative;
    z-index: 2;
}
.il-sum-card {
    flex: 1;
    background: #fff;
    border-radius: 0.3rem;
    padding: 0.3rem 0.25rem;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}
.il-sum-val {
    font-size: 0.38rem;
    font-weight: 700;
    color: #1a56db;
    line-height: 1.1;
}
.il-sum-lbl {
    font-size: 0.22rem;
    color: #94a3b8;
    margin-top: 0.08rem;
}

.il-list {
    padding: 0.35rem 0.3rem 0;
    margin-top: 0.3rem;
}
.il-section-title {
    font-size: 0.28rem;
    font-weight: 700;
    color: #334155;
    margin-bottom: 0.25rem;
    padding-left: 0.05rem;
}

.il-card {
    background: #fff;
    border-radius: 0.3rem;
    margin-bottom: 0.25rem;
    box-shadow: 0 1px 6px rgba(0,0,0,0.06);
    overflow: hidden;
}
.il-card-head {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.3rem 0.3rem 0.22rem;
    border-bottom: 1px solid #f1f5f9;
}
.il-card-icon {
    width: 1rem; height: 1rem;
    border-radius: 0.2rem;
    background: linear-gradient(135deg,#0e3a8c,#1a56db);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; flex-shrink: 0;
}
.il-card-icon img { width:100%; height:100%; object-fit:cover; }
.il-card-name {
    font-size: 0.3rem;
    font-weight: 700;
    color: #0f172a;
    flex: 1;
}
.il-card-trx {
    font-size: 0.2rem;
    color: #94a3b8;
    margin-top: 0.04rem;
}
.il-badge {
    font-size: 0.2rem;
    font-weight: 700;
    padding: 0.06rem 0.2rem;
    border-radius: 1rem;
    flex-shrink: 0;
}
.il-badge.active { background:#dcfce7; color:#16a34a; }
.il-badge.closed { background:#f1f5f9; color:#94a3b8; }

.il-card-body {
    padding: 0.25rem 0.3rem;
}
.il-rows { display:flex; flex-wrap:wrap; gap:0.15rem 0; }
.il-row {
    width: 50%;
    display: flex;
    flex-direction: column;
    gap: 0.04rem;
    padding: 0.12rem 0;
}
.il-row:nth-child(odd) { padding-right: 0.2rem; border-right: 1px solid #f1f5f9; }
.il-row:nth-child(even) { padding-left: 0.2rem; }
.il-row-lbl { font-size:0.21rem; color:#94a3b8; }
.il-row-val { font-size:0.28rem; font-weight:600; color:#0f172a; }
.il-row-val.blue { color:#1a56db; }

.il-progress-wrap {
    padding: 0.15rem 0.3rem 0.25rem;
}
.il-progress-lbl {
    display: flex;
    justify-content: space-between;
    font-size: 0.21rem;
    color: #94a3b8;
    margin-bottom: 0.1rem;
}
.il-progress-bar {
    height: 0.14rem;
    background: #e2e8f0;
    border-radius: 1rem;
    overflow: hidden;
}
.il-progress-fill {
    height: 100%;
    background: linear-gradient(90deg,#0e3a8c,#1a56db);
    border-radius: 1rem;
    transition: width 0.4s ease;
}

.il-empty {
    text-align: center;
    padding: 1.5rem 0.5rem;
    color: #94a3b8;
}
.il-empty-icon {
    font-size: 1.2rem;
    margin-bottom: 0.3rem;
    opacity: 0.4;
}
.il-empty-text { font-size: 0.28rem; }
</style>

@php
    $totalInvested = $invests->sum('amount');
    $totalRevenue  = $invests->sum('paid');
@endphp

<div class="il-page">
    <div class="il-top">
        <div class="il-top-title">Mes Investissements</div>
    </div>

    <div class="il-summary">
        <div class="il-sum-card">
            <div class="il-sum-val">{{ showAmount($totalInvested, 0) }}</div>
            <div class="il-sum-lbl">Total investi ({{ $general->cur_text }})</div>
        </div>
        <div class="il-sum-card">
            <div class="il-sum-val">{{ showAmount($totalRevenue, 0) }}</div>
            <div class="il-sum-lbl">Revenus perçus ({{ $general->cur_text }})</div>
        </div>
    </div>

    <div class="il-list">
        <div class="il-section-title">{{ $invests->total() }} plan(s) au total</div>

        @forelse($invests as $invest)
        @php
            $active     = $invest->status == 1;
            $plan       = $invest->plan;
            $paid       = floatval($invest->paid);
            $shouldPay  = floatval($invest->should_pay);
            $progress   = $shouldPay > 0 ? min(100, round($paid / $shouldPay * 100)) : 0;
            $interest   = floatval($invest->interest);
            $tn         = strtolower($invest->time_name ?? $plan->time_name);
            $tnFr       = $tn === 'days' ? 'jours' : ($tn === 'hours' ? 'heures' : ($tn === 'months' ? 'mois' : $tn));
            $nextDate   = $invest->next_time ? \Carbon\Carbon::parse($invest->next_time)->format('d/m/Y') : '—';
            $startDate  = \Carbon\Carbon::parse($invest->created_at)->format('d/m/Y');
        @endphp
        <div class="il-card">
            <div class="il-card-head">
                <div class="il-card-icon">
                    @if($plan->image)
                        <img src="{{ asset('assets/images/plan/'.$plan->image) }}" alt="">
                    @else
                        <svg width="55%" height="55%" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endif
                </div>
                <div style="flex:1;min-width:0;">
                    <div class="il-card-name">{{ $plan->name }}</div>
                    <div class="il-card-trx">N° {{ $invest->trx }}</div>
                </div>
                <span class="il-badge {{ $active ? 'active' : 'closed' }}">
                    {{ $active ? 'Actif' : 'Terminé' }}
                </span>
            </div>

            <div class="il-card-body">
                <div class="il-rows">
                    <div class="il-row">
                        <div class="il-row-lbl">Montant investi</div>
                        <div class="il-row-val blue">{{ showAmount($invest->amount, 0) }} {{ $general->cur_text }}</div>
                    </div>
                    <div class="il-row">
                        <div class="il-row-lbl">Revenu / {{ rtrim($tnFr, 's') }}</div>
                        <div class="il-row-val">
                            {{ showAmount($interest, 0) }}{{ $plan->interest_type == 1 ? '%' : ' '.$general->cur_text }}
                        </div>
                    </div>
                    <div class="il-row">
                        <div class="il-row-lbl">Revenus perçus</div>
                        <div class="il-row-val">{{ showAmount($paid, 0) }} {{ $general->cur_text }}</div>
                    </div>
                    <div class="il-row">
                        <div class="il-row-lbl">Revenu total</div>
                        <div class="il-row-val">{{ showAmount($shouldPay, 0) }} {{ $general->cur_text }}</div>
                    </div>
                    <div class="il-row">
                        <div class="il-row-lbl">Démarré le</div>
                        <div class="il-row-val">{{ $startDate }}</div>
                    </div>
                    <div class="il-row">
                        <div class="il-row-lbl">{{ $active ? 'Prochain versement' : 'Terminé le' }}</div>
                        <div class="il-row-val">{{ $nextDate }}</div>
                    </div>
                </div>
            </div>

            @if($plan->lifetime == 0)
            <div class="il-progress-wrap">
                <div class="il-progress-lbl">
                    <span>Progression</span>
                    <span>{{ $progress }}%</span>
                </div>
                <div class="il-progress-bar">
                    <div class="il-progress-fill" style="width:{{ $progress }}%"></div>
                </div>
            </div>
            @endif
        </div>
        @empty
        <div class="il-empty">
            <div class="il-empty-icon">
                <svg width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            </div>
            <div class="il-empty-text">Aucun investissement pour le moment</div>
        </div>
        @endforelse

        @if($invests->hasPages())
        <div style="display:flex;justify-content:center;gap:0.2rem;margin-top:0.3rem;">
            @if($invests->onFirstPage())
                <span style="padding:0.15rem 0.35rem;background:#e2e8f0;border-radius:0.2rem;font-size:0.26rem;color:#94a3b8;">‹</span>
            @else
                <a href="{{ $invests->previousPageUrl() }}" style="padding:0.15rem 0.35rem;background:#fff;border-radius:0.2rem;font-size:0.26rem;color:#1a56db;border:1px solid #bfdbfe;">‹</a>
            @endif
            <span style="padding:0.15rem 0.4rem;background:#1a56db;border-radius:0.2rem;font-size:0.26rem;color:#fff;">{{ $invests->currentPage() }} / {{ $invests->lastPage() }}</span>
            @if($invests->hasMorePages())
                <a href="{{ $invests->nextPageUrl() }}" style="padding:0.15rem 0.35rem;background:#fff;border-radius:0.2rem;font-size:0.26rem;color:#1a56db;border:1px solid #bfdbfe;">›</a>
            @else
                <span style="padding:0.15rem 0.35rem;background:#e2e8f0;border-radius:0.2rem;font-size:0.26rem;color:#94a3b8;">›</span>
            @endif
        </div>
        @endif
    </div>
</div>

@endsection
