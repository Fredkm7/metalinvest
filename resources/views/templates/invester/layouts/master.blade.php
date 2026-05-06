@extends($activeTemplate.'layouts.app')
@section('panel')

    @include($activeTemplate.'partials.sidebar')

    @yield('content')

<style>
    .notice-dialog .dialog-content{
        overflow-y: scroll;
        max-height: 6rem;
        height: auto;
    }
    .copy {
        margin-top: 0.2rem;
        background: #e0e7ff;
        border-radius: 0.24rem;
        font-weight: 600;
        color: #1a56db;
        font-size: 0.28rem;
        line-height: 0.4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.36rem;
    }
    .copy img { width: 0.75rem; }
    .copy .left { flex: 1; overflow: hidden; }
    .copy .code { font-weight: 400; color: #6b7280; }

    /* Footer navigation */
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #e0e7ff;
        z-index: 999;
        box-shadow: 0 -4px 20px rgba(26,86,219,0.12);
    }
    .footer .icons {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 0.12rem 0 0.08rem;
    }
    .footer .icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        flex: 1;
        padding: 0.08rem 0;
    }
    .footer .icon img { width: 0.55rem; height: 0.55rem; }
    .footer .icon p {
        font-size: 0.20rem;
        color: #9ca3af;
        margin-top: 0.05rem;
        font-weight: 500;
    }
    .footer .icon.active p { color: #1a56db; }
    .footer .icon.active img { filter: invert(30%) sepia(90%) saturate(700%) hue-rotate(210deg); }

    /* Floating Telegram button */
    .telegram-float {
        position: fixed;
        bottom: 1.8rem;
        right: 0.3rem;
        width: 1rem;
        height: 1rem;
        background: linear-gradient(135deg, #1a56db, #0e3a8c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(26,86,219,0.5);
        z-index: 998;
        text-decoration: none;
        font-size: 0.5rem;
        color: #fff;
        animation: pulse-btn 2s infinite;
    }
    @keyframes pulse-btn {
        0%, 100% { box-shadow: 0 4px 15px rgba(26,86,219,0.5); }
        50% { box-shadow: 0 4px 25px rgba(26,86,219,0.8), 0 0 0 8px rgba(26,86,219,0.1); }
    }
</style>

<!-- Footer Navigation -->
<div class="footer">
    <div class="icons">
        <a class="icon {{ request()->routeIs('user.home') ? 'active' : '' }}" href="{{ route('user.home') }}">
            <img src="{{ asset('assets/img/bhome_2.png') }}" alt="">
            <p>Accueil</p>
        </a>
        <a class="icon {{ request()->routeIs('user.invest.*') ? 'active' : '' }}" href="{{ route('user.invest.log') }}">
            <img src="{{ asset('assets/img/bbuy_1.png') }}" alt="">
            <p>Plans</p>
        </a>
        <a class="icon {{ request()->routeIs('user.withdrawal.accounts.*') ? 'active' : '' }}" href="{{ route('user.withdrawal.accounts.index') }}">
            <svg width="0.5rem" height="0.5rem" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            <p>Comptes</p>
        </a>
        <a class="icon {{ request()->routeIs('user.referrals') ? 'active' : '' }}" href="{{ route('user.referrals') }}">
            <img src="{{ asset('assets/img/bgift_1.png') }}" alt="">
            <p>Équipe</p>
        </a>
        <a class="icon {{ request()->routeIs('user.profile.*') ? 'active' : '' }}" href="{{ route('user.profile.setting') }}">
            <img src="{{ asset('assets/img/bmy_1.png') }}" alt="">
            <p>Profil</p>
        </a>
    </div>
</div>

<!-- Floating Telegram Button -->
<a href="https://t.me/METALINVEST01" target="_blank" class="telegram-float" title="Canal Telegram METAL INVEST">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/></svg>
</a>

</body>
</html>
<script src="{{ asset('assets/mb/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/mb/language.js') }}"></script>
<script src="{{ asset('assets/mb/swiper-4.2.0.min.js') }}"></script>
<script src="{{ asset('assets/mb/toast.js') }}"></script>
@stack('script')

@endsection
