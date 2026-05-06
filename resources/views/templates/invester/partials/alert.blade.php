@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <div style="margin:0.2rem 0;padding:0.25rem 0.3rem;border-radius:0.15rem;font-size:0.26rem;font-weight:600;
            {{ $msg[0] === 'success' ? 'background:#dcfce7;color:#15803d;border-left:4px solid #16a34a;' : '' }}
            {{ $msg[0] === 'error' ? 'background:#fee2e2;color:#dc2626;border-left:4px solid #dc2626;' : '' }}
            {{ $msg[0] === 'warning' ? 'background:#fef3c7;color:#92400e;border-left:4px solid #f59e0b;' : '' }}
            {{ $msg[0] === 'info' ? 'background:#e0e7ff;color:#1e40af;border-left:4px solid #1a56db;' : '' }}">
            {{ __($msg[1]) }}
        </div>
    @endforeach
@endif
@if(isset($errors) && $errors->any())
    @foreach($errors->all() as $error)
        <div style="margin:0.2rem 0;padding:0.25rem 0.3rem;border-radius:0.15rem;font-size:0.26rem;font-weight:600;background:#fee2e2;color:#dc2626;border-left:4px solid #dc2626;">
            {{ __($error) }}
        </div>
    @endforeach
@endif
