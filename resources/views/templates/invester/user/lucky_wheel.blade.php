@extends($activeTemplate . 'layouts.master')
@section('content')
<style>
* { box-sizing: border-box; }
.wheel-page { background: linear-gradient(160deg, #0e3a8c 0%, #1a56db 50%, #3b82f6 100%); min-height: 100vh; }
.wheel-header { display:flex; align-items:center; padding:0.3rem; color:#fff; }
.wheel-header a { color:#fff; display:flex; align-items:center; gap:0.15rem; font-size:0.3rem; }
.wheel-header img { width:0.36rem; }
.spins-badge { background:rgba(255,255,255,0.2); border-radius:1rem; padding:0.15rem 0.4rem; font-size:0.28rem; color:#fff; font-weight:700; margin-left:auto; border:1px solid rgba(255,255,255,0.4); }
.wheel-title { text-align:center; color:#fff; font-size:0.5rem; font-weight:800; padding:0.2rem; text-shadow:0 2px 10px rgba(0,0,0,0.3); }
.wheel-subtitle { text-align:center; color:rgba(255,255,255,0.8); font-size:0.26rem; margin-bottom:0.4rem; }

/* Canvas Wheel */
.wheel-container { position:relative; width:6.8rem; margin:0 auto; padding-top:0.55rem; }
.wheel-pointer {
    position:absolute; top:0; left:50%; transform:translateX(-50%);
    z-index:10; width:0; height:0;
    border-left:0.22rem solid transparent;
    border-right:0.22rem solid transparent;
    border-top:0.55rem solid #f59e0b;
    filter:drop-shadow(0 3px 6px rgba(0,0,0,0.5));
}
#wheelCanvas { display:block; width:6.8rem; height:6.8rem; border-radius:50%; box-shadow:0 0 30px rgba(0,0,0,0.4), 0 0 0 8px rgba(255,255,255,0.15); }
.spin-btn { display:block; width:6rem; margin:0.4rem auto; height:1.2rem; line-height:1.2rem; background:linear-gradient(135deg, #f59e0b, #d97706); color:#fff; border:none; border-radius:0.6rem; font-size:0.38rem; font-weight:800; text-align:center; box-shadow:0 4px 20px rgba(245,158,11,0.5); cursor:pointer; transition:transform 0.1s; }
.spin-btn:active { transform:scale(0.97); }
.spin-btn:disabled { background:#888; box-shadow:none; }

/* Result */
.result-card { background:rgba(255,255,255,0.1); border-radius:0.3rem; margin:0 0.3rem 0.3rem; padding:0.4rem; border:1px solid rgba(255,255,255,0.2); text-align:center; display:none; }
.result-prize { font-size:0.6rem; font-weight:800; color:#f59e0b; }
.result-text { font-size:0.28rem; color:rgba(255,255,255,0.9); margin-top:0.1rem; }

/* Info cards */
.info-cards { padding:0 0.3rem; display:grid; grid-template-columns:1fr 1fr; gap:0.2rem; margin-bottom:0.3rem; }
.info-card { background:rgba(255,255,255,0.12); border-radius:0.2rem; padding:0.3rem; text-align:center; border:1px solid rgba(255,255,255,0.2); }
.info-card .num { font-size:0.48rem; font-weight:800; color:#f59e0b; }
.info-card .label { font-size:0.22rem; color:rgba(255,255,255,0.8); margin-top:0.05rem; }

/* History */
.history-section { background:rgba(255,255,255,0.08); margin:0 0.3rem; border-radius:0.3rem; padding:0.3rem; margin-bottom:1.8rem; }
.history-title { color:#fff; font-size:0.32rem; font-weight:700; margin-bottom:0.2rem; }
.history-item { display:flex; justify-content:space-between; align-items:center; padding:0.15rem 0; border-bottom:1px solid rgba(255,255,255,0.1); }
.history-item:last-child { border-bottom:none; }
.history-prize { color:#f59e0b; font-weight:600; font-size:0.28rem; }
.history-date { color:rgba(255,255,255,0.6); font-size:0.22rem; }

/* Rules */
.rules-section { background:rgba(255,255,255,0.08); margin:0 0.3rem; border-radius:0.3rem; padding:0.3rem; margin-bottom:0.3rem; }
.rules-title { color:#fff; font-size:0.30rem; font-weight:700; margin-bottom:0.15rem; }
.rules-text { color:rgba(255,255,255,0.8); font-size:0.24rem; line-height:1.8; }
</style>

<div class="wheel-page">
    <div class="wheel-header">
        <a href="{{ route('user.home') }}">
            <img src="{{ asset('assets/img/back.png') }}" alt="">
            <span>Roue de la Chance</span>
        </a>
        <div class="spins-badge">{{ $spinData->spins_available }} tour(s)</div>
    </div>

    <div class="wheel-title">Roue de la Chance</div>
    <div class="wheel-subtitle">Achetez un plan → Gagnez 1 tour gratuit !</div>

    <div class="info-cards">
        <div class="info-card">
            <div class="num">{{ $spinData->spins_available }}</div>
            <div class="label">Tours disponibles</div>
        </div>
        <div class="info-card">
            <div class="num">{{ $spinData->total_spins_used }}</div>
            <div class="label">Tours utilisés</div>
        </div>
    </div>

    <div class="wheel-container">
        <div class="wheel-pointer"></div>
        <canvas id="wheelCanvas" width="420" height="420"></canvas>
    </div>

    <div class="result-card" id="resultCard">
        <div class="result-prize" id="resultPrize"></div>
        <div class="result-text" id="resultText"></div>
    </div>

    <button class="spin-btn" id="spinBtn" @if($spinData->spins_available < 1) disabled @endif>
        @if($spinData->spins_available > 0) TOURNER LA ROUE @else Achetez un plan pour jouer @endif
    </button>

    <div class="rules-section">
        <div class="rules-title">Règles</div>
        <div class="rules-text">
            • Chaque achat de plan = 1 tour de roue offert<br>
            • Votre parrain reçoit aussi 1 tour (niveau 1 seulement)<br>
            • Les gains en FCFA sont crédités immédiatement<br>
            • Les tours non utilisés ne expirent pas
        </div>
    </div>

    @if($history->count() > 0)
    <div class="history-section">
        <div class="history-title">Historique récent</div>
        @foreach($history as $item)
        <div class="history-item">
            <div class="history-prize">{{ $item->prize_label }}</div>
            <div class="history-date">{{ $item->created_at->diffForHumans() }}</div>
        </div>
        @endforeach
    </div>
    @endif
</div>

@push('script')
<script>
const prizes = @json($prizes->values());
const spinBtn = document.getElementById('spinBtn');
const resultCard = document.getElementById('resultCard');
const resultPrize = document.getElementById('resultPrize');
const resultText = document.getElementById('resultText');
const canvas = document.getElementById('wheelCanvas');
const ctx = canvas.getContext('2d');
const CX = canvas.width / 2;
const CY = canvas.height / 2;
const R  = canvas.width / 2 - 12;

// Pointer is at the TOP (12 o'clock = -π/2).
// We offset the initial angle so segment 0 center sits at the pointer on load.
const N = prizes.length;
const sliceAngle = (2 * Math.PI) / N;
// initAngle: puts center of slice 0 at -π/2 (top)
let currentAngle = -Math.PI / 2 - sliceAngle / 2;
let spinning = false;

const colors = ['#1a56db','#0e3a8c','#1d4ed8','#f59e0b','#d97706'];

function drawWheel(angle) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let i = 0; i < N; i++) {
        const start = angle + i * sliceAngle;
        const end   = start + sliceAngle;

        ctx.beginPath();
        ctx.moveTo(CX, CY);
        ctx.arc(CX, CY, R, start, end);
        ctx.closePath();
        ctx.fillStyle = colors[i % colors.length];
        ctx.fill();
        ctx.strokeStyle = 'rgba(255,255,255,0.5)';
        ctx.lineWidth = 3;
        ctx.stroke();

        // Label
        ctx.save();
        ctx.translate(CX, CY);
        ctx.rotate(start + sliceAngle / 2);
        ctx.textAlign = 'right';
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 20px sans-serif';
        ctx.shadowColor = 'rgba(0,0,0,0.6)';
        ctx.shadowBlur = 4;
        ctx.fillText(prizes[i].label, R - 18, 7);
        ctx.restore();
    }

    // Centre circle
    ctx.beginPath();
    ctx.arc(CX, CY, 26, 0, 2 * Math.PI);
    ctx.fillStyle = '#fff';
    ctx.fill();
    ctx.strokeStyle = '#1a56db';
    ctx.lineWidth = 4;
    ctx.stroke();
    ctx.fillStyle = '#1a56db';
    ctx.font = 'bold 13px sans-serif';
    ctx.textAlign = 'center';
    ctx.shadowBlur = 0;
    ctx.fillText('GO', CX, CY + 5);
}

drawWheel(currentAngle);

spinBtn.addEventListener('click', function() {
    if (spinning) return;
    spinning = true;
    spinBtn.disabled = true;

    fetch('{{ route("user.lucky.wheel.spin") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({})
    })
    .then(r => r.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
            spinning = false;
            spinBtn.disabled = false;
            return;
        }

        const prizeIndex = data.prize_index !== undefined ? data.prize_index : 0;

        // Angle needed so center of prizeIndex sits at -π/2 (top pointer)
        // angle + prizeIndex * sliceAngle + sliceAngle/2 = -π/2  →  angle = -π/2 - (prizeIndex + 0.5) * sliceAngle
        const targetRaw = -Math.PI / 2 - (prizeIndex + 0.5) * sliceAngle;
        // Normalize target into [0, 2π)
        const target = ((targetRaw % (2 * Math.PI)) + 2 * Math.PI) % (2 * Math.PI);
        const curNorm = ((currentAngle % (2 * Math.PI)) + 2 * Math.PI) % (2 * Math.PI);
        const diff = (target - curNorm + 2 * Math.PI) % (2 * Math.PI);
        const extraSpins = (Math.floor(Math.random() * 3) + 5) * 2 * Math.PI;
        const finalAngle = currentAngle + extraSpins + diff;

        const duration = 4500;
        const startTime = Date.now();
        const startAngle = currentAngle;

        function animate() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 4);
            currentAngle = startAngle + (finalAngle - startAngle) * ease;
            drawWheel(currentAngle);

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                currentAngle = finalAngle;
                spinning = false;

                resultPrize.textContent = data.prize;
                let msg = '';
                if (data.prize_type === 'fcfa') msg = parseInt(data.prize_value).toLocaleString() + ' FCFA crédités sur votre compte !';
                else if (data.prize_type === 'bonus_percent') msg = 'Bonus de ' + data.prize_value + '% crédité !';
                else if (data.prize_type === 'spins') msg = '+' + data.prize_value + ' tour(s) supplémentaire(s) !';
                resultText.textContent = msg;
                resultCard.style.display = 'block';

                const badge = document.querySelector('.spins-badge');
                if (badge) badge.textContent = data.spins_left + ' tour(s)';

                if (data.spins_left > 0) {
                    spinBtn.disabled = false;
                    spinBtn.textContent = 'TOURNER LA ROUE';
                } else {
                    spinBtn.textContent = 'Achetez un plan pour jouer';
                }
            }
        }

        requestAnimationFrame(animate);
    })
    .catch(() => {
        spinning = false;
        spinBtn.disabled = false;
        alert('Erreur. Veuillez réessayer.');
    });
});
</script>
@endpush
@endsection
