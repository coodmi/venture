@extends('layouts.app')
@section('title', 'Join as Investor')

@section('content')
@php $siteLogo=\App\Models\Setting::get('site_logo'); $siteName=\App\Models\Setting::get('site_name',config('app.name')); @endphp
<div style="min-height:100vh;background:#f4f7fb;display:flex;align-items:center;justify-content:center;padding:2rem 1.25rem;">
    <div style="width:100%;max-width:28rem;">
        <div style="text-align:center;margin-bottom:2rem;">
            <a href="{{ route('home') }}" style="display:flex;align-items:center;justify-content:center;gap:.5rem;text-decoration:none;margin-bottom:1.25rem;">
                @if($siteLogo)
                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2.25rem;width:auto;object-fit:contain;">
                @else
                    <div style="width:2.25rem;height:2.25rem;background:#1a3c8f;border-radius:.5rem;display:flex;align-items:center;justify-content:center;"><span style="color:#fff;font-weight:800;font-size:.75rem;">{{ strtoupper(substr($siteName,0,2)) }}</span></div>
                    <span style="font-weight:700;font-size:1.125rem;color:#0d2b6e;">{{ $siteName }}</span>
                @endif
            </a>
            <h1 style="font-size:1.75rem;font-weight:800;color:#0d2b6e;margin:0 0 .375rem;letter-spacing:-.02em;">Join as Investor</h1>
            <p style="color:#8d98a1;font-size:.9375rem;margin:0;">Access curated investment opportunities</p>
        </div>

        <div style="background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.08);">
            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:.875rem 1rem;border-radius:.75rem;margin-bottom:1.25rem;font-size:.875rem;">
                <ul style="margin:0;padding-left:1.25rem;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register.investor') }}">
                @csrf
                @php $inp="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.9375rem;border-radius:.625rem;padding:.75rem 1rem;outline:none;box-sizing:border-box;"; $lbl="display:block;font-size:.8125rem;font-weight:600;color:#374151;margin-bottom:.5rem;"; @endphp

                <div style="margin-bottom:1.125rem;">
                    <label style="{{ $lbl }}">Full Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div style="margin-bottom:1.125rem;">
                    <label style="{{ $lbl }}">Email Address <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div style="margin-bottom:1.125rem;">
                    <label style="{{ $lbl }}">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div style="margin-bottom:1.125rem;">
                    <label style="{{ $lbl }}">Password <span style="color:#ef4444;">*</span></label>
                    <input type="password" name="password" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                    <p style="font-size:.75rem;color:#8d98a1;margin:.375rem 0 0;">Min 8 characters</p>
                </div>
                <div style="margin-bottom:1.5rem;">
                    <label style="{{ $lbl }}">Confirm Password <span style="color:#ef4444;">*</span></label>
                    <input type="password" name="password_confirmation" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <button type="submit" style="width:100%;background:linear-gradient(135deg,#1a3c8f,#2563eb);color:#fff;font-weight:700;font-size:1rem;padding:.875rem;border-radius:.75rem;border:none;cursor:pointer;" onmouseover="this.style.opacity='.9';" onmouseout="this.style.opacity='1';">
                    Create Investor Account →
                </button>
            </form>

            <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid #f1f5f9;text-align:center;">
                <p style="font-size:.875rem;color:#8d98a1;margin:0 0 .5rem;">Already have an account? <a href="{{ route('login') }}" style="color:#1a3c8f;font-weight:600;text-decoration:none;">Sign in</a></p>
                <p style="font-size:.875rem;color:#8d98a1;margin:0;">Looking for funding? <a href="{{ route('register.seeker') }}" style="color:#f97316;font-weight:600;text-decoration:none;">Join as Seeker</a></p>
            </div>
        </div>
        <p style="text-align:center;margin-top:1.5rem;"><a href="{{ route('home') }}" style="font-size:.8125rem;color:#8d98a1;text-decoration:none;" onmouseover="this.style.color='#1a3c8f';" onmouseout="this.style.color='#8d98a1';">← Back to Home</a></p>
    </div>
</div>
@endsection
