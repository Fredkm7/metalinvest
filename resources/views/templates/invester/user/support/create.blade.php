@extends($activeTemplate . 'layouts.master')
@section('content')
<style>
.chat-page { background:#0e1a35; min-height:100vh; display:flex; flex-direction:column; }
.chat-topbar { display:flex; align-items:center; gap:0.2rem; padding:0.3rem; background:linear-gradient(135deg,#0e3a8c,#1a56db); border-bottom:1px solid rgba(255,255,255,0.1); }
.chat-topbar a { color:#fff; display:flex; align-items:center; }
.chat-topbar img { width:0.36rem; }
.chat-topbar-title { color:#fff; font-size:0.32rem; font-weight:700; }

.new-conv-body { padding:0.4rem 0.3rem; flex:1; }
.support-info { display:flex; align-items:center; gap:0.25rem; background:rgba(255,255,255,0.07); border-radius:0.2rem; padding:0.3rem; margin-bottom:0.4rem; }
.support-avatar { width:0.8rem; height:0.8rem; border-radius:50%; background:linear-gradient(135deg,#1a56db,#3b82f6); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.support-avatar svg { width:0.45rem; height:0.45rem; }
.support-info-text .name { color:#fff; font-size:0.28rem; font-weight:700; }
.support-info-text .status { color:#22c55e; font-size:0.22rem; }

.form-label { color:rgba(255,255,255,0.7); font-size:0.24rem; display:block; margin-bottom:0.08rem; }
.form-group { margin-bottom:0.3rem; }
.form-input { width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:0.2rem; padding:0.22rem 0.3rem; color:#fff; font-size:0.28rem; box-sizing:border-box; }
.form-input::placeholder { color:rgba(255,255,255,0.35); }
.form-input:focus { outline:none; border-color:#3b82f6; background:rgba(59,130,246,0.1); }
textarea.form-input { resize:none; min-height:3rem; }
.send-btn { display:flex; align-items:center; justify-content:center; gap:0.15rem; width:100%; height:1rem; background:linear-gradient(135deg,#1a56db,#3b82f6); color:#fff; border:none; border-radius:0.5rem; font-size:0.3rem; font-weight:700; margin-top:0.2rem; cursor:pointer; }
.send-btn svg { width:0.35rem; height:0.35rem; }
</style>

<div class="chat-page">
    <div class="chat-topbar">
        <a href="{{ route('ticket.index') }}"><img src="{{ asset('assets/img/back.png') }}" alt=""></a>
        <div class="chat-topbar-title">Nouveau message</div>
    </div>

    <div class="new-conv-body">
        <div class="support-info">
            <div class="support-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <div class="support-info-text">
                <div class="name">Support METAL INVEST</div>
                <div class="status">● En ligne</div>
            </div>
        </div>

        <form action="{{ route('ticket.store') }}" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}">
            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
            <input type="hidden" name="priority" value="2">

            <div class="form-group">
                <label class="form-label">Sujet</label>
                <input type="text" name="subject" class="form-input" placeholder="Ex: Problème de retrait, Question sur un plan..." value="{{ old('subject') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Votre message</label>
                <textarea name="message" class="form-input" placeholder="Décrivez votre question ou problème..." required>{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="send-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                Envoyer
            </button>
        </form>
    </div>
</div>
@endsection
