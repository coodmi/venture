@extends('layouts.app')
@section('title', $opportunity->title . ' — Deal Room')

@section('content')
@php
    $sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f97316','CleanTech'=>'#8b5cf6','E-Commerce'=>'#0891b2','FoodTech'=>'#f59e0b','LogiTech'=>'#6366f1'];
    $sc = $sectorColors[$opportunity->sector] ?? '#1a3c8f';
@endphp

{{-- Deal Room Header --}}
<div style="background:#0d2b6e;padding:2rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <a href="{{ route('investment.index') }}" style="color:rgba(255,255,255,.6);font-size:.8125rem;text-decoration:none;display:inline-flex;align-items:center;gap:.375rem;margin-bottom:1.5rem;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Investment Opportunities
        </a>
        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1.5rem;">
            <div style="display:flex;align-items:center;gap:1.25rem;">
                <div style="width:4rem;height:4rem;border-radius:1rem;background:{{ $sc }};display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.25rem;color:#fff;flex-shrink:0;">
                    {{ strtoupper(substr($opportunity->title,0,2)) }}
                </div>
                <div>
                    <div style="display:flex;align-items:center;gap:.625rem;flex-wrap:wrap;margin-bottom:.375rem;">
                        <h1 style="font-size:1.5rem;font-weight:800;color:#fff;margin:0;">{{ $opportunity->title }}</h1>
                        @if($opportunity->is_hot_deal)<span style="background:rgba(249,115,22,.2);color:#fb923c;font-size:.65rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;border:1px solid rgba(249,115,22,.3);">🔥 Hot Deal</span>@endif
                        @if($opportunity->is_featured)<span style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);font-size:.65rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;border:1px solid rgba(255,255,255,.2);">⭐ Featured</span>@endif
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;">
                        @if($opportunity->sector)<span style="font-size:.72rem;font-weight:600;background:{{ $sc }}30;color:#fff;padding:.2rem .625rem;border-radius:9999px;">{{ $opportunity->sector }}</span>@endif
                        @if($opportunity->stage)<span style="font-size:.72rem;color:rgba(255,255,255,.6);">{{ $opportunity->stage }}</span>@endif
                        @if($opportunity->location)<span style="font-size:.72rem;color:rgba(255,255,255,.5);">📍 {{ $opportunity->location }}</span>@endif
                    </div>
                </div>
            </div>
            {{-- Deal metrics strip --}}
            <div style="display:flex;gap:2rem;flex-wrap:wrap;">
                @if($opportunity->ask_amount)
                <div style="text-align:center;">
                    <p style="font-size:.65rem;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.08em;margin:0 0 .25rem;font-weight:600;">Raising</p>
                    <p style="font-size:1.5rem;font-weight:800;color:#fb923c;margin:0;line-height:1;">৳{{ number_format($opportunity->ask_amount) }}</p>
                </div>
                @endif
                <div style="text-align:center;">
                    <p style="font-size:.65rem;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.08em;margin:0 0 .25rem;font-weight:600;">Stage</p>
                    <p style="font-size:1rem;font-weight:700;color:#fff;margin:0;line-height:1;">{{ $opportunity->stage ?? '—' }}</p>
                </div>
                <div style="text-align:center;">
                    <p style="font-size:.65rem;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.08em;margin:0 0 .25rem;font-weight:600;">Sector</p>
                    <p style="font-size:1rem;font-weight:700;color:#fff;margin:0;line-height:1;">{{ $opportunity->sector ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tab-style nav --}}
<div style="background:#0f3080;border-bottom:1px solid rgba(255,255,255,.1);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:flex;gap:0;overflow-x:auto;">
        @foreach(['Overview','Financials','Team','Documents'] as $tab)
        <span style="padding:.875rem 1.5rem;font-size:.875rem;font-weight:600;color:{{ $loop->first?'#fff':'rgba(255,255,255,.45)' }};border-bottom:2px solid {{ $loop->first?'#fb923c':'transparent' }};white-space:nowrap;cursor:pointer;">{{ $tab }}</span>
        @endforeach
    </div>
</div>

{{-- Main Content --}}
<div style="background:#f0f4f8;min-height:100vh;padding:2rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;display:grid;grid-template-columns:1fr 280px;gap:1.5rem;align-items:start;">

        {{-- Left --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Summary banner --}}
            <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.05);display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;text-align:center;">
                @foreach([['Ask Amount','৳'.number_format($opportunity->ask_amount??0),'#f97316'],['Sector',$opportunity->sector??'—','#1a3c8f'],['Stage',$opportunity->stage??'—','#16a34a'],['Location',$opportunity->location??'—','#8b5cf6']] as $m)
                <div style="padding:.75rem;border-right:1px solid #f1f5f9;last-child:border:none;">
                    <p style="font-size:.65rem;color:#8d98a1;text-transform:uppercase;letter-spacing:.07em;font-weight:600;margin:0 0 .375rem;">{{ $m[0] }}</p>
                    <p style="font-size:1rem;font-weight:800;color:{{ $m[2] }};margin:0;line-height:1.2;">{{ $m[1] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Business Overview --}}
            @if($opportunity->business_problem || $opportunity->solution)
            <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.05);">
                <h2 style="font-size:.875rem;font-weight:700;color:#0d2b6e;text-transform:uppercase;letter-spacing:.06em;margin:0 0 1.25rem;padding-bottom:.75rem;border-bottom:2px solid #f1f5f9;">Business Overview</h2>
                @if($opportunity->business_problem)
                <div style="margin-bottom:1.25rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.625rem;">
                        <span style="width:.5rem;height:.5rem;background:#ef4444;border-radius:50%;display:inline-block;"></span>
                        <p style="font-size:.8125rem;font-weight:700;color:#374151;margin:0;text-transform:uppercase;letter-spacing:.04em;">Problem</p>
                    </div>
                    <p style="color:#374151;font-size:.9rem;line-height:1.8;margin:0;padding-left:1rem;border-left:3px solid #fecaca;">{{ $opportunity->business_problem }}</p>
                </div>
                @endif
                @if($opportunity->solution)
                <div>
                    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.625rem;">
                        <span style="width:.5rem;height:.5rem;background:#16a34a;border-radius:50%;display:inline-block;"></span>
                        <p style="font-size:.8125rem;font-weight:700;color:#374151;margin:0;text-transform:uppercase;letter-spacing:.04em;">Solution</p>
                    </div>
                    <p style="color:#374151;font-size:.9rem;line-height:1.8;margin:0;padding-left:1rem;border-left:3px solid #bbf7d0;">{{ $opportunity->solution }}</p>
                </div>
                @endif
            </div>
            @endif

            {{-- Market & Traction --}}
            @if($opportunity->target_market || $opportunity->traction)
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                @if($opportunity->target_market)
                <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.05);">
                    <h3 style="font-size:.8125rem;font-weight:700;color:#0d2b6e;text-transform:uppercase;letter-spacing:.06em;margin:0 0 .875rem;display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#1a3c8f" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        Target Market
                    </h3>
                    <p style="color:#374151;font-size:.875rem;line-height:1.75;margin:0;">{{ $opportunity->target_market }}</p>
                </div>
                @endif
                @if($opportunity->traction)
                <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.05);">
                    <h3 style="font-size:.8125rem;font-weight:700;color:#0d2b6e;text-transform:uppercase;letter-spacing:.06em;margin:0 0 .875rem;display:flex;align-items:center;gap:.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        Traction
                    </h3>
                    <p style="color:#374151;font-size:.875rem;line-height:1.75;margin:0;">{{ $opportunity->traction }}</p>
                </div>
                @endif
            </div>
            @endif

            {{-- Use of Funds --}}
            @if($opportunity->use_of_funds)
            <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.05);">
                <h3 style="font-size:.8125rem;font-weight:700;color:#0d2b6e;text-transform:uppercase;letter-spacing:.06em;margin:0 0 .875rem;display:flex;align-items:center;gap:.5rem;">
                    <svg width="14" height="14" fill="none" stroke="#8b5cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Use of Funds
                </h3>
                <p style="color:#374151;font-size:.875rem;line-height:1.75;margin:0;">{{ $opportunity->use_of_funds }}</p>
            </div>
            @endif

            {{-- Key Metrics --}}
            @if($opportunity->key_metrics)
            <div style="background:#0d2b6e;border-radius:1rem;padding:1.5rem;box-shadow:0 4px 16px rgba(13,43,110,.2);">
                <h3 style="font-size:.8125rem;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.06em;margin:0 0 1rem;">Key Metrics</h3>
                <div style="color:rgba(255,255,255,.85);font-size:.9rem;line-height:2;">{!! nl2br(e($opportunity->key_metrics)) !!}</div>
            </div>
            @endif
        </div>

        {{-- Right Sidebar --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:5rem;">

            {{-- Deal Action --}}
            <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.06);">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid #f1f5f9;">
                    <span style="font-size:.7rem;font-weight:700;color:#8d98a1;text-transform:uppercase;letter-spacing:.08em;">Deal Status</span>
                    <span style="background:#f0fdf4;color:#16a34a;font-size:.7rem;font-weight:700;padding:.2rem .625rem;border-radius:9999px;border:1px solid #bbf7d0;">● Open</span>
                </div>
                @if($opportunity->ask_amount)
                <div style="margin-bottom:1.25rem;">
                    <p style="font-size:.7rem;color:#8d98a1;margin:0 0 .25rem;font-weight:600;">Total Raise</p>
                    <p style="font-size:1.75rem;font-weight:800;color:#0d2b6e;margin:0;line-height:1;">৳{{ number_format($opportunity->ask_amount) }}</p>
                    @if($opportunity->ask_currency)<p style="font-size:.75rem;color:#8d98a1;margin:.25rem 0 0;">{{ $opportunity->ask_currency }}</p>@endif
                </div>
                @endif
                @auth
                    @if(auth()->user()->hasRole('investor'))
                    <a href="{{ route('investor.opportunities.show',$opportunity->slug) }}" style="display:block;background:#0d2b6e;color:#fff;font-weight:700;padding:.875rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;text-align:center;margin-bottom:.625rem;">Request Access →</a>
                    @else
                    <a href="{{ route('register.investor') }}" style="display:block;background:#0d2b6e;color:#fff;font-weight:700;padding:.875rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;text-align:center;margin-bottom:.625rem;">Join to Access Deal →</a>
                    @endif
                @else
                <a href="{{ route('register.investor') }}" style="display:block;background:#0d2b6e;color:#fff;font-weight:700;padding:.875rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;text-align:center;margin-bottom:.625rem;">Join as Investor →</a>
                <a href="{{ route('login') }}" style="display:block;text-align:center;color:#8d98a1;font-size:.8rem;text-decoration:none;">Already a member? Login</a>
                @endauth
            </div>

            {{-- Deal Info --}}
            <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.05);">
                <p style="font-size:.7rem;font-weight:700;color:#8d98a1;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .875rem;">Deal Information</p>
                @foreach([['Sector',$opportunity->sector],['Stage',$opportunity->stage],['Country',$opportunity->country??$opportunity->location],['Currency',$opportunity->ask_currency],['Views',number_format($opportunity->views).' views']] as $f)
                @if($f[1])
                <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid #f8fafc;font-size:.8125rem;">
                    <span style="color:#8d98a1;">{{ $f[0] }}</span>
                    <span style="font-weight:600;color:#0d2b6e;">{{ $f[1] }}</span>
                </div>
                @endif
                @endforeach
            </div>

            {{-- Disclaimer --}}
            <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:1rem;padding:1rem;">
                <p style="font-size:.72rem;color:#92400e;line-height:1.6;margin:0;">
                    <strong>Disclaimer:</strong> Investment involves risk. This is not financial advice. Please conduct your own due diligence before investing.
                </p>
            </div>
        </div>
    </div>

    {{-- Related --}}
    @if($related->count())
    <div style="max-width:80rem;margin:2rem auto 0;padding-top:2rem;border-top:1px solid #dde3ea;">
        <h2 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin-bottom:1.25rem;text-transform:uppercase;letter-spacing:.05em;">Similar Deals in {{ $opportunity->sector }}</h2>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
            @foreach($related as $r)
            @php $rc=$sectorColors[$r->sector]??'#1a3c8f'; @endphp
            <a href="{{ route('investment.show',$r->slug) }}" style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.25rem;text-decoration:none;display:flex;align-items:center;gap:.875rem;box-shadow:0 1px 4px rgba(0,0,0,.05);transition:all .2s;" onmouseover="this.style.borderColor='#bfdbfe';" onmouseout="this.style.borderColor='#dde3ea';">
                <div style="width:2.5rem;height:2.5rem;border-radius:.75rem;background:{{ $rc }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:.875rem;color:#fff;">{{ strtoupper(substr($r->title,0,2)) }}</div>
                <div style="flex:1;min-width:0;">
                    <p style="font-weight:700;color:#0d2b6e;font-size:.875rem;margin:0 0 .2rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $r->title }}</p>
                    @if($r->ask_amount)<p style="color:{{ $rc }};font-weight:700;font-size:.8125rem;margin:0;">৳{{ number_format($r->ask_amount) }}</p>@endif
                </div>
                <svg width="14" height="14" fill="none" stroke="#8d98a1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
