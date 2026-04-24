@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div style="min-height:100vh;background:#f4f7fb;display:flex;align-items:center;justify-content:center;padding:2rem 1.25rem;">
    <div style="width:100%;max-width:26rem;">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:2rem;">
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:.5rem;text-decoration:none;margin-bottom:1.5rem;">
                @php $siteLogo=\App\Models\Setting::get('site_logo'); $siteName=\App\Models\Setting::get('site_name',config('app.name')); @endphp
                @if($siteLogo)
                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2.5rem;width:auto;object-fit:contain;">
                @else
                    <div style="width:2.5rem;height:2.5rem;background:#1a3c8f;border-radius:.625rem;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#fff;font-weight:800;font-size:.875rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                    </div>
                    <span style="font-weight:700;font-size:1.25rem;color:#0d2b6e;">{{ $siteName }}</span>
                @endif
            </a>
            <h1 style="font-size:1.75rem;font-weight:800;color:#0d2b6e;margin:0 0 .375rem;letter-spacing:-.02em;">Welcome back</h1>
            <p style="color:#8d98a1;font-size:.9375rem;margin:0;">Sign in to your account</p>
        </div>

        {{-- Card --}}
        <div style="background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.08);">
            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:.875rem 1rem;border-radius:.75rem;margin-bottom:1.25rem;font-size:.875rem;">{{ $errors->first() }}</div>
            @endif
            @if(session('success'))
            <div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;padding:.875rem 1rem;border-radius:.75rem;margin-bottom:1.25rem;font-size:.875rem;">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                @php $inp="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.9375rem;border-radius:.625rem;padding:.75rem 1rem;outline:none;box-sizing:border-box;"; $lbl="display:block;font-size:.8125rem;font-weight:600;color:#374151;margin-bottom:.5rem;"; @endphp
                <div style="margin-bottom:1.25rem;">
                    <label style="{{ $lbl }}">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div style="margin-bottom:1.5rem;">
                    <label style="{{ $lbl }}">Password</label>
                    <input type="password" name="password" required style="{{ $inp }}" onfocus="this.style.borderColor='#1a3c8f';" onblur="this.style.borderColor='#dde3ea';">
                </div>
                <div style="margin-bottom:1.5rem;">
                    <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#8d98a1;cursor:pointer;">
                        <input type="checkbox" name="remember" style="accent-color:#1a3c8f;width:1rem;height:1rem;">
                        Remember me
                    </label>
                </div>
                <button type="submit" style="width:100%;background:linear-gradient(135deg,#1a3c8f,#2563eb);color:#fff;font-weight:700;font-size:1rem;padding:.875rem;border-radius:.75rem;border:none;cursor:pointer;" onmouseover="this.style.opacity='.9';" onmouseout="this.style.opacity='1';">
                    Sign In →
                </button>
            </form>

            <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid #f1f5f9;text-align:center;">
                <p style="font-size:.875rem;color:#8d98a1;margin:0 0 .875rem;">Don't have an account?</p>
                <div style="display:flex;gap:.625rem;justify-content:center;">
                    <a href="{{ route('register.investor') }}" style="flex:1;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-weight:600;padding:.625rem .875rem;border-radius:.625rem;text-decoration:none;text-align:center;font-size:.8125rem;" onmouseover="this.style.background='#dbeafe';" onmouseout="this.style.background='#eff6ff';">Join as Investor</a>
                    <a href="{{ route('register.seeker') }}" style="flex:1;background:#fff7ed;border:1px solid #fed7aa;color:#f97316;font-weight:600;padding:.625rem .875rem;border-radius:.625rem;text-decoration:none;text-align:center;font-size:.8125rem;" onmouseover="this.style.background='#ffedd5';" onmouseout="this.style.background='#fff7ed';">Join as Seeker</a>
                </div>
            </div>
        </div>

        <p style="text-align:center;margin-top:1.5rem;font-size:.8125rem;">
            <a href="{{ route('home') }}" style="color:#8d98a1;text-decoration:none;" onmouseover="this.style.color='#1a3c8f';" onmouseout="this.style.color='#8d98a1';">← Back to Home</a>
        </p>
    </div>
</div>
@endsection
