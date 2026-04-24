@extends('layouts.app')
@section('title', ($investor->user_name ?? 'Investor') . ' — Profile')

@section('content')
@php
    $typeLabels=['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate Investor','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabels=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $riskLabels=['conservative'=>'Conservative','moderate'=>'Moderate','aggressive'=>'Aggressive'];
    $typeColor=['angel'=>'#f97316','vc'=>'#1a3c8f','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#16a34a'];
    $coverGrads=['angel'=>'linear-gradient(160deg,#7c2d12 0%,#ea580c 60%,#fbbf24 100%)','vc'=>'linear-gradient(160deg,#0f172a 0%,#1e3a8a 60%,#3b82f6 100%)','corporate'=>'linear-gradient(160deg,#1e1b4b 0%,#4338ca 60%,#818cf8 100%)','family_office'=>'linear-gradient(160deg,#3b0764 0%,#7e22ce 60%,#c084fc 100%)','impact'=>'linear-gradient(160deg,#052e16 0%,#15803d 60%,#4ade80 100%)'];
    $ic   = $typeColor[$investor->investor_type] ?? '#1a3c8f';
    $grad = $coverGrads[$investor->investor_type] ?? 'linear-gradient(160deg,#0f172a,#1e3a8a,#3b82f6)';
    $name = $investor->user_name ?? 'Investor';
    $sectors = json_decode($investor->sector_preferences ?? '[]', true) ?: [];
    $geos    = json_decode($investor->geographic_interest ?? '[]', true) ?: [];
    $initials = strtoupper(substr($name,0,2));
@endphp

{{-- Back nav --}}
<div style="background:#fff;border-bottom:1px solid #dde3ea;padding:.75rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <a href="{{ route('investors.index') }}" style="color:#1a3c8f;font-size:.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:.375rem;font-weight:500;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to Investors
        </a>
    </div>
</div>

{{-- Profile Layout --}}
<div style="background:#f4f7fb;min-height:100vh;padding:2rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;display:grid;grid-template-columns:300px 1fr;gap:1.5rem;align-items:start;">

        {{-- LEFT COLUMN: Profile Card --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:5rem;">

            {{-- Main profile card --}}
            <div style="background:#fff;border-radius:1.5rem;border:1px solid #dde3ea;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,.08);">
                {{-- Cover --}}
                <div style="height:7rem;background:{{ $grad }};position:relative;overflow:hidden;">
                    <div style="position:absolute;inset:0;opacity:.1;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:20px 20px;"></div>
                    <div style="position:absolute;top:-2rem;right:-2rem;width:8rem;height:8rem;background:rgba(255,255,255,.08);border-radius:50%;"></div>
                </div>
                {{-- Avatar --}}
                <div style="padding:0 1.5rem 1.5rem;position:relative;">
                    <div style="width:5rem;height:5rem;border-radius:50%;background:{{ $ic }};border:4px solid #fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.5rem;color:#fff;margin-top:-2.5rem;box-shadow:0 4px 16px {{ $ic }}50;position:relative;z-index:1;">
                        {{ $initials }}
                    </div>
                    <div style="margin-top:.875rem;">
                        <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;margin-bottom:.25rem;">
                            <h1 style="font-size:1.25rem;font-weight:800;color:#0d2b6e;margin:0;">{{ $name }}</h1>
                            @if(($investor->verification_status??'')==='verified')
                            <svg width="18" height="18" fill="#16a34a" viewBox="0 0 20 20" title="Verified"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            @endif
                        </div>
                        @if($investor->designation)<p style="font-size:.8125rem;color:#374151;font-weight:500;margin:0 0 .125rem;">{{ $investor->designation }}</p>@endif
                        @if($investor->organization)<p style="font-size:.75rem;color:#8d98a1;margin:0;">{{ $investor->organization }}</p>@endif
                    </div>
                    <div style="margin-top:1rem;display:flex;flex-wrap:wrap;gap:.375rem;">
                        <span style="font-size:.7rem;font-weight:700;padding:.25rem .75rem;border-radius:9999px;background:{{ $ic }}15;color:{{ $ic }};border:1px solid {{ $ic }}30;">{{ $typeLabels[$investor->investor_type]??$investor->investor_type }}</span>
                        @if($investor->investment_stage)<span style="font-size:.7rem;background:#f1f5f9;color:#475569;padding:.25rem .75rem;border-radius:9999px;">{{ $stageLabels[$investor->investment_stage]??$investor->investment_stage }}</span>@endif
                    </div>
                    @if($investor->linkedin_url)
                    <a href="{{ $investor->linkedin_url }}" target="_blank" style="display:flex;align-items:center;justify-content:center;gap:.5rem;margin-top:1rem;background:#0a66c2;color:#fff;font-weight:600;padding:.625rem;border-radius:.75rem;font-size:.8125rem;text-decoration:none;">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        View LinkedIn
                    </a>
                    @endif
                </div>
            </div>

            {{-- Investment Stats --}}
            <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <p style="font-size:.7rem;font-weight:700;color:#8d98a1;text-transform:uppercase;letter-spacing:.08em;margin:0 0 1rem;">Investment Details</p>
                @if($investor->ticket_size_min && $investor->ticket_size_max)
                <div style="background:{{ $ic }}10;border:1px solid {{ $ic }}25;border-radius:.875rem;padding:1rem;margin-bottom:.875rem;text-align:center;">
                    <p style="font-size:.65rem;color:#8d98a1;margin:0 0 .25rem;text-transform:uppercase;letter-spacing:.06em;font-weight:600;">Ticket Size</p>
                    <p style="font-weight:800;color:{{ $ic }};font-size:1.125rem;margin:0;">৳{{ number_format($investor->ticket_size_min/100000,0) }}L – {{ number_format($investor->ticket_size_max/100000,0) }}L</p>
                </div>
                @endif
                @if($investor->risk_profile)
                <div style="display:flex;justify-content:space-between;padding:.5rem 0;border-bottom:1px solid #f1f5f9;font-size:.8125rem;">
                    <span style="color:#8d98a1;">Risk Profile</span>
                    <span style="font-weight:600;color:#0d2b6e;">{{ $riskLabels[$investor->risk_profile]??$investor->risk_profile }}</span>
                </div>
                @endif
                <div style="display:flex;justify-content:space-between;padding:.5rem 0;font-size:.8125rem;">
                    <span style="color:#8d98a1;">Status</span>
                    <span style="font-weight:600;color:#16a34a;">✓ Active</span>
                </div>
            </div>

            {{-- CTA --}}
            <div style="background:{{ $grad }};border-radius:1.25rem;padding:1.5rem;text-align:center;box-shadow:0 8px 24px {{ $ic }}30;">
                <p style="font-weight:700;font-size:.9375rem;color:#fff;margin:0 0 .375rem;">Seeking Investment?</p>
                <p style="color:rgba(255,255,255,.75);font-size:.78rem;margin:0 0 1rem;line-height:1.5;">Submit your startup and get discovered by {{ explode(' ',$name)[0] }}.</p>
                <a href="{{ route('register.seeker') }}" style="display:block;background:#fff;color:{{ $ic }};font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.8125rem;">Submit Your Startup →</a>
            </div>
        </div>

        {{-- RIGHT COLUMN: Content --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            @if($investor->bio)
            <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <h2 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0 0 1rem;display:flex;align-items:center;gap:.625rem;">
                    <span style="width:3px;height:1.125rem;background:{{ $ic }};border-radius:9999px;display:inline-block;"></span>
                    About {{ explode(' ',$name)[0] }}
                </h2>
                <p style="color:#374151;line-height:1.85;margin:0;font-size:.9375rem;">{{ $investor->bio }}</p>
            </div>
            @endif

            @if(!empty($sectors))
            <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <h2 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0 0 1.25rem;display:flex;align-items:center;gap:.625rem;">
                    <span style="width:3px;height:1.125rem;background:#f97316;border-radius:9999px;display:inline-block;"></span>
                    Sectors of Interest
                </h2>
                <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                    @foreach($sectors as $s)
                    <span style="background:#eff6ff;color:#1a3c8f;font-weight:600;padding:.5rem 1.125rem;border-radius:.75rem;font-size:.875rem;border:1px solid #bfdbfe;">{{ $s }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($geos))
            <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <h2 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0 0 1.25rem;display:flex;align-items:center;gap:.625rem;">
                    <span style="width:3px;height:1.125rem;background:#16a34a;border-radius:9999px;display:inline-block;"></span>
                    Geographic Focus
                </h2>
                <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                    @foreach($geos as $g)
                    <span style="background:#f0fdf4;color:#16a34a;font-weight:600;padding:.5rem 1.125rem;border-radius:.75rem;font-size:.875rem;border:1px solid #bbf7d0;">🌍 {{ $g }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Why Connect --}}
            <div style="background:linear-gradient(135deg,#f8faff,#eff6ff);border-radius:1.25rem;border:1px solid #bfdbfe;padding:1.75rem;">
                <h2 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0 0 1.25rem;">Why Connect with {{ explode(' ',$name)[0] }}?</h2>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                    @foreach([['Direct Access','No middlemen — pitch directly to the investor.','#1a3c8f'],['Verified Profile','Identity and credentials verified by VentureMatch.','#16a34a'],['Active Investor','Currently seeking new investment opportunities.','#f97316'],['Fast Response','Investors on our platform respond within 48 hours.','#8b5cf6']] as $w)
                    <div style="display:flex;align-items:flex-start;gap:.625rem;">
                        <div style="width:1.75rem;height:1.75rem;border-radius:.5rem;background:{{ $w[2] }}15;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:.125rem;">
                            <svg width="10" height="10" fill="{{ $w[2] }}" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <p style="font-size:.8125rem;font-weight:700;color:#0d2b6e;margin:0 0 .125rem;">{{ $w[0] }}</p>
                            <p style="font-size:.75rem;color:#8d98a1;margin:0;line-height:1.5;">{{ $w[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('register.seeker') }}" style="display:block;margin-top:1.5rem;background:linear-gradient(135deg,#1a3c8f,#2563eb);color:#fff;font-weight:700;padding:.875rem;border-radius:.875rem;text-decoration:none;font-size:.9375rem;text-align:center;box-shadow:0 4px 16px rgba(26,60,143,.25);">Submit Your Startup to Connect →</a>
            </div>
        </div>
    </div>
</div>
@endsection
