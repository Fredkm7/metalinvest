@extends($activeTemplate . 'layouts.' . $layout)
@section('content')
<style>
/* Full-screen chat fixed above the bottom nav (~1.2rem tall) */
.chat-wrap {
    position: fixed;
    top: 0; left: 0; right: 0;
    bottom: 1.2rem; /* sits above the footer nav */
    display: flex;
    flex-direction: column;
    background: #0e1a35;
    z-index: 100;
}

/* Top bar */
.chat-topbar {
    display: flex; align-items: center; gap: 0.2rem;
    padding: 0.3rem;
    background: linear-gradient(135deg, #0e3a8c, #1a56db);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    flex-shrink: 0;
}
.chat-topbar a { color: #fff; display: flex; align-items: center; }
.chat-topbar img { width: 0.36rem; }
.chat-topbar-info { flex: 1; min-width: 0; }
.chat-topbar-title { color: #fff; font-size: 0.28rem; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.chat-topbar-sub { font-size: 0.2rem; margin-top: 0.02rem; }
.chat-topbar-sub.open  { color: #22c55e; }
.chat-topbar-sub.closed { color: #9ca3af; }

/* Scrollable messages */
.messages-area {
    flex: 1;
    overflow-y: auto;
    padding: 0.3rem;
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
    -webkit-overflow-scrolling: touch;
}

/* Bubbles */
.msg-row { display: flex; align-items: flex-end; gap: 0.15rem; }
.msg-row.from-user { flex-direction: row-reverse; }

.msg-avatar {
    width: 0.55rem; height: 0.55rem; border-radius: 50%;
    flex-shrink: 0; display: flex; align-items: center; justify-content: center;
}
.msg-avatar.support { background: linear-gradient(135deg, #1a56db, #3b82f6); }
.msg-avatar.user    { background: linear-gradient(135deg, #374151, #4b5563); }
.msg-avatar svg { width: 0.3rem; height: 0.3rem; }

.msg-meta { display: flex; flex-direction: column; max-width: 72%; }
.msg-row.from-user .msg-meta { align-items: flex-end; }

.msg-bubble {
    padding: 0.2rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.26rem;
    line-height: 1.6;
    word-break: break-word;
}
.msg-row.from-support .msg-bubble {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.12);
    color: #fff;
    border-bottom-left-radius: 0.04rem;
}
.msg-row.from-user .msg-bubble {
    background: linear-gradient(135deg, #1a56db, #2563eb);
    color: #fff;
    border-bottom-right-radius: 0.04rem;
}
.msg-time { font-size: 0.18rem; color: rgba(255,255,255,0.4); margin-top: 0.05rem; }

/* Attachments inside bubbles */
.msg-attachments { display: flex; flex-direction: column; gap: 0.12rem; margin-top: 0.12rem; }
.msg-attach-img {
    max-width: 100%; max-height: 3rem; border-radius: 0.15rem;
    object-fit: cover; display: block; cursor: pointer;
}
.msg-attach-file {
    display: flex; align-items: center; gap: 0.12rem;
    background: rgba(255,255,255,0.12); border-radius: 0.15rem;
    padding: 0.12rem 0.2rem; color: #fff; font-size: 0.22rem;
    text-decoration: none;
}
.msg-attach-file svg { width: 0.3rem; height: 0.3rem; flex-shrink: 0; }

/* Reply bar */
.reply-bar {
    background: #111e3a;
    border-top: 1px solid rgba(255,255,255,0.1);
    padding: 0.18rem 0.3rem;
    flex-shrink: 0;
}

/* File preview strip */
.file-preview-strip {
    display: flex; flex-wrap: wrap; gap: 0.15rem;
    padding-bottom: 0.15rem;
    display: none;
}
.file-preview-item {
    position: relative; width: 1rem; height: 1rem;
}
.file-preview-item img {
    width: 100%; height: 100%; object-fit: cover; border-radius: 0.1rem;
}
.file-preview-item .file-icon {
    width: 100%; height: 100%; border-radius: 0.1rem;
    background: rgba(255,255,255,0.1); display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 0.04rem;
}
.file-preview-item .file-icon svg { width: 0.36rem; height: 0.36rem; }
.file-preview-item .file-icon span { font-size: 0.16rem; color: rgba(255,255,255,0.7); max-width: 0.9rem; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
.file-remove-btn {
    position: absolute; top: -0.1rem; right: -0.1rem;
    width: 0.3rem; height: 0.3rem; border-radius: 50%;
    background: #ef4444; border: none; color: #fff;
    font-size: 0.18rem; line-height: 1; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    padding: 0;
}

.reply-input-row { display: flex; align-items: flex-end; gap: 0.2rem; }
.reply-input {
    flex: 1;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 0.4rem;
    padding: 0.18rem 0.28rem;
    color: #fff;
    font-size: 0.26rem;
    resize: none;
    max-height: 2rem;
    overflow-y: auto;
    line-height: 1.4;
}
.reply-input::placeholder { color: rgba(255,255,255,0.35); }
.reply-input:focus { outline: none; border-color: #3b82f6; }

.attach-btn {
    width: 0.7rem; height: 0.7rem; border-radius: 50%;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; cursor: pointer;
}
.attach-btn svg { width: 0.32rem; height: 0.32rem; }

.send-btn {
    width: 0.7rem; height: 0.7rem; border-radius: 50%;
    background: linear-gradient(135deg, #1a56db, #3b82f6);
    border: none; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; cursor: pointer;
}
.send-btn svg { width: 0.32rem; height: 0.32rem; }

.closed-bar {
    background: rgba(107,114,128,0.2);
    border-top: 1px solid rgba(255,255,255,0.08);
    padding: 0.25rem; text-align: center;
    color: rgba(255,255,255,0.5); font-size: 0.24rem;
    flex-shrink: 0;
}

/* Lightbox */
.lightbox-overlay {
    display: none; position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.92); align-items: center; justify-content: center;
}
.lightbox-overlay.active { display: flex; }
.lightbox-overlay img { max-width: 96vw; max-height: 90vh; border-radius: 0.15rem; }
.lightbox-close {
    position: absolute; top: 0.3rem; right: 0.3rem;
    color: #fff; font-size: 0.5rem; background: none; border: none;
    cursor: pointer; line-height: 1;
}
</style>

<div class="chat-wrap">
    {{-- Top bar --}}
    <div class="chat-topbar">
        <a href="{{ route('ticket.index') }}"><img src="{{ asset('assets/img/back.png') }}" alt=""></a>
        <div class="chat-topbar-info">
            <div class="chat-topbar-title">{{ $myTicket->subject }}</div>
            @if($myTicket->status == 3)
                <div class="chat-topbar-sub closed">Conversation fermée</div>
            @elseif($myTicket->status == 2)
                <div class="chat-topbar-sub open">● Répondu par le support</div>
            @else
                <div class="chat-topbar-sub open">● En attente de réponse</div>
            @endif
        </div>
    </div>

    {{-- Messages --}}
    <div class="messages-area" id="messagesArea">
        @foreach($messages->reverse() as $message)
            @php $isUser = ($message->admin_id == 0); @endphp
            <div class="msg-row {{ $isUser ? 'from-user' : 'from-support' }}">
                @if(!$isUser)
                <div class="msg-avatar support">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                @endif
                <div class="msg-meta">
                    <div class="msg-bubble">
                        {{ $message->message }}
                        @if($message->attachments && $message->attachments->count())
                        <div class="msg-attachments">
                            @foreach($message->attachments as $att)
                                @php
                                    $ext = strtolower(pathinfo($att->attachment, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp','bmp']);
                                    $fileUrl = route('user.attachment.download', encrypt(getFilePath('ticket').'/'.$att->attachment));
                                @endphp
                                @if($isImage)
                                    <img class="msg-attach-img" src="{{ $fileUrl }}" alt="photo"
                                         onclick="openLightbox('{{ $fileUrl }}')">
                                @else
                                    <a class="msg-attach-file" href="{{ $fileUrl }}" target="_blank">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        {{ $att->attachment }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="msg-time">{{ $message->created_at->format('d/m H:i') }}</div>
                </div>
                @if($isUser)
                <div class="msg-avatar user">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Reply or closed --}}
    @if($myTicket->status != 3)
    <div class="reply-bar">
        <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}"
              id="replyForm" enctype="multipart/form-data">
            @csrf

            {{-- Hidden file input --}}
            <input type="file" id="attachInput" name="attachments[]"
                   multiple accept="image/*,.pdf,.doc,.docx"
                   style="display:none" onchange="handleFiles(this)">

            {{-- File preview strip --}}
            <div class="file-preview-strip" id="filePreviewStrip"></div>

            <div class="reply-input-row">
                {{-- Attach button --}}
                <button type="button" class="attach-btn" onclick="document.getElementById('attachInput').click()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"/>
                    </svg>
                </button>

                <textarea name="message" class="reply-input" id="replyInput" rows="1"
                    placeholder="Écrire un message..."></textarea>

                <button type="submit" class="send-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="closed-bar">Cette conversation est fermée</div>
    @endif
</div>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">×</button>
    <img id="lightboxImg" src="" alt="">
</div>

<script>
(function() {
    var area = document.getElementById('messagesArea');
    if (area) area.scrollTop = area.scrollHeight;

    var input = document.getElementById('replyInput');
    if (input) {
        input.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 80) + 'px';
        });
    }

    // Validate: message or attachments required
    var form = document.getElementById('replyForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            var msg   = document.getElementById('replyInput').value.trim();
            var files = document.getElementById('attachInput').files;
            if (!msg && files.length === 0) {
                e.preventDefault();
                alert('Veuillez écrire un message ou joindre un fichier.');
            }
        });
    }
})();

var selectedFiles = [];

function handleFiles(input) {
    var newFiles = Array.from(input.files);
    selectedFiles = selectedFiles.concat(newFiles);
    renderPreviews();
    // Rebuild DataTransfer so the input reflects selectedFiles
    syncInput();
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    renderPreviews();
    syncInput();
}

function syncInput() {
    var dt = new DataTransfer();
    selectedFiles.forEach(function(f) { dt.items.add(f); });
    document.getElementById('attachInput').files = dt.files;
}

function renderPreviews() {
    var strip = document.getElementById('filePreviewStrip');
    strip.innerHTML = '';
    if (selectedFiles.length === 0) { strip.style.display = 'none'; return; }
    strip.style.display = 'flex';
    selectedFiles.forEach(function(file, i) {
        var item = document.createElement('div');
        item.className = 'file-preview-item';

        if (file.type.startsWith('image/')) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            item.appendChild(img);
        } else {
            var icon = document.createElement('div');
            icon.className = 'file-icon';
            icon.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg><span>' + file.name + '</span>';
            item.appendChild(icon);
        }

        var rm = document.createElement('button');
        rm.className = 'file-remove-btn';
        rm.innerHTML = '×';
        rm.type = 'button';
        rm.onclick = (function(idx) { return function() { removeFile(idx); }; })(i);
        item.appendChild(rm);

        strip.appendChild(item);
    });
}

function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxOverlay').classList.add('active');
}
function closeLightbox() {
    document.getElementById('lightboxOverlay').classList.remove('active');
    document.getElementById('lightboxImg').src = '';
}
</script>

@endsection
