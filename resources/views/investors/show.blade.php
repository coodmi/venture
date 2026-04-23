@extends('layouts.app')
@section('title', $investor->user->name . ' — Investor Profile')

@section('content')
@php
    $typeLabels=['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate Investor','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabels=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $riskLabels=['conservative'=>'Conservative','moderate'=>'Moderate','aggressive'=>'Aggressive'];
    $typeColor=['angel'=>'#f97316','vc'=>'#1a3c8f','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#16a34a'];
    $ic=$typeColor[$investor->investor_type]??'#1a3c8f';
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:3rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <a href="{{ route('investors.index') }}" style="color:rgba(255,255,255,.7);font-size:.875rem;text-decoration:none;margin-bottom:1.5rem;display:inline-block;">← Back to Investors</a>
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:1.5rem;">
            <div style="width:5rem;height:5rem;border-radius:1.25rem;background:{{ $ic }};display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:1.75rem;flex-shrink:0;box-shadow:0 8px 24px rgba(0,0,0,.2);">
                {{ strtoupper(substr($investor->user->name,0,2)) }}
            </div>
            <div style="flex:1;">
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.5rem;flex-wrap:wrap;">
                    <h1 style="font-size:1.875rem;font-weight:800;color:#fff;margin:0;">{{ $investor->user->name }}</h1>
                    @if($investor->verification_status==='verified')
                    <span style="color:#34d399;" title="Verified">
                        <svg style="width:1.5rem;height:1.5rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </span>
                    @endif
                </div>
                <p style="color:rgba(255,255,255,.75);margin:0 0 .75rem;">{{ $investor->designation }}@if($investor->organization) · {{ $investor->organization }}@endif</p>
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
                    <span style="font-size:.75rem;background:rgba(255,255,255,.15);color:#fff;padding:.25rem .75rem;border-radius:9999px;border:1px solid rgba(255,255,255,.25);">{{ $typeLabels[$investor->investor_type]??$investor->investor_type }}</span>
                    @if($investor->investment_stage)<span style="font-size:.75rem;background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);padding:.25rem .75rem;border-radius:9999px;">{{ $stageLabels[$investor->investment_stage]??$investor->investment_stage }}</span>@endif
                </div>
            </div>
            <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                @if($investor->linkedin_url)
                <a href="{{ $investor->linkedin_url }}" target="_blank" style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;padding:.5rem 1.25rem;border-radius:.75rem;font-size:.875rem;font-weight:600;text-decoration:none;">LinkedIn →</a>
                @endif
                @guest
                <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;padding:.5rem 1.25rem;border-radius:.75rem;font-size:.875rem;font-weight:700;text-decoration:none;">Connect</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<section style="padding:3rem 0;background:#f4f7fb;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:grid;grid-template-columns:1fr 320px;gap:2rem;align-items:start;">

            {{-- Main --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                @if($investor->bio)
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h2 style="font-weight:700;color:#0d2b6e;font-size:1.125rem;margin-bottom:.75rem;">About</h2>
                    <p style="color:#8d98a1;line-height:1.75;margin:0;">{{ $investor->bio }}</p>
                </div>
                @endif

                @if($investor->sector_preferences)
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h2 style="font-weight:700;color:#0d2b6e;font-size:1.125rem;margin-bottom:1rem;">Sector Focus</h2>
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                        @foreach($investor->sector_preferences as $sector)
                        <span style="background:#eff6ff;color:#1a3c8f;font-weight:600;padding:.5rem 1rem;border-radius:.75rem;font-size:.875rem;border:1px solid #bfdbfe;">{{ $sector }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($investor->geographic_interest)
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h2 style="font-weight:700;color:#0d2b6e;font-size:1.125rem;margin-bottom:1rem;">Geographic Interest</h2>
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                        @foreach($investor->geographic_interest as $geo)
                        <span style="background:#f0fdf4;color:#16a34a;font-weight:600;padding:.5rem 1rem;border-radius:.75rem;font-size:.875rem;border:1px solid #bbf7d0;">{{ $geo }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:6rem;">
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h3 style="font-weight:700;color:#0d2b6e;margin-bottom:1rem;">Investment Profile</h3>
                    <div style="display:flex;flex-direction:column;gap:.875rem;">
                        @if($investor->ticket_size_min && $investor->ticket_size_max)
                        <div>
                            <p style="font-size:.75rem;color:#8d98a1;margin-bottom:.25rem;">Ticket Size</p>
                            <p style="font-weight:700;color:#1a3c8f;margin:0;">৳{{ number_format($investor->ticket_size_min) }} – ৳{{ number_format($investor->ticket_size_max) }}</p>
                        </div>
                        @endif
                        @if($investor->investment_stage)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;padding-top:.75rem;border-top:1px solid #f1f5f9;"><span style="color:#8d98a1;">Stage</span><span style="font-weight:600;color:#0d2b6e;">{{ $stageLabels[$investor->investment_stage]??$investor->investment_stage }}</span></div>
                        @endif
                        @if($investor->risk_profile)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;padding-top:.75rem;border-top:1px solid #f1f5f9;"><span style="color:#8d98a1;">Risk Profile</span><span style="font-weight:600;color:#0d2b6e;">{{ $riskLabels[$investor->risk_profile]??$investor->risk_profile }}</span></div>
                        @endif
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;padding-top:.75rem;border-top:1px solid #f1f5f9;">
                            <span style="color:#8d98a1;">Status</span>
                            <span style="color:#16a34a;font-weight:600;">✓ Verified</span>
                        </div>
                    </div>
                </div>

                <div style="background:linear-gradient(135deg,#0d2b6e,#1a3c8f);border-radius:1.25rem;padding:1.5rem;text-align:center;box-shadow:0 4px 16px rgba(26,60,143,.15);">
                    <p style="font-weight:700;font-size:1rem;color:#fff;margin-bottom:.5rem;">Looking to raise funds?</p>
                    <p style="color:rgba(255,255,255,.7);font-size:.8125rem;margin-bottom:1rem;line-height:1.5;">Submit your startup and get discovered by investors like {{ explode(' ',$investor->user->name)[0] }}.</p>
                    <a href="{{ route('register.seeker') }}" style="display:block;background:#f97316;color:#fff;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">
                        Submit Your Startup
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
