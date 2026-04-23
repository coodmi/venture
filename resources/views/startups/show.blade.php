@extends('layouts.app')
@section('title', $opportunity->title)

@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:3rem 0;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <a href="{{ route('startups.index') }}" style="color:rgba(255,255,255,.7);font-size:.875rem;text-decoration:none;margin-bottom:1rem;display:inline-block;">← Back to Startups</a>
        <div style="display:flex;flex-wrap:wrap;align-items:flex-start;gap:1.5rem;">
            <div style="width:4rem;height:4rem;background:rgba(255,255,255,.15);border-radius:1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(255,255,255,.25);">
                <span style="color:#fff;font-weight:700;font-size:1.25rem;">{{ strtoupper(substr($opportunity->title,0,2)) }}</span>
            </div>
            <div style="flex:1;">
                <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:.5rem;">
                    @if($opportunity->sector)<span style="font-size:.75rem;background:rgba(255,255,255,.15);color:#fff;padding:.25rem .625rem;border-radius:9999px;border:1px solid rgba(255,255,255,.25);">{{ $opportunity->sector }}</span>@endif
                    @if($opportunity->stage)<span style="font-size:.75rem;background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);padding:.25rem .625rem;border-radius:9999px;">{{ $opportunity->stage }}</span>@endif
                    @if($opportunity->is_featured)<span style="font-size:.75rem;background:rgba(249,115,22,.25);color:#fed7aa;padding:.25rem .625rem;border-radius:9999px;">⭐ Featured</span>@endif
                    @if($opportunity->is_hot_deal)<span style="font-size:.75rem;background:rgba(239,68,68,.2);color:#fca5a5;padding:.25rem .625rem;border-radius:9999px;">🔥 Hot Deal</span>@endif
                </div>
                <h1 style="font-size:1.875rem;font-weight:800;margin-bottom:.5rem;color:#fff;">{{ $opportunity->title }}</h1>
                @if($opportunity->location)<p style="color:rgba(255,255,255,.7);font-size:.875rem;">📍 {{ $opportunity->location }}</p>@endif
            </div>
            @if($opportunity->ask_amount)
            <div style="background:rgba(255,255,255,.12);border-radius:1.25rem;padding:1.25rem;text-align:center;border:1px solid rgba(255,255,255,.2);min-width:10rem;">
                <p style="color:rgba(255,255,255,.7);font-size:.75rem;margin-bottom:.25rem;">Investment Ask</p>
                <p style="font-size:1.875rem;font-weight:800;color:#fb923c;">৳{{ number_format($opportunity->ask_amount) }}</p>
                @if($opportunity->ask_currency)<p style="color:rgba(255,255,255,.6);font-size:.75rem;">{{ $opportunity->ask_currency }}</p>@endif
            </div>
            @endif
        </div>
    </div>
</section>

<section style="padding:3rem 0;background:#f4f7fb;">
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
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h2 style="font-weight:700;color:#0d2b6e;font-size:1.125rem;margin-bottom:.75rem;">{{ $section['label'] }}</h2>
                    <div style="color:#8d98a1;font-size:.875rem;line-height:1.75;">{!! nl2br(e($section['content'])) !!}</div>
                </div>
                @endif
                @endforeach
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;position:sticky;top:6rem;">
                {{-- Invest CTA --}}
                <div style="background:linear-gradient(135deg,#0d2b6e,#1a3c8f);border-radius:1.25rem;padding:1.5rem;text-align:center;border:1px solid #bfdbfe;box-shadow:0 4px 16px rgba(26,60,143,.15);">
                    <p style="font-weight:700;font-size:1.125rem;color:#fff;margin-bottom:.25rem;">Interested in investing?</p>
                    <p style="color:rgba(255,255,255,.7);font-size:.875rem;margin-bottom:1rem;">Connect with the founder and explore this opportunity.</p>
                    @auth
                        @if(auth()->user()->hasRole('investor'))
                            <a href="{{ route('investor.opportunities.show', $opportunity->slug) }}"
                               style="display:block;background:#f97316;color:#fff;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">
                                Express Interest
                            </a>
                        @else
                            <a href="{{ route('register.investor') }}"
                               style="display:block;background:#f97316;color:#fff;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;">
                                Join as Investor
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register.investor') }}"
                           style="display:block;background:#f97316;color:#fff;font-weight:700;padding:.625rem;border-radius:.75rem;text-decoration:none;font-size:.875rem;margin-bottom:.5rem;">
                            Join as Investor
                        </a>
                        <a href="{{ route('login') }}" style="color:rgba(255,255,255,.6);font-size:.875rem;text-decoration:none;">Already have an account? Login</a>
                    @endauth
                </div>

                {{-- Key Metrics --}}
                @if($opportunity->key_metrics)
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h3 style="font-weight:700;color:#0d2b6e;margin-bottom:.75rem;">Key Metrics</h3>
                    <div style="font-size:.875rem;color:#8d98a1;line-height:1.75;">{!! nl2br(e($opportunity->key_metrics)) !!}</div>
                </div>
                @endif

                {{-- Details --}}
                <div style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                    <h3 style="font-weight:700;color:#0d2b6e;margin-bottom:.75rem;">Details</h3>
                    <div style="display:flex;flex-direction:column;gap:.75rem;">
                        @if($opportunity->sector)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#8d98a1;">Sector</span><span style="font-weight:500;color:#0d2b6e;">{{ $opportunity->sector }}</span></div>
                        @endif
                        @if($opportunity->stage)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#8d98a1;">Stage</span><span style="font-weight:500;color:#0d2b6e;">{{ $opportunity->stage }}</span></div>
                        @endif
                        @if($opportunity->country)
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#8d98a1;">Country</span><span style="font-weight:500;color:#0d2b6e;">{{ $opportunity->country }}</span></div>
                        @endif
                        <div style="display:flex;justify-content:space-between;font-size:.875rem;"><span style="color:#8d98a1;">Views</span><span style="font-weight:500;color:#0d2b6e;">{{ number_format($opportunity->views) }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related --}}
        @if($related->count())
        <div style="margin-top:3rem;padding-top:3rem;border-top:1px solid #dde3ea;">
            <h2 style="font-size:1.25rem;font-weight:700;color:#0d2b6e;margin-bottom:1.25rem;">More in {{ $opportunity->sector }}</h2>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
                @foreach($related as $r)
                <a href="{{ route('startups.show', $r->slug) }}" style="background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;padding:1.25rem;text-decoration:none;display:block;box-shadow:0 2px 8px rgba(0,0,0,.04);transition:all .2s;" onmouseover="this.style.borderColor='#bfdbfe';" onmouseout="this.style.borderColor='#dde3ea';">
                    <h3 style="font-weight:600;color:#0d2b6e;margin-bottom:.25rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $r->title }}</h3>
                    <p style="font-size:.75rem;color:#8d98a1;">{{ $r->stage }} · {{ $r->location }}</p>
                    @if($r->ask_amount)<p style="color:#1a3c8f;font-weight:700;font-size:.875rem;margin-top:.5rem;">৳{{ number_format($r->ask_amount) }}</p>@endif
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
