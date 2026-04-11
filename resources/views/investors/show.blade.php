@extends('layouts.app')
@section('title', $investor->user->name . ' — Investor Profile')

@section('content')
@php
    $typeLabels = ['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate Investor','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabels = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $riskLabels = ['conservative'=>'Conservative','moderate'=>'Moderate','aggressive'=>'Aggressive'];
    $typeGradients = [
        'angel'        => 'linear-gradient(135deg,#d4920f,#f59e0b)',
        'vc'           => 'linear-gradient(135deg,#d4920f,#b8780a)',
        'corporate'    => 'linear-gradient(135deg,#3b82f6,#4f46e5)',
        'family_office'=> 'linear-gradient(135deg,#9333ea,#db2777)',
        'impact'       => 'linear-gradient(135deg,#10b981,#0d9488)',
    ];
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);color:#f0e6c8;padding:3rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <a href="{{ route('investors.index') }}" style="color:rgba(212,146,15,.6);font-size:.875rem;text-decoration:none;margin-bottom:1.5rem;display:inline-block;">← Back to Investors</a>
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:1.5rem;">
            <div style="width:5rem;height:5rem;border-radius:1.25rem;background:{{ $typeGradients[$investor->investor_type] ?? 'linear-gradient(135deg,#d4920f,#b8780a)' }};display:flex;align-items:center;justify-content:center;color:#0d0a04;font-weight:800;font-size:1.75rem;flex-shrink:0;">
                {{ strtoupper(substr($investor->user->name, 0, 2)) }}
            </div>
            <div style="flex:1;">
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.5rem;">
                    <h1 style="font-size:1.875rem;font-weight:800;color:#f0e6c8;">{{ $investor->user->name }}</h1>
                    @if($investor->verification_status === 'verified')
                    <span style="color:#d4920f;" title="Verified Investor">
                        <svg style="width:1.5rem;height:1.5rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </span>
                    @endif
                </div>
                <p style="color:#9a8a6a;">{{ $investor->designation }} · {{ $investor->organization }}</p>
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.75rem;">
                    <span style="font-size:.75rem;background:rgba(212,146,15,.12);color:#d4920f;padding:.25rem .75rem;border-radius:9999px;border:1px solid rgba(212,146,15,.2);">{{ $typeLabels[$investor->investor_type] ?? $investor->investor_type }}</span>
                    @if($investor->investment_stage)<span style="font-size:.75rem;background:rgba(240,230,200,.06);color:#9a8a6a;padding:.25rem .75rem;border-radius:9999px;border:1px solid rgba(240,230,200,.1);">{{ $stageLabels[$investor->investment_stage] ?? $investor->investment_stage }}</span>@endif
                </div>
            </div>
            <div style="display:flex;gap:.75rem;">
                @if($investor->linkedin_url)
                <a href="{{ $investor->linkedin_url }}" target="_blank" style="background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:#d4920f;padding:.5rem 1rem;border-radius:.75rem;font-size:.875rem;font-weight:500;text-decoration:none;">LinkedIn →</a>
                @endif
                @guest
                <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;padding:.5rem 1.25rem;border-radius:.75rem;font-size:.875rem;font-weight:700;text-decoration:none;">Connect</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<section style="padding:3rem 0;background:#0d0a04;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:grid;grid-template-columns:1fr 320px;gap:2rem;align-items:start;">

            {{-- Bio --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                @if($investor->bio)
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.5rem;">
                    <h2 style="font-weight:700;color:#f0e6c8;font-size:1.125rem;margin-bottom:.75rem;">About</h2>
                    <p style="color:#9a8a6a;line-height:1.75;">{{ $investor->bio }}</p>
                </div>
                @endif

                @if($investor->sector_preferences)
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.5rem;">
                    <h2 style="font-weight:700;color:#f0e6c8;font-size:1.125rem;margin-bottom:1rem;">Sector Focus</h2>
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                        @foreach($investor->sector_preferences as $sector)
                        <span style="background:rgba(212,146,15,.1);color:#d4920f;font-weight:600;padding:.5rem 1rem;border-radius:.75rem;font-size:.875rem;border:1px solid rgba(212,146,15,.2);">{{ $sector }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:6rem;">
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.5rem;">
                    <h3 style="font-weight:700;color:#f0e6c8;margin-bottom:1rem;">Investment Profile</h3>
                    <div style="display:flex;flex-direction:column;gap:1rem;">
                        @if($investor->ticket_size_min && $investor->ticket_size_max)
                        <div>
                            <p style="font-size:.75rem;color:#7a6a4a;margin-bottom:.25rem;">Ticket Size</p>
                            <p style="font-weight:700;color:#d4920f;">৳{{ number_format($investor->ticket_size_min) }} – ৳{{ number_format($investor->ticket_size_max) }}</p>
                        </div>
                        @endif
                        @if($investor->investment_stage)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Stage</span><span style="font-weight:500;color:#f0e6c8;">{{ $stageLabels[$investor->investment_stage] ?? $investor->investment_stage }}</span></div>
                        @endif
                        @if($investor->risk_profile)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Risk Profile</span><span style="font-weight:500;color:#f0e6c8;">{{ $riskLabels[$investor->risk_profile] ?? $investor->risk_profile }}</span></div>
                        @endif
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Status</span>
                            <span style="color:#34d399;font-weight:600;">✓ Verified</span>
                        </div>
                    </div>
                </div>

                <div style="background:linear-gradient(135deg,#1a1408,#241c0a);border-radius:1.25rem;padding:1.5rem;text-align:center;border:1px solid rgba(212,146,15,.2);">
                    <p style="font-weight:700;font-size:1.125rem;color:#f0e6c8;margin-bottom:.5rem;">Looking to raise funds?</p>
                    <p style="color:#7a6a4a;font-size:.875rem;margin-bottom:1rem;">Submit your startup and get discovered by investors like {{ explode(' ', $investor->user->name)[0] }}.</p>
                    <a href="{{ route('register.seeker') }}" style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">
                        Submit Your Startup
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
