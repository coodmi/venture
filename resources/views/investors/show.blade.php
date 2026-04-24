@extends('layouts.app')
@section('title', ($investor->user_name ?? 'Investor') . ' — Investor Profile')

@section('content')
@php
    $typeLabels=['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate Investor','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabels=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $riskLabels=['conservative'=>'Conservative','moderate'=>'Moderate','aggressive'=>'Aggressive'];
    $typeColor=['angel'=>'#f97316','vc'=>'#1a3c8f','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#16a34a'];
    $coverGrads=['angel'=>'linear-gradient(135deg,#7c2d12,#c2410c,#f97316)','vc'=>'linear-gradient(135deg,#0d2b6e,#1a3c8f,#2563eb)','corporate'=>'linear-gradient(135deg,#1e1b4b,#3730a3,#6366f1)','family_office'=>'linear-gradient(135deg,#4a044e,#6b21a8,#a855f7)','impact'=>'linear-gradient(135deg,#052e16,#14532d,#16a34a)'];
    $ic   = $typeColor[$investor->investor_type] ?? '#1a3c8f';
    $grad = $coverGrads[$investor->investor_type] ?? 'linear-gradient(135deg,#0d2b6e,#1a3c8f)';
    $name = $investor->user_name ?? 'Investor';
    $sectors = json_decode($investor->sector_preferences ?? '[]', true) ?: [];
    $geos    = json_decode($investor->geographic_interest ?? '[]', true) ?: [];
@endphp

{{-- Full-width profile cover --}}
<div style="position:relative;height:20rem;background:{{ $grad }};overflow:hidden;">
    <div style="position:absolute;inset:0;opacity:.06;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:24px 24px;"></div>
    <div style="position:absolute;top:-6rem;right:-6rem;width:24rem;height:24rem;background:rgba(255,255,255,.06);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-8rem;left:-4rem;width:28rem;height:28rem;background:rgba(255,255,255,.04);border-radius:50%;"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.5) 0%,transparent 60%);"></div>
    <div style="position:absolute;top:1.5rem;left:1.5rem;max-width:80rem;width:100%;margin:0 auto;">
        <a href="{{ route('investors.index') }}" style="color:rgba(255,255,255,.8);font-size:.8125rem;text-decoration:none;display:inline-flex;align-items:center;gap:.375rem;background:rgba(0,0,0,.2);padding:.375rem .875rem;border-radius:9999px;backdrop-filter:blur(4px);">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to Investors
        </a>
    </div>
    {{-- Type label --}}
    <div style="position:absolute;top:1.5rem;right:1.5rem;background:rgba(255,255,255,.15);color:#fff;font-size:.75rem;font-weight:700;padding:.375rem 1rem;border-radius:9999px;border:1px solid rgba(255,255,255,.25);backdrop-filter:blur(4px);">
        {{ $typeLabels[$investor->investor_type] ?? $investor->investor_type }}
    </div>
</div>

{{-- Profile identity card --}}
<div style="background:#f4f7fb;padding:0 1.5rem 3rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="background:#fff;border-radius:1.5rem;border:1px solid #dde3ea;padding:2rem;margin-top:-5rem;position:relative;z-index:10;box-shadow:0 12px 40px rgba(0,0,0,.12);display:flex;flex-wrap:wrap;align-items:center;gap:1.5rem;margin-bottom:2rem;">
            {{-- Avatar --}}
            <div style="width:6rem;height:6rem;border-radius:50%;background:{{ $ic }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:2rem;color:#fff;border:4px solid #fff;box-shadow:0 8px 24px {{ $ic }}50;">
                {{ strtoupper(substr($name,0,2)) }}
            </div>
            {{-- Info --}}
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;margin-bottom:.375rem;">
                    <h1 style="font-size:1.75rem;font-weight:800;color:#0d2b6e;margin:0;">{{ $name }}</h1>
                    @if(($investor->verification_status??'')==='verified')
                    <span style="display:inline-flex;align-items:center;gap:.25rem;background:#f0fdf4;color:#16a34a;font-size:.72rem;font-weight:700;padding:.25rem .75rem;border-radius:9999px;border:1px solid #bbf7d0;">
                        <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Verified
                    </span>
                    @endif
                </div>
                @if($investor->designation || $investor->organization)
                <p style="color:#8d98a1;font-size:.9375rem;margin:0 0 .75rem;">
                    {{ $investor->designation }}@if($investor->designation && $investor->organization) · @endif{{ $investor->organization }}
                </p>
                @endif
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
                    <span style="font-size:.75rem;font-weight:600;padding:.25rem .75rem;border-radius:9999px;background:{{ $ic }}15;color:{{ $ic }};border:1px solid {{ $ic }}30;">{{ $typeLabels[$investor->investor_type]??$investor->investor_type }}</span>
                    @if($investor->investment_stage)<span style="font-size:.75rem;background:#f1f5f9;color:#475569;padding:.25rem .75rem;border-radius:9999px;">{{ $stageLabels[$investor->investment_stage]??$investor->investment_stage }}</span>@endif
                </div>
            </div>
            {{-- Actions --}}
            <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                @if($investor->linkedin_url)
                <a href="{{ $investor->linkedin_url }}" target="_blank" style="display:inline-flex;align-items:center;gap:.5rem;background:#0a66c2;color:#fff;font-weight:600;padding:.625rem 1.25rem;border-radius:.75rem;font-size:.875rem;text-decoration:none;">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    LinkedIn
                </a>
                @endif
                @guest
                <a href="{{ route('register.seeker') }}" style="background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-weight:700;padding:.625rem 1.5rem;border-radius:.75rem;font-size:.875rem;text-decoration:none;box-shadow:0 4px 12px rgba(249,115,22,.3);">Connect Now</a>
                @endguest
            </div>
        </div>

        {{-- Content Grid --}}
        <div style="display:grid;grid-template-columns:1fr 300px;gap:2rem;align-items:start;">
            {{-- Left --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                @if($investor->bio)
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;">
                        <div style="width:2.25rem;height:2.25rem;background:#eff6ff;border-radius:.625rem;display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h2 style="font-weight:700;color:#0d2b6e;font-size:1.0625rem;margin:0;">About</h2>
                    </div>
                    <p style="color:#374151;line-height:1.8;margin:0;font-size:.9375rem;">{{ $investor->bio }}</p>
                </div>
                @endif

                @if(!empty($sectors))
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;">
                        <div style="width:2.25rem;height:2.25rem;background:#fff7ed;border-radius:.625rem;display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" fill="none" stroke="#f97316" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'/></svg>
                        </div>
                        <h2 style="font-weight:700;color:#0d2b6e;font-size:1.0625rem;margin:0;">Sector Focus</h2>
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                        @foreach($sectors as $sector)
                        <span style="background:#eff6ff;color:#1a3c8f;font-weight:600;padding:.5rem 1.125rem;border-radius:.75rem;font-size:.875rem;border:1px solid #bfdbfe;">{{ $sector }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!empty($geos))
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.75rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;">
                        <div style="width:2.25rem;height:2.25rem;background:#f0fdf4;border-radius:.625rem;display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                        </div>
                        <h2 style="font-weight:700;color:#0d2b6e;font-size:1.0625rem;margin:0;">Geographic Interest</h2>
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                        @foreach($geos as $geo)
                        <span style="background:#f0fdf4;color:#16a34a;font-weight:600;padding:.5rem 1.125rem;border-radius:.75rem;font-size:.875rem;border:1px solid #bbf7d0;">🌍 {{ $geo }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:6rem;">
                {{-- Investment Profile --}}
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h3 style="font-weight:700;color:#0d2b6e;margin:0 0 1.25rem;font-size:.9375rem;">Investment Profile</h3>
                    <div style="display:flex;flex-direction:column;gap:0;">
                        @if($investor->ticket_size_min && $investor->ticket_size_max)
                        <div style="padding:.875rem;background:linear-gradient(135deg,{{ $ic }}10,{{ $ic }}05);border-radius:.75rem;margin-bottom:.875rem;border:1px solid {{ $ic }}20;">
                            <p style="font-size:.7rem;color:#8d98a1;margin:0 0 .25rem;text-transform:uppercase;letter-spacing:.06em;font-weight:600;">Ticket Size</p>
                            <p style="font-weight:800;color:{{ $ic }};font-size:1.125rem;margin:0;">৳{{ number_format($investor->ticket_size_min) }} – ৳{{ number_format($investor->ticket_size_max) }}</p>
                        </div>
                        @endif
                        @foreach([['Stage',$investor->investment_stage?($stageLabels[$investor->investment_stage]??$investor->investment_stage):null],['Risk Profile',$investor->risk_profile?($riskLabels[$investor->risk_profile]??$investor->risk_profile):null],['Status',($investor->verification_status??'')==='verified'?'✓ Verified':null]] as $row)
                        @if($row[1])
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:.625rem 0;border-bottom:1px solid #f1f5f9;font-size:.875rem;">
                            <span style="color:#8d98a1;">{{ $row[0] }}</span>
                            <span style="font-weight:600;color:{{ $row[0]==='Status'?'#16a34a':'#0d2b6e' }};">{{ $row[1] }}</span>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                {{-- CTA --}}
                <div style="background:linear-gradient(135deg,{{ $ic }},{{ $ic }}cc);border-radius:1.25rem;padding:1.5rem;text-align:center;box-shadow:0 8px 24px {{ $ic }}40;">
                    <p style="font-weight:700;font-size:1rem;color:#fff;margin:0 0 .375rem;">Have a startup?</p>
                    <p style="color:rgba(255,255,255,.75);font-size:.8125rem;margin:0 0 1.25rem;line-height:1.5;">Get in front of {{ explode(' ',$name)[0] }} and other investors.</p>
                    <a href="{{ route('register.seeker') }}" style="display:block;background:#fff;color:{{ $ic }};font-weight:700;padding:.75rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">Submit Your Startup →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
