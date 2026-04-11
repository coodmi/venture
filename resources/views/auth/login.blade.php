@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div style="min-height:100vh;background:linear-gradient(135deg,#0d0a04 0%,#1a1208 50%,#241c0a 100%);display:flex;align-items:center;justify-content:center;padding:2rem 1.25rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-8rem;right:-8rem;width:30rem;height:30rem;background:rgba(212,146,15,.06);border-radius:50%;filter:blur(60px);"></div>
    <div style="position:absolute;bottom:-8rem;left:-8rem;width:25rem;height:25rem;background:rgba(212,146,15,.04);border-radius:50%;filter:blur(60px);"></div>

    <div style="width:100%;max-width:26rem;position:relative;">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:2rem;">
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:.5rem;text-decoration:none;margin-bottom:1.5rem;">
                @php $siteLogo = \App\Models\Setting::get('site_logo'); $siteName = \App\Models\Setting::get('site_name', config('app.name')); @endphp
                @if($siteLogo)
                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2.5rem;width:auto;object-fit:contain;">
                @else
                    <div style="width:2.5rem;height:2.5rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:.625rem;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#0d0a04;font-weight:800;font-size:.875rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                    </div>
                    <span style="font-weight:700;font-size:1.25rem;color:#f0e6c8;">{{ $siteName }}</span>
                @endif
            </a>
            <h1 style="font-size:1.75rem;font-weight:800;color:#f0e6c8;margin:0 0 .375rem;letter-spacing:-.02em;">Welcome back</h1>
            <p style="color:#7a6a4a;font-size:.9375rem;margin:0;">Sign in to your account</p>
        </div>

        {{-- Card --}}
        <div style="background:#1a1408;border:1px solid rgba(212,146,15,.2);border-radius:1.25rem;padding:2rem;box-shadow:0 20px 60px rgba(0,0,0,.4);">

            @if($errors->any())
            <div style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#f87171;padding:.875rem 1rem;border-radius:.75rem;margin-bottom:1.25rem;font-size:.875rem;">
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('success'))
            <div style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#34d399;padding:.875rem 1rem;border-radius:.75rem;margin-bottom:1.25rem;font-size:.875rem;">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;font-size:.9375rem;border-radius:.625rem;padding:.75rem 1rem;outline:none;box-sizing:border-box;transition:border-color .2s;"
                        onfocus="this.style.borderColor='rgba(212,146,15,.6)';" onblur="this.style.borderColor='rgba(212,146,15,.2)';">
                </div>
                <div style="margin-bottom:1.5rem;">
                    <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;">Password</label>
                    <input type="password" name="password" required
                        style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;font-size:.9375rem;border-radius:.625rem;padding:.75rem 1rem;outline:none;box-sizing:border-box;transition:border-color .2s;"
                        onfocus="this.style.borderColor='rgba(212,146,15,.6)';" onblur="this.style.borderColor='rgba(212,146,15,.2)';">
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                    <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#7a6a4a;cursor:pointer;">
                        <input type="checkbox" name="remember" style="accent-color:#d4920f;width:1rem;height:1rem;">
                        Remember me
                    </label>
                </div>
                <button type="submit" style="width:100%;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;font-size:1rem;padding:.875rem;border-radius:.75rem;border:none;cursor:pointer;letter-spacing:.01em;transition:opacity .2s;" onmouseover="this.style.opacity='.9';" onmouseout="this.style.opacity='1';">
                    Sign In →
                </button>
            </form>

            <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid rgba(212,146,15,.1);text-align:center;">
                <p style="font-size:.875rem;color:#6b5c3e;margin:0 0 .875rem;">Don't have an account?</p>
                <div style="display:flex;gap:.625rem;justify-content:center;">
                    <a href="{{ route('register.investor') }}" style="flex:1;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:#d4920f;font-weight:600;padding:.625rem .875rem;border-radius:.625rem;text-decoration:none;text-align:center;font-size:.8125rem;transition:all .2s;" onmouseover="this.style.background='rgba(212,146,15,.2)';" onmouseout="this.style.background='rgba(212,146,15,.1)';">Join as Investor</a>
                    <a href="{{ route('register.seeker') }}" style="flex:1;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:#d4920f;font-weight:600;padding:.625rem .875rem;border-radius:.625rem;text-decoration:none;text-align:center;font-size:.8125rem;transition:all .2s;" onmouseover="this.style.background='rgba(212,146,15,.2)';" onmouseout="this.style.background='rgba(212,146,15,.1)';">Join as Seeker</a>
                </div>
            </div>
        </div>

        <p style="text-align:center;margin-top:1.5rem;font-size:.8125rem;color:#4a3a22;">
            <a href="{{ route('home') }}" style="color:rgba(212,146,15,.5);text-decoration:none;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(212,146,15,.5)';">← Back to Home</a>
        </p>
    </div>
</div>
@endsection
