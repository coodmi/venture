@extends('layouts.app')
@section('title', 'VentureMatch — Connect. Invest. Grow.')
@section('meta_description', 'VentureMatch connects investors with high-potential startups and ecosystem opportunities in Bangladesh.')

@section('content')

{{-- ═══════════════════════════════════════════════════════════ HERO SLIDER --}}
@if(count($heroSlides) > 0)
<section id="vmHero" style="position:relative;width:100%;overflow:hidden;height:90vh;min-height:560px;">
    @foreach($heroSlides as $i => $slide)
    <div class="vm-slide" style="position:absolute;inset:0;transition:opacity .8s ease;opacity:{{ $i===0?1:0 }};z-index:{{ $i===0?10:0 }}">
        @if($slide['type']==='video' && !empty($slide['video_url']))
            @php preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/',$slide['video_url'],$m); $vid=$m[1]??''; @endphp
            @if($vid)<iframe src="https://www.youtube.com/embed/{{ $vid }}?autoplay=1&mute=1&loop=1&playlist={{ $vid }}&controls=0&rel=0" style="position:absolute;inset:0;width:100%;height:100%;border:0;pointer-events:none;" allow="autoplay;encrypted-media" allowfullscreen></iframe>@endif
        @elseif(!empty($slide['image']))
            <img src="{{ Storage::url($slide['image']) }}" alt="{{ $slide['title'] }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
        @else
            <div style="position:absolute;inset:0;background:linear-gradient(135deg,#0f172a,#1e3a8a,#1d4ed8)"></div>
        @endif
        <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(0,0,0,.65) 0%,rgba(0,0,0,.2) 60%,transparent 100%)"></div>
        <div style="position:absolute;bottom:0;left:0;right:0;height:120px;background:linear-gradient(to top,rgba(0,0,0,.5),transparent)"></div>
        <div style="position:relative;z-index:10;height:100%;display:flex;align-items:center;">
            <div style="max-width:80rem;margin:0 auto;padding:0 2rem;width:100%;box-sizing:border-box;">
                <div style="max-width:38rem;color:#fff;">
                    @if(!empty($slide['title']))<h1 style="font-size:clamp(2rem,5vw,3.5rem);font-weight:800;line-height:1.15;margin:0 0 1rem;letter-spacing:-.02em;">{{ $slide['title'] }}</h1>@endif
                    @if(!empty($slide['subtitle']))<p style="font-size:1.125rem;opacity:.8;margin:0 0 2rem;line-height:1.6;">{{ $slide['subtitle'] }}</p>@endif
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem;">
                        @if(!empty($slide['btn1_text']))<a href="{{ $slide['btn1_url']??'#' }}" style="background:#f59e0b;color:#fff;font-weight:700;padding:.8rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;display:inline-block;transition:all .2s;">{{ $slide['btn1_text'] }}</a>@endif
                        @if(!empty($slide['btn2_text']))<a href="{{ $slide['btn2_url']??'#' }}" style="background:rgba(255,255,255,.15);color:#fff;font-weight:600;padding:.8rem 1.75rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;border:1px solid rgba(255,255,255,.35);display:inline-block;backdrop-filter:blur(8px);">{{ $slide['btn2_text'] }}</a>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <button onclick="vmPrev()" style="position:absolute;left:1.25rem;top:50%;transform:translateY(-50%);z-index:30;width:2.75rem;height:2.75rem;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);border-radius:50%;color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;backdrop-filter:blur(8px);transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,.9)';this.style.color='#111';" onmouseout="this.style.background='rgba(255,255,255,.15)';this.style.color='#fff';">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button onclick="vmNext()" style="position:absolute;right:1.25rem;top:50%;transform:translateY(-50%);z-index:30;width:2.75rem;height:2.75rem;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);border-radius:50%;color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;backdrop-filter:blur(8px);transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,.9)';this.style.color='#111';" onmouseout="this.style.background='rgba(255,255,255,.15)';this.style.color='#fff';">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>
    <div style="position:absolute;bottom:1.5rem;left:50%;transform:translateX(-50%);z-index:30;display:flex;align-items:center;gap:.5rem;">
        @foreach($heroSlides as $i => $slide)
        <button onclick="vmSet({{ $i }})" id="vmDot{{ $i }}" style="height:.375rem;border-radius:9999px;border:none;cursor:pointer;transition:all .35s;background:rgba(255,255,255,.4);width:.375rem;padding:0;"></button>
        @endforeach
    </div>
</section>
@push('scripts')
<script>
(function(){var slides,dots,cur=0,tot={{ count($heroSlides) }},tmr;document.addEventListener('DOMContentLoaded',function(){slides=document.querySelectorAll('.vm-slide');dots=document.querySelectorAll('[id^=vmDot]');vmSet(0);if(tot>1)tmr=setInterval(function(){vmNext();},5500);});window.vmNext=function(){vmSet((cur+1)%tot);reset();};window.vmPrev=function(){vmSet((cur-1+tot)%tot);reset();};window.vmSet=function(i){if(slides){slides[cur].style.opacity='0';slides[cur].style.zIndex='0';if(dots[cur]){dots[cur].style.background='rgba(255,255,255,.4)';dots[cur].style.width='.375rem';}cur=i;slides[cur].style.opacity='1';slides[cur].style.zIndex='10';if(dots[cur]){dots[cur].style.background='#fff';dots[cur].style.width='1.5rem';}}};function reset(){clearInterval(tmr);if(tot>1)tmr=setInterval(function(){vmNext();},5500);}})();
</script>
@endpush
@else
<section style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 50%,#1d4ed8 100%);color:#fff;padding:6rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:30rem;height:30rem;background:rgba(99,102,241,.15);border-radius:50%;filter:blur(60px);"></div>
    <div style="position:absolute;bottom:-5rem;left:-5rem;width:25rem;height:25rem;background:rgba(245,158,11,.1);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8);font-size:.75rem;font-weight:600;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;">🚀 The Investment Ecosystem Platform</span>
        <h1 style="font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:36rem;">Where Investors Meet <span style="color:#fbbf24;">Tomorrow's Ventures</span></h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.65);max-width:32rem;line-height:1.7;margin:0 0 2.5rem;">VentureMatch connects investors, founders, and ecosystem stakeholders on one powerful platform — making deal discovery seamless.</p>
        <div style="display:flex;flex-wrap:wrap;gap:.875rem;">
            <a href="{{ route('register.investor') }}" style="background:#f59e0b;color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;">Join as Investor</a>
            <a href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.12);color:#fff;font-weight:600;padding:.875rem 2rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;border:1px solid rgba(255,255,255,.3);">Join as Seeker</a>
            <a href="{{ route('startups.index') }}" style="color:rgba(255,255,255,.7);font-weight:600;padding:.875rem 1.5rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;">Explore Startups →</a>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ STATS --}}
@if($stats->count())
<section style="background:#fff;border-bottom:1px solid #f1f5f9;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:2rem;text-align:center;">
        @foreach($stats as $stat)
        <div>
            <div style="font-size:2.25rem;font-weight:800;color:#1d4ed8;line-height:1;" data-counter="{{ $stat->value }}">{{ $stat->value }}</div>
            <div style="font-size:.8125rem;color:#6b7280;margin-top:.375rem;font-weight:500;">{{ $stat->label }}</div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ HOW IT WORKS --}}
<section style="background:#f8fafc;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span style="display:inline-block;background:#eff6ff;color:#1d4ed8;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.875rem;letter-spacing:.05em;text-transform:uppercase;">How It Works</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#0f172a;margin:0 0 .75rem;letter-spacing:-.02em;">Simple. Powerful. Effective.</h2>
            <p style="color:#64748b;font-size:1.0625rem;max-width:32rem;margin:0 auto;line-height:1.6;">A connected ecosystem where every stakeholder finds value.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;">
            @php $steps=[['num'=>'01','color'=>'#3b82f6','bg'=>'#eff6ff','title'=>'Discover','desc'=>'Browse curated investment opportunities filtered by sector, stage, and ticket size.','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],['num'=>'02','color'=>'#10b981','bg'=>'#ecfdf5','title'=>'Connect','desc'=>'Express interest, request meetings, and engage directly with founders and investors.','icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],['num'=>'03','color'=>'#f59e0b','bg'=>'#fffbeb','title'=>'Grow','desc'=>'Close deals, join bootcamps, attend conferences, and scale your venture together.','icon'=>'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6']]; @endphp
            @foreach($steps as $step)
            <div style="background:#fff;border-radius:1.25rem;padding:2rem;border:1px solid #e2e8f0;position:relative;overflow:hidden;">
                <div style="position:absolute;top:1.25rem;right:1.25rem;font-size:3.5rem;font-weight:900;color:{{ $step['bg'] }};line-height:1;user-select:none;">{{ $step['num'] }}</div>
                <div style="width:3rem;height:3rem;background:{{ $step['bg'] }};border-radius:.875rem;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                    <svg width="22" height="22" fill="none" stroke="{{ $step['color'] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $step['icon'] }}"/></svg>
                </div>
                <h3 style="font-size:1.125rem;font-weight:700;color:#0f172a;margin:0 0 .5rem;">{{ $step['title'] }}</h3>
                <p style="font-size:.875rem;color:#64748b;line-height:1.6;margin:0;">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════ HOT DEALS --}}
@if($hotDeals->count())
<section style="background:#fff;padding:4rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-flex;align-items:center;gap:.375rem;background:#fef2f2;color:#dc2626;font-size:.75rem;font-weight:700;padding:.3rem .75rem;border-radius:9999px;margin-bottom:.5rem;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="#dc2626"><path d="M12 2c0 0-4 4-4 9a4 4 0 008 0c0-5-4-9-4-9z"/></svg> Hot Deals
                </span>
                <h2 style="font-size:2rem;font-weight:800;color:#0f172a;margin:0;letter-spacing:-.02em;">Active Investment Opportunities</h2>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <button onclick="slideScroll('hotDealsTrack',-1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideScroll('hotDealsTrack',1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <a href="{{ route('startups.index') }}" style="color:#1d4ed8;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;">View all →</a>
            </div>
        </div>
        <div id="hotDealsTrack" style="display:flex;gap:1.25rem;overflow-x:auto;scroll-behavior:smooth;padding-bottom:1rem;scrollbar-width:none;-ms-overflow-style:none;" class="hide-scroll">
            @foreach($hotDeals as $deal)
            <a href="{{ route('startups.show', $deal->slug) }}" style="text-decoration:none;flex-shrink:0;width:280px;display:block;background:#fff;border:1px solid #e2e8f0;border-radius:1.25rem;padding:1.5rem;transition:all .25s;position:relative;overflow:hidden;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.1)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,#ef4444,#f97316);"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.875rem;">
                    <span style="background:#fef2f2;color:#dc2626;font-size:.7rem;font-weight:700;padding:.25rem .625rem;border-radius:9999px;">🔥 Hot Deal</span>
                    <span style="font-size:.75rem;color:#94a3b8;font-weight:500;">{{ $deal->sector }}</span>
                </div>
                <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0 0 .5rem;line-height:1.4;">{{ $deal->title }}</h3>
                <p style="font-size:.8125rem;color:#64748b;margin:0 0 1.25rem;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $deal->solution }}</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.875rem;border-top:1px solid #f1f5f9;">
                    <span style="font-size:1rem;font-weight:800;color:#1d4ed8;">৳{{ number_format($deal->ask_amount) }}</span>
                    <span style="font-size:.75rem;color:#1d4ed8;font-weight:600;">View Details →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ TOP STARTUPS --}}
@if($topStartups->count())
<section style="background:#f8fafc;padding:4rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-block;background:#eff6ff;color:#1d4ed8;font-size:.75rem;font-weight:700;padding:.3rem .75rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;">⭐ Featured</span>
                <h2 style="font-size:2rem;font-weight:800;color:#0f172a;margin:0;letter-spacing:-.02em;">Top Startups</h2>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <button onclick="slideScroll('startupTrack',-1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideScroll('startupTrack',1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <a href="{{ route('startups.index') }}" style="color:#1d4ed8;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;">View all →</a>
            </div>
        </div>
    </div>
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div id="startupTrack" style="display:flex;gap:1.25rem;overflow-x:auto;scroll-behavior:smooth;padding-bottom:1rem;scrollbar-width:none;-ms-overflow-style:none;" class="hide-scroll">
            @php $sectorColors=['FinTech'=>'#3b82f6','AgriTech'=>'#10b981','HealthTech'=>'#ef4444','EdTech'=>'#f59e0b','CleanTech'=>'#8b5cf6']; @endphp
            @foreach($topStartups as $s)
            @php $sc = $sectorColors[$s->sector] ?? '#1d4ed8'; @endphp
            <a href="{{ route('startups.show', $s->slug) }}" style="text-decoration:none;background:#fff;border:1px solid #e2e8f0;border-radius:1.25rem;padding:1.5rem;display:flex;flex-direction:column;flex-shrink:0;width:280px;transition:all .25s;overflow:hidden;position:relative;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.1)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $sc }};"></div>
                <div style="display:flex;align-items:flex-start;gap:.75rem;margin-bottom:.875rem;">
                    <div style="width:2.5rem;height:2.5rem;border-radius:.75rem;background:{{ $sc }}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:.875rem;color:{{ $sc }};">{{ strtoupper(substr($s->title,0,2)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <h3 style="font-size:.9375rem;font-weight:700;color:#0f172a;margin:0 0 .25rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $s->title }}</h3>
                        <div style="display:flex;gap:.3rem;flex-wrap:wrap;">
                            @if($s->sector)<span style="font-size:.65rem;font-weight:600;padding:.15rem .45rem;border-radius:9999px;background:{{ $sc }}18;color:{{ $sc }};">{{ $s->sector }}</span>@endif
                            @if($s->stage)<span style="font-size:.65rem;background:#f1f5f9;color:#475569;padding:.15rem .45rem;border-radius:9999px;">{{ $s->stage }}</span>@endif
                            @if($s->is_hot_deal)<span style="font-size:.65rem;background:#fef2f2;color:#dc2626;font-weight:700;padding:.15rem .45rem;border-radius:9999px;">🔥</span>@endif
                        </div>
                    </div>
                </div>
                <p style="font-size:.8rem;color:#64748b;line-height:1.55;flex:1;margin:0 0 1rem;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $s->business_problem }}</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid #f1f5f9;">
                    @if($s->ask_amount)<span style="font-size:.9375rem;font-weight:800;color:#1d4ed8;">৳{{ number_format($s->ask_amount) }}</span>@else<span></span>@endif
                    <span style="font-size:.75rem;color:#1d4ed8;font-weight:600;">Invest →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ TOP INVESTORS --}}
@if($topInvestors->count())
<section style="background:#fff;padding:4rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-block;background:#f0fdf4;color:#16a34a;font-size:.75rem;font-weight:700;padding:.3rem .75rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;">✓ Verified</span>
                <h2 style="font-size:2rem;font-weight:800;color:#0f172a;margin:0;letter-spacing:-.02em;">Top Investors</h2>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <button onclick="slideScroll('investorTrack',-1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideScroll('investorTrack',1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <a href="{{ route('investors.index') }}" style="color:#1d4ed8;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;">View all →</a>
            </div>
        </div>
    </div>
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div id="investorTrack" style="display:flex;gap:1.25rem;overflow-x:auto;scroll-behavior:smooth;padding-bottom:1rem;scrollbar-width:none;-ms-overflow-style:none;">
            @php $invColors=['angel'=>'#f59e0b','vc'=>'#3b82f6','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#10b981']; $invLabels=['angel'=>'Angel','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact']; $invBadge=['angel'=>'background:#fef3c7;color:#92400e;','vc'=>'background:#dbeafe;color:#1e40af;','corporate'=>'background:#e0e7ff;color:#3730a3;','family_office'=>'background:#f3e8ff;color:#6b21a8;','impact'=>'background:#d1fae5;color:#065f46;']; @endphp
            @foreach($topInvestors as $inv)
            @php $ic = $invColors[$inv->investor_type] ?? '#1d4ed8'; @endphp
            <a href="{{ route('investors.show', $inv->id) }}" style="text-decoration:none;background:#fff;border:1px solid #e2e8f0;border-radius:1.25rem;padding:1.5rem;display:flex;flex-direction:column;flex-shrink:0;width:270px;transition:all .25s;overflow:hidden;position:relative;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.1)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $ic }};"></div>
                <div style="display:flex;align-items:flex-start;gap:.75rem;margin-bottom:.875rem;">
                    <div style="width:2.75rem;height:2.75rem;border-radius:.75rem;background:{{ $ic }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;font-size:.9375rem;color:#fff;">{{ strtoupper(substr($inv->user->name??'IN',0,2)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:.3rem;">
                            <span style="font-size:.9rem;font-weight:700;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;">{{ $inv->user->name }}</span>
                            @if($inv->verification_status==='verified')<svg width="13" height="13" viewBox="0 0 20 20" fill="#3b82f6"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>@endif
                        </div>
                        <p style="font-size:.72rem;color:#64748b;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->designation }}</p>
                        <p style="font-size:.68rem;color:#94a3b8;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->organization }}</p>
                    </div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.75rem;">
                    <span style="font-size:.68rem;font-weight:600;padding:.2rem .55rem;border-radius:9999px;{{ $invBadge[$inv->investor_type]??'background:#f1f5f9;color:#475569;' }}">{{ $invLabels[$inv->investor_type]??$inv->investor_type }}</span>
                    @if($inv->sector_preferences)
                        @foreach(array_slice($inv->sector_preferences,0,2) as $sec)
                        <span style="font-size:.68rem;background:#eff6ff;color:#1d4ed8;padding:.2rem .5rem;border-radius:9999px;">{{ $sec }}</span>
                        @endforeach
                    @endif
                </div>
                @if($inv->bio)<p style="font-size:.78rem;color:#64748b;line-height:1.5;margin:0 0 .75rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $inv->bio }}</p>@endif
                @if($inv->ticket_size_min && $inv->ticket_size_max)
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid #f1f5f9;margin-top:auto;">
                    <span style="font-size:.68rem;color:#94a3b8;">Ticket</span>
                    <span style="font-size:.78rem;font-weight:700;color:#1d4ed8;">৳{{ number_format($inv->ticket_size_min/100000,0) }}L–৳{{ number_format($inv->ticket_size_max/100000,0) }}L</span>
                </div>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
function slideScroll(id, dir) {
    var el = document.getElementById(id);
    if(el) el.scrollBy({ left: dir * 310, behavior: 'smooth' });
}
</script>
<style>.hide-scroll::-webkit-scrollbar{display:none;}</style>
@endpush

{{-- ═══════════════════════════════════════════════════════════ EVENTS --}}
@if($events->count())
<section style="background:#f8fafc;padding:4rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-block;background:#ecfdf5;color:#059669;font-size:.75rem;font-weight:700;padding:.3rem .75rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;">Upcoming</span>
                <h2 style="font-size:2rem;font-weight:800;color:#0f172a;margin:0;letter-spacing:-.02em;">Events & Conferences</h2>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <button onclick="slideScroll('eventsTrack',-1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideScroll('eventsTrack',1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <a href="{{ route('events.index') }}" style="color:#1d4ed8;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;">View all →</a>
            </div>
        </div>
        <div id="eventsTrack" style="display:flex;gap:1.25rem;overflow-x:auto;scroll-behavior:smooth;padding-bottom:1rem;scrollbar-width:none;-ms-overflow-style:none;" class="hide-scroll">
            @php $gradients=['linear-gradient(135deg,#1d4ed8,#3b82f6)','linear-gradient(135deg,#7c3aed,#a78bfa)','linear-gradient(135deg,#059669,#34d399)','linear-gradient(135deg,#dc2626,#f97316)','linear-gradient(135deg,#d97706,#fbbf24)','linear-gradient(135deg,#0891b2,#22d3ee)']; @endphp
            @foreach($events as $event)
            <a href="{{ route('events.show', $event->slug) }}" style="text-decoration:none;flex-shrink:0;width:260px;background:#fff;border-radius:1.25rem;overflow:hidden;border:1px solid #e2e8f0;display:flex;flex-direction:column;transition:all .25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.1)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';">
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" style="width:100%;height:9rem;object-fit:cover;display:block;">
                @else
                    <div style="width:100%;height:9rem;background:{{ $gradients[$loop->index % 6] }};display:flex;align-items:center;justify-content:center;">
                        <svg width="36" height="36" fill="none" stroke="rgba(255,255,255,.6)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                <div style="padding:1rem;flex:1;display:flex;flex-direction:column;">
                    <span style="font-size:.7rem;color:#1d4ed8;font-weight:600;margin-bottom:.25rem;display:block;">{{ $event->start_date->format('M d, Y') }}</span>
                    <h3 style="font-size:.9375rem;font-weight:700;color:#0f172a;margin:0 0 .5rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $event->title }}</h3>
                    <p style="font-size:.75rem;color:#94a3b8;margin:0;">📍 {{ $event->venue ?? 'Online' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ TESTIMONIALS --}}
@if($testimonials->count())
<section style="background:linear-gradient(135deg,#0f172a,#1e3a8a);padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span style="display:inline-block;background:rgba(255,255,255,.1);color:rgba(255,255,255,.7);font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:.875rem;text-transform:uppercase;letter-spacing:.05em;">Testimonials</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#fff;margin:0 0 .75rem;letter-spacing:-.02em;">What Our Members Say</h2>
            <p style="color:rgba(255,255,255,.5);font-size:1rem;max-width:28rem;margin:0 auto;">Real stories from investors, founders, and partners.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
            @foreach($testimonials as $t)
            <div style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:1.25rem;padding:1.75rem;">
                <div style="display:flex;gap:.25rem;margin-bottom:1rem;">
                    @for($i=0;$i<($t->rating??5);$i++)<span style="color:#fbbf24;font-size:.875rem;">★</span>@endfor
                </div>
                <p style="color:rgba(255,255,255,.7);font-size:.875rem;line-height:1.7;margin:0 0 1.5rem;">"{{ $t->content }}"</p>
                <div style="display:flex;align-items:center;gap:.75rem;">
                    @if($t->photo)
                        <img src="{{ Storage::url($t->photo) }}" alt="{{ $t->name }}" style="width:2.5rem;height:2.5rem;border-radius:50%;object-fit:cover;">
                    @else
                        <div style="width:2.5rem;height:2.5rem;background:rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.875rem;">{{ substr($t->name,0,1) }}</div>
                    @endif
                    <div>
                        <p style="font-weight:700;color:#fff;font-size:.875rem;margin:0;">{{ $t->name }}</p>
                        <p style="color:rgba(255,255,255,.45);font-size:.75rem;margin:0;">{{ $t->designation }}{{ $t->organization?', '.$t->organization:'' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ LATEST NEWS --}}
@if($latestNews->count())
<section style="background:#fff;padding:4rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="display:inline-block;background:#f0f9ff;color:#0369a1;font-size:.75rem;font-weight:700;padding:.3rem .75rem;border-radius:9999px;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;">📰 Latest</span>
                <h2 style="font-size:2rem;font-weight:800;color:#0f172a;margin:0;letter-spacing:-.02em;">News & Insights</h2>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <button onclick="slideScroll('newsTrack',-1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideScroll('newsTrack',1)" style="width:2.5rem;height:2.5rem;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,.08);">
                    <svg width="16" height="16" fill="none" stroke="#374151" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <a href="{{ route('news.index') }}" style="color:#1d4ed8;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;">View all →</a>
            </div>
        </div>
        <div id="newsTrack" style="display:flex;gap:1.25rem;overflow-x:auto;scroll-behavior:smooth;padding-bottom:1rem;scrollbar-width:none;-ms-overflow-style:none;" class="hide-scroll">
            @foreach($latestNews as $article)
            <a href="{{ route('news.show', $article->slug) }}" style="text-decoration:none;flex-shrink:0;width:300px;display:flex;flex-direction:column;background:#fff;border:1px solid #e2e8f0;border-radius:1.25rem;overflow:hidden;transition:all .25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.1)';this.style.transform='translateY(-3px)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';">
                @if($article->cover_image)
                    <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" style="width:100%;height:10rem;object-fit:cover;display:block;">
                @else
                    @php $newsGrads=['Deal News'=>'linear-gradient(135deg,#1d4ed8,#3b82f6)','Market Insights'=>'linear-gradient(135deg,#7c3aed,#a78bfa)','Platform Update'=>'linear-gradient(135deg,#059669,#34d399)','Press Release'=>'linear-gradient(135deg,#374151,#6b7280)','Founder Resources'=>'linear-gradient(135deg,#d97706,#fbbf24)','Event Recap'=>'linear-gradient(135deg,#dc2626,#f97316)','Startup Spotlight'=>'linear-gradient(135deg,#0891b2,#22d3ee)']; @endphp
                    <div style="width:100%;height:10rem;background:{{ $newsGrads[$article->category] ?? 'linear-gradient(135deg,#1d4ed8,#3b82f6)' }};display:flex;align-items:center;justify-content:center;">
                        <svg width="40" height="40" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                @endif
                <div style="padding:1.125rem;flex:1;display:flex;flex-direction:column;">
                    <span style="font-size:.68rem;color:#1d4ed8;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">{{ $article->category }}</span>
                    <h3 style="font-size:.9375rem;font-weight:700;color:#0f172a;margin:.3rem 0 .5rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $article->title }}</h3>
                    <p style="font-size:.78rem;color:#64748b;line-height:1.5;margin:0 0 .75rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $article->summary }}</p>
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.625rem;border-top:1px solid #f1f5f9;">
                        <span style="font-size:.72rem;color:#94a3b8;">{{ $article->published_at?->format('M d, Y') }}</span>
                        <span style="font-size:.72rem;color:#1d4ed8;font-weight:600;">Read →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════ CTA --}}
<section style="background:linear-gradient(135deg,#1d4ed8,#7c3aed);padding:5rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(255,255,255,.05);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-4rem;left:-4rem;width:16rem;height:16rem;background:rgba(255,255,255,.05);border-radius:50%;"></div>
    <div style="max-width:48rem;margin:0 auto;position:relative;">
        <h2 style="font-size:2.5rem;font-weight:800;color:#fff;margin:0 0 1rem;letter-spacing:-.02em;">Ready to Join the Ecosystem?</h2>
        <p style="color:rgba(255,255,255,.65);font-size:1.125rem;margin:0 0 2.5rem;line-height:1.6;">Whether you're an investor seeking the next big opportunity or a founder raising capital — VentureMatch is your platform.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;">
            <a href="{{ route('register.investor') }}" style="background:#fff;color:#1d4ed8;font-weight:700;padding:.875rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Join as Investor</a>
            <a href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.15);color:#fff;font-weight:600;padding:.875rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;border:1px solid rgba(255,255,255,.3);display:inline-block;">Submit Your Startup</a>
        </div>
    </div>
</section>

@endsection
