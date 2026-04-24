@extends('layouts.admin')
@section('title', 'Platform Stats')
@section('page-title', 'Platform Statistics')

@section('content')
@php $inp="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;"; @endphp
<div style="max-width:56rem;">
    <div style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <form method="POST" action="{{ route('admin.settings.stats.update') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                @foreach($stats as $stat)
                <div style="background:#f4f7fb;border:1px solid #dde3ea;border-radius:.75rem;padding:1rem;display:flex;align-items:center;gap:1rem;">
                    <div style="flex:1;">
                        <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Label</label>
                        <input type="text" name="stats[{{ $stat->id }}][label]" value="{{ $stat->label }}" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                    </div>
                    <div style="width:7rem;flex-shrink:0;">
                        <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Value</label>
                        <input type="text" name="stats[{{ $stat->id }}][value]" value="{{ $stat->value }}" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#1a3c8f;font-weight:700;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                <button type="submit" style="background:#1a3c8f;color:#fff;font-weight:700;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;">Update Stats</button>
            </div>
        </form>
    </div>
</div>
@endsection
