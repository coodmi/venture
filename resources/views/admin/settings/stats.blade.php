@extends('layouts.admin')
@section('title', 'Platform Stats')
@section('page-title', 'Platform Statistics')

@section('content')
<div style="max-width:56rem;">
    <div style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1rem;padding:1.75rem;">
        <form method="POST" action="{{ route('admin.settings.stats.update') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                @foreach($stats as $stat)
                <div style="background:#0d0a04;border:1px solid rgba(212,146,15,.12);border-radius:.75rem;padding:1rem;display:flex;align-items:center;gap:1rem;">
                    <div style="flex:1;">
                        <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Label</label>
                        <input type="text" name="stats[{{ $stat->id }}][label]" value="{{ $stat->label }}"
                               style="width:100%;background:#1a1408;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='rgba(212,146,15,.6)';" onblur="this.style.borderColor='rgba(212,146,15,.2)';">
                    </div>
                    <div style="width:7rem;flex-shrink:0;">
                        <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Value</label>
                        <input type="text" name="stats[{{ $stat->id }}][value]" value="{{ $stat->value }}"
                               style="width:100%;background:#1a1408;border:1px solid rgba(212,146,15,.2);color:#d4920f;font-weight:700;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;"
                               onfocus="this.style.borderColor='rgba(212,146,15,.6)';" onblur="this.style.borderColor='rgba(212,146,15,.2)';">
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;">
                    Update Stats
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
