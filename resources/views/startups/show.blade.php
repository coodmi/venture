@extends('layouts.app')
@section('title', $opportunity->title)

@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);color:#f0e6c8;padding:3rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <a href="{{ route('startups.index') }}" style="color:rgba(212,146,15,.6);font-size:.875rem;text-decoration:none;margin-bottom:1rem;display:inline-block;">← Back to Startups</a>
        <div style="display:flex;flex-wrap:wrap;align-items:flex-start;gap:1.5rem;">
            <div style="width:4rem;height:4rem;background:rgba(212,146,15,.12);border-radius:1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(212,146,15,.2);">
                <span style="color:#d4920f;font-weight:700;font-size:1.25rem;">{{ strtoupper(substr($opportunity->title,0,2)) }}</span>
            </div>
            <div style="flex:1;">
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:.5rem;">
                    @if($opportunity->sector)<span style="font-size:.75rem;background:rgba(212,146,15,.12);color:#d4920f;padding:.25rem .625rem;border-radius:9999px;border:1px solid rgba(212,146,15,.25);">{{ $opportunity->sector }}</span>@endif
                    @if($opportunity->stage)<span style="font-size:.75rem;background:rgba(240,230,200,.08);color:#9a8a6a;padding:.25rem .625rem;border-radius:9999px;border:1px solid rgba(240,230,200,.1);">{{ $opportunity->stage }}</span>@endif
                    @if($opportunity->is_featured)<span style="font-size:.75rem;background:rgba(212,146,15,.2);color:#d4920f;padding:.25rem .625rem;border-radius:9999px;">⭐ Featured</span>@endif
                    @if($opportunity->is_hot_deal)<span style="font-size:.75rem;background:rgba(239,68,68,.15);color:#f87171;padding:.25rem .625rem;border-radius:9999px;">🔥 Hot Deal</span>@endif
                </div>
                <h1 style="font-size:1.875rem;font-weight:800;margin-bottom:.5rem;color:#f0e6c8;">{{ $opportunity->title }}</h1>
                @if($opportunity->location)<p style="color:#9a8a6a;font-size:.875rem;">📍 {{ $opportunity->location }}</p>@endif
            </div>
            @if($opportunity->ask_amount)
            <div style="background:rgba(212,146,15,.08);border-radius:1.25rem;padding:1.25rem;text-align:center;border:1px solid rgba(212,146,15,.2);min-width:10rem;">
                <p style="color:#7a6a4a;font-size:.75rem;margin-bottom:.25rem;">Investment Ask</p>
                <p style="font-size:1.875rem;font-weight:800;color:#d4920f;">৳{{ number_format($opportunity->ask_amount) }}</p>
                @if($opportunity->ask_currency)<p style="color:#7a6a4a;font-size:.75rem;">{{ $opportunity->ask_currency }}</p>@endif
            </div>
            @endif
        </div>
    </div>
</section>

<section style="padding:3rem 0;background:#0d0a04;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:grid;grid-template-columns:1fr 320px;gap:2rem;align-items:start;">

            {{-- Main Content --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">
                @foreach([
                    ['label'=>'The Problem','content'=>$opportunity->business_problem],
                    ['label'=>'Our Solution','content'=>$opportunity->solution],
                    ['label'=>'Target Market','content'=>$opportunity->target_market],
                    ['label'=>'Traction','content'=>$opportunity->traction],
                    ['label'=>'Use of Funds','content'=>$opportunity->use_of_funds],
                ] as $section)
                @if(!empty($section['content']))
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.5rem;">
                    <h2 style="font-weight:700;color:#f0e6c8;font-size:1.125rem;margin-bottom:.75rem;">{{ $section['label'] }}</h2>
                    <div style="color:#9a8a6a;font-size:.875rem;line-height:1.75;">{!! nl2br(e($section['content'])) !!}</div>
                </div>
                @endif
                @endforeach
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:6rem;">
                {{-- Invest CTA --}}
                <div style="background:linear-gradient(135deg,#1a1408,#241c0a);border-radius:1.25rem;padding:1.5rem;text-align:center;border:1px solid rgba(212,146,15,.25);">
                    <p style="font-weight:700;font-size:1.125rem;color:#f0e6c8;margin-bottom:.25rem;">Interested in investing?</p>
                    <p style="color:#7a6a4a;font-size:.875rem;margin-bottom:1rem;">Connect with the founder and explore this opportunity.</p>
                    @auth
                        @if(auth()->user()->hasRole('investor'))
                            <a href="{{ route('investor.opportunities.show', $opportunity->slug) }}"
                               style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">
                                Express Interest
                            </a>
                        @else
                            <a href="{{ route('register.investor') }}"
                               style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">
                                Join as Investor
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register.investor') }}"
                           style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;margin-bottom:.5rem;">
                            Join as Investor
                        </a>
                        <a href="{{ route('login') }}" style="color:#7a6a4a;font-size:.875rem;text-decoration:none;">Already have an account? Login</a>
                    @endauth
                </div>

                {{-- Key Metrics --}}
                @if($opportunity->key_metrics)
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.5rem;">
                    <h3 style="font-weight:700;color:#f0e6c8;margin-bottom:.75rem;">Key Metrics</h3>
                    <div style="font-size:.875rem;color:#9a8a6a;line-height:1.75;">{!! nl2br(e($opportunity->key_metrics)) !!}</div>
                </div>
                @endif

                {{-- Stats --}}
                <div style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.5rem;">
                    <h3 style="font-weight:700;color:#f0e6c8;margin-bottom:.75rem;">Details</h3>
                    <div style="display:flex;flex-direction:column;gap:.75rem;">
                        @if($opportunity->sector)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Sector</span><span style="font-weight:500;color:#f0e6c8;">{{ $opportunity->sector }}</span></div>
                        @endif
                        @if($opportunity->stage)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Stage</span><span style="font-weight:500;color:#f0e6c8;">{{ $opportunity->stage }}</span></div>
                        @endif
                        @if($opportunity->country)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Country</span><span style="font-weight:500;color:#f0e6c8;">{{ $opportunity->country }}</span></div>
                        @endif
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#7a6a4a;">Views</span><span style="font-weight:500;color:#f0e6c8;">{{ number_format($opportunity->views) }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related --}}
        @if($related->count())
        <div style="margin-top:3rem;padding-top:3rem;border-top:1px solid rgba(212,146,15,.1);">
            <h2 style="font-size:1.25rem;font-weight:700;color:#f0e6c8;margin-bottom:1.25rem;">More in {{ $opportunity->sector }}</h2>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
                @foreach($related as $r)
                <a href="{{ route('startups.show', $r->slug) }}" style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);padding:1.25rem;text-decoration:none;display:block;">
                    <h3 style="font-weight:600;color:#f0e6c8;margin-bottom:.25rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $r->title }}</h3>
                    <p style="font-size:.75rem;color:#7a6a4a;">{{ $r->stage }} · {{ $r->location }}</p>
                    @if($r->ask_amount)<p style="color:#d4920f;font-weight:700;font-size:.875rem;margin-top:.5rem;">৳{{ number_format($r->ask_amount) }}</p>@endif
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
