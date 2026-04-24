@extends('layouts.app')
@section('title', $opportunity->title . ' — Investment Opportunity')

@section('content')
@php
    $sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f97316','CleanTech'=>'#8b5cf6','E-Commerce'=>'#0891b2','FoodTech'=>'#f59e0b','LogiTech'=>'#6366f1'];
    $coverGrads=['FinTech'=>'linear-gradient(135deg,#1a3c8f,#2563eb)','AgriTech'=>'linear-gradient(135deg,#14532d,#16a34a)','HealthTech'=>'linear-gradient(135deg,#991b1b,#ef4444)','EdTech'=>'linear-gradient(135deg,#c2410c,#f97316)','CleanTech'=>'linear-gradient(135deg,#5b21b6,#8b5cf6)','E-Commerce'=>'linear-gradient(135deg,#0e7490,#06b6d4)','FoodTech'=>'linear-gradient(135deg,#92400e,#f59e0b)','LogiTech'=>'linear-gradient(135deg,#1e1b4b,#6366f1)'];
    $sc   = $sectorColors[$opportunity->sector] ?? '#1a3c8f';
    $grad = $coverGrads[$opportunity->sector] ?? 'linear-gradient(135deg,#0d2b6e,#2563eb)';
@endphp

{{-- Top bar --}}
<div style="background:#fff;border-bottom:1px solid #dde3ea;padding:.75rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <a href="{{ route('investment.index') }}" style="color:#1a3c8f;font-size:.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:.375rem;font-weight:500;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to Investment
        </a>
        <div style="display:flex;gap:.5rem;">
            @if($opportunity->is_hot_deal)<span style="background:#fff7ed;color:#f97316;font-size:.72rem;font-weight:700;padding:.25rem .75rem;border-radius:9999px;border:1px solid #fed7aa;">🔥 Hot Deal</span>@endif
            @if($opportunity->is_featured)<span style="background:#eff6ff;color:#1a3c8f;font-size:.72rem;font-weight:700;padding:.25rem .75rem;border-radius:9999px;border:1px solid #bfdbfe;">⭐ Featured</span>@endif
        </div>
    </div>
</div>

<div style="background:#f4f7fb;min-height:100vh;padding:2rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Hero Card --}}
        <div style="background:#fff;border-radius:1.5rem;border:1px solid #dde3ea;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:2rem;">
            <div style="height:12rem;background:{{ $grad }};position:relative;overflow:hidden;display:flex;align-items:flex-end;padding:1.5rem;">
                <div style="position:absolute;inset:0;opacity:.07;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:24px 24px;"></div>
                <div style="position:absolute;top:-4rem;right:-4rem;width:16rem;height:16rem;background:rgba(255,255,255,.07);border-radius:50%;"></div>
                <div style="position:absolute;bottom:-6rem;left:30%;width:20rem;height:20rem;background:rgba(255,255,255,.04);border-radius:50%;"></div>
                {{-- Floating ask amount --}}
                @if($opportunity->ask_amount)
                <div style="position:absolute;top:1.25rem;right:1.5rem;background:rgba(0,0,0,.3);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.2);border-radius:1rem;padding:.875rem 1.25rem;text-align:right;">
                    <p style="color:rgba(255,255,255,.7);font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin:0 0 .2rem;">Investment Ask</p>
                    <p style="color:#fff;font-size:1.5rem;font-weight:800;margin:0;line-height:1;">৳{{ number_format($opportunity->ask_amount) }}</p>
                    @if($opportunity->ask_currency)<p style="color:rgba(255,255,255,.6);font-size:.7rem;margin:.2rem 0 0;">{{ $opportunity->ask_currency }}</p>@endif
                </div>
                @endif
            </div>
            <div style="padding:1.5rem 2rem;display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap;">
                <div style="width:4.5rem;height:4.5rem;border-radius:1.125rem;background:{{ $sc }};display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 6px 16px {{ $sc }}40;margin-top:-3.5rem;border:3px solid #fff;position:relative;z-index:1;">
                    <span style="color:#fff;font-weight:800;font-size:1.25rem;">{{ strtoupper(substr($opportunity->title,0,2)) }}</span>
                </div>
                <div style="flex:1;">
                    <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.5rem;">
                        @if($opportunity->sector)<span style="font-size:.72rem;font-weight:600;background:{{ $sc }}15;color:{{ $sc }};padding:.2rem .625rem;border-radius:9999px;border:1px solid {{ $sc }}30;">{{ $opportunity->sector }}</span>@endif
                        @if($opportunity->stage)<span style="font-size:.72rem;background:#f1f5f9;color:#475569;padding:.2rem .625rem;border-radius:9999px;">{{ $opportunity->stage }}</span>@endif
                        @if($opportunity->location)<span style="font-size:.72rem;color:#8d98a1;">📍 {{ $opportunity->location }}</span>@endif
                    </div>
                    <h1 style="font-size:1.625rem;font-weight:800;color:#0d2b6e;margin:0;line-height:1.2;">{{ $opportunity->title }}</h1>
                </div>
                @auth
                    @if(auth()->user()->hasRole('investor'))
                    <a href="{{ route('investor.opportunities.show',$opportunity->slug) }}" style="background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:.875rem;text-decoration:none;font-size:.9375rem;box-shadow:0 4px 16px rgba(249,115,22,.35);white-space:nowrap;">Express Interest →</a>
                    @endif
                @else
                <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:.875rem;text-decoration:none;font-size:.9375rem;box-shadow:0 4px 16px rgba(249,115,22,.35);white-space:nowrap;">Invest Now →</a>
                @endauth
            </div>
        </div>

        {{-- Two column layout --}}
        <div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start;">

            {{-- Left: Details --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">
                @php
                $sections=[
                    ['label'=>'The Problem','field'=>$opportunity->business_problem,'color'=>'#ef4444','bg'=>'#fef2f2','icon'=>'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                    ['label'=>'Our Solution','field'=>$opportunity->solution,'color'=>'#16a34a','bg'=>'#f0fdf4','icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                    ['label'=>'Target Market','field'=>$opportunity->target_market,'color'=>'#1a3c8f','bg'=>'#eff6ff','icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
                    ['label'=>'Traction & Milestones','field'=>$opportunity->traction,'color'=>'#f97316','bg'=>'#fff7ed','icon'=>'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                    ['label'=>'Use of Funds','field'=>$opportunity->use_of_funds,'color'=>'#8b5cf6','bg'=>'#faf5ff','icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
                @endphp
                @foreach($sections as $sec)
                @if(!empty($sec['field']))
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;padding-bottom:.875rem;border-bottom:2px solid {{ $sec['bg'] }};">
                        <div style="width:2.25rem;height:2.25rem;background:{{ $sec['bg'] }};border-radius:.625rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="15" height="15" fill="none" stroke="{{ $sec['color'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sec['icon'] }}"/></svg>
                        </div>
                        <h2 style="font-weight:700;color:#0d2b6e;font-size:1rem;margin:0;">{{ $sec['label'] }}</h2>
                    </div>
                    <div style="color:#374151;font-size:.9rem;line-height:1.85;">{!! nl2br(e($sec['field'])) !!}</div>
                </div>
                @endif
                @endforeach

                @if($opportunity->key_metrics)
                <div style="background:linear-gradient(135deg,#f8faff,#eff6ff);border-radius:1.25rem;border:1px solid #bfdbfe;padding:1.5rem;">
                    <h2 style="font-weight:700;color:#0d2b6e;font-size:1rem;margin:0 0 1rem;display:flex;align-items:center;gap:.625rem;">
                        <svg width="18" height="18" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Key Metrics
                    </h2>
                    <div style="color:#374151;font-size:.9rem;line-height:1.85;">{!! nl2br(e($opportunity->key_metrics)) !!}</div>
                </div>
                @endif
            </div>

            {{-- Right: Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:5rem;">
                {{-- CTA Box --}}
                <div style="background:linear-gradient(135deg,#0d2b6e,#1a3c8f);border-radius:1.25rem;padding:1.5rem;text-align:center;box-shadow:0 8px 24px rgba(13,43,110,.25);">
                    @if($opportunity->ask_amount)
                    <p style="color:rgba(255,255,255,.65);font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin:0 0 .25rem;">Raising</p>
                    <p style="color:#fb923c;font-size:1.75rem;font-weight:800;margin:0 0 1rem;line-height:1;">৳{{ number_format($opportunity->ask_amount) }}</p>
                    @endif
                    @auth
                        @if(auth()->user()->hasRole('investor'))
                        <a href="{{ route('investor.opportunities.show',$opportunity->slug) }}" style="display:block;background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-weight:700;padding:.875rem;border-radius:.875rem;text-decoration:none;font-size:.9375rem;box-shadow:0 4px 16px rgba(249,115,22,.4);margin-bottom:.625rem;">Express Interest →</a>
                        @else
                        <a href="{{ route('register.investor') }}" style="display:block;background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-weight:700;padding:.875rem;border-radius:.875rem;text-decoration:none;font-size:.9375rem;margin-bottom:.625rem;">Join to Invest →</a>
                        @endif
                    @else
                    <a href="{{ route('register.investor') }}" style="display:block;background:linear-gradient(135deg,#f97316,#fb923c);color:#fff;font-weight:700;padding:.875rem;border-radius:.875rem;text-decoration:none;font-size:.9375rem;box-shadow:0 4px 16px rgba(249,115,22,.4);margin-bottom:.625rem;">Join as Investor →</a>
                    <a href="{{ route('login') }}" style="color:rgba(255,255,255,.5);font-size:.8rem;text-decoration:none;">Already a member? Login</a>
                    @endauth
                </div>

                {{-- Quick Facts --}}
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <p style="font-size:.7rem;font-weight:700;color:#8d98a1;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .875rem;">Quick Facts</p>
                    @foreach([['Sector',$opportunity->sector],['Stage',$opportunity->stage],['Location',$opportunity->location],['Country',$opportunity->country],['Views',number_format($opportunity->views).' views']] as $f)
                    @if($f[1])
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid #f8fafc;font-size:.8125rem;">
                        <span style="color:#8d98a1;">{{ $f[0] }}</span>
                        <span style="font-weight:600;color:#0d2b6e;">{{ $f[1] }}</span>
                    </div>
                    @endif
                    @endforeach
                </div>

                {{-- Share / Save --}}
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,.04);text-align:center;">
                    <p style="font-size:.75rem;color:#8d98a1;margin:0 0 .75rem;">Have a startup like this?</p>
                    <a href="{{ route('register.seeker') }}" style="display:block;background:#f4f7fb;color:#1a3c8f;font-weight:600;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.8125rem;border:1px solid #dde3ea;">Submit Your Startup →</a>
                </div>
            </div>
        </div>

        {{-- Related --}}
        @if($related->count())
        <div style="margin-top:2.5rem;padding-top:2.5rem;border-top:1px solid #dde3ea;">
            <h2 style="font-size:1.125rem;font-weight:700;color:#0d2b6e;margin-bottom:1.5rem;">More in {{ $opportunity->sector }}</h2>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
                @foreach($related as $r)
                @php $rc=$sectorColors[$r->sector]??'#1a3c8f'; $rg=$coverGrads[$r->sector]??'linear-gradient(135deg,#0d2b6e,#2563eb)'; @endphp
                <a href="{{ route('investment.show',$r->slug) }}" style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;overflow:hidden;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.04);transition:all .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(26,60,143,.12)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,.04)';">
                    <div style="height:5rem;background:{{ $rg }};display:flex;align-items:center;justify-content:center;">
                        <span style="color:#fff;font-weight:800;font-size:1.125rem;background:rgba(255,255,255,.15);width:2.75rem;height:2.75rem;border-radius:.75rem;display:flex;align-items:center;justify-content:center;">{{ strtoupper(substr($r->title,0,2)) }}</span>
                    </div>
                    <div style="padding:1rem;">
                        <h3 style="font-weight:700;color:#0d2b6e;font-size:.875rem;margin:0 0 .375rem;">{{ $r->title }}</h3>
                        <p style="font-size:.75rem;color:#8d98a1;margin:0 0 .5rem;">{{ $r->stage }} · {{ $r->location }}</p>
                        @if($r->ask_amount)<p style="color:{{ $rc }};font-weight:700;font-size:.875rem;margin:0;">৳{{ number_format($r->ask_amount) }}</p>@endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
