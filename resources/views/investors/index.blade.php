@extends('layouts.app')
@section('title', 'Our Investors')

@section('content')
@php
    $typeColor=['angel'=>'#f97316','vc'=>'#1a3c8f','corporate'=>'#6366f1','family_office'=>'#a855f7','impact'=>'#16a34a'];
    $typeBg=['angel'=>'background:#fff7ed;color:#f97316;','vc'=>'background:#eff6ff;color:#1a3c8f;','corporate'=>'background:#eef2ff;color:#4f46e5;','family_office'=>'background:#faf5ff;color:#7c3aed;','impact'=>'background:#f0fdf4;color:#16a34a;'];
    $stageLabel=['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $typeLabel=['angel'=>'Angel','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact'];
@endphp

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);color:#fff;padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:28rem;height:28rem;background:rgba(249,115,22,.15);border-radius:50%;filter:blur(70px);"></div>
    <div style="position:absolute;bottom:-5rem;left:-5rem;width:20rem;height:20rem;background:rgba(255,255,255,.05);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-block;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.4);color:#fed7aa;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1.5rem;text-transform:uppercase;letter-spacing:.08em;">✓ Verified Community</span>
        <h1 style="font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;letter-spacing:-.03em;max-width:40rem;">
            Meet the Investors <span style="color:#fb923c;">Backing Tomorrow</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(255,255,255,.8);max-width:36rem;line-height:1.7;margin:0 0 2.5rem;">
            Connect with {{ $total }}+ verified investors — angels, VCs, corporates, and impact funds — actively seeking opportunities.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:2rem;margin-bottom:2.5rem;">
            @foreach($counts as $key => $count)
            @if($count > 0)
            @php $col = $typeColor[$key] ?? '#1a3c8f'; @endphp
            <div>
                <p style="font-size:1.75rem;font-weight:800;color:#fff;margin:0;line-height:1;">{{ $count }}</p>
                <p style="font-size:.75rem;color:rgba(255,255,255,.65);margin:.2rem 0 0;">{{ $typeLabel[$key] ?? $key }}</p>
            </div>
            @endif
            @endforeach
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:.875rem;">
            <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;">Join as Investor</a>
            <a href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.15);color:#fff;font-weight:600;padding:.875rem 2rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;border:1px solid rgba(255,255,255,.3);">Submit Your Startup</a>
        </div>
    </div>
</section>

{{-- Type Filter Bar --}}
<div style="background:#fff;border-bottom:1px solid #dde3ea;overflow-x:auto;">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;display:flex;">
        <a href="{{ route('investors.index') }}"
           style="padding:1rem 1.5rem;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;border-bottom:3px solid {{ !request('type')?'#1a3c8f':'transparent' }};color:{{ !request('type')?'#1a3c8f':'#8d98a1' }};transition:all .2s;">
            All ({{ $total }})
        </a>
        @foreach($types as $key => $label)
        @php $col = $typeColor[$key] ?? '#1a3c8f'; @endphp
        <a href="{{ route('investors.index', ['type'=>$key]) }}"
           style="padding:1rem 1.5rem;font-size:.875rem;font-weight:600;text-decoration:none;white-space:nowrap;border-bottom:3px solid {{ request('type')===$key?$col:'transparent' }};color:{{ request('type')===$key?$col:'#8d98a1' }};transition:all .2s;">
            {{ $typeLabel[$key] }} ({{ $counts[$key] ?? 0 }})
        </a>
        @endforeach
    </div>
</div>

{{-- Content --}}
<section style="background:#f4f7fb;padding:3rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">

        {{-- Filters --}}
        <form method="GET" style="background:#fff;border:1px solid #dde3ea;border-radius:1rem;padding:1.25rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:.875rem;align-items:flex-end;box-shadow:0 2px 8px rgba(0,0,0,.04);">
            @if(request('type'))<input type="hidden" name="type" value="{{ request('type') }}">@endif
            <div style="flex:1;min-width:200px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or organization..."
                    style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;box-sizing:border-box;">
            </div>
            <div style="min-width:150px;">
                <label style="display:block;font-size:.7rem;font-weight:600;color:#8d98a1;margin-bottom:.375rem;text-transform:uppercase;letter-spacing:.05em;">Stage</label>
                <select name="stage" style="width:100%;background:#f4f7fb;border:1px solid #dde3ea;color:#374151;font-size:.875rem;border-radius:.5rem;padding:.5rem .875rem;outline:none;cursor:pointer;">
                    <option value="">All Stages</option>
                    @foreach($stages as $k=>$v)
                    <option value="{{ $k }}" {{ request('stage')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:#1a3c8f;color:#fff;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;">Filter</button>
            @if(request()->hasAny(['search','type','stage']))
            <a href="{{ route('investors.index') }}" style="font-size:.875rem;color:#8d98a1;text-decoration:none;padding:.5rem 0;">✕ Clear</a>
            @endif
        </form>

        <p style="font-size:.875rem;color:#8d98a1;margin-bottom:1.5rem;">{{ $investors->total() }} investor{{ $investors->total()!=1?'s':'' }} found</p>

        @if($investors->isEmpty())
        <div style="text-align:center;padding:5rem 0;background:#fff;border-radius:1.25rem;border:1px solid #dde3ea;">
            <svg width="64" height="64" fill="none" stroke="#bfdbfe" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p style="font-size:1.125rem;font-weight:600;color:#0d2b6e;margin:0 0 .5rem;">No investors found</p>
            <p style="color:#8d98a1;font-size:.875rem;">Try adjusting your filters or check back later.</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
            @foreach($investors as $inv)
            @php
                $ic = $typeColor[$inv->investor_type] ?? '#1a3c8f';
                $name = $inv->user_name ?? 'Investor';
                $initials = strtoupper(substr($name,0,2));
                $sectors = json_decode($inv->sector_preferences ?? '[]', true) ?: [];
            @endphp
            <div style="background:#fff;border:1px solid #dde3ea;border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 2px 8px rgba(0,0,0,.04);transition:all .25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(26,60,143,.12)';this.style.transform='translateY(-3px)';this.style.borderColor='#bfdbfe';" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,.04)';this.style.transform='translateY(0)';this.style.borderColor='#dde3ea';">

                {{-- Cover Image --}}
                @php
                    $coverGrads=['angel'=>'linear-gradient(135deg,#c2410c 0%,#f97316 100%)','vc'=>'linear-gradient(135deg,#0d2b6e 0%,#2563eb 100%)','corporate'=>'linear-gradient(135deg,#3730a3 0%,#6366f1 100%)','family_office'=>'linear-gradient(135deg,#6b21a8 0%,#a855f7 100%)','impact'=>'linear-gradient(135deg,#14532d 0%,#16a34a 100%)'];
                    $coverGrad = $coverGrads[$inv->investor_type] ?? 'linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 100%)';
                @endphp
                <div style="position:relative;height:9rem;background:{{ $coverGrad }};overflow:hidden;display:flex;align-items:center;justify-content:center;">
                    <div style="position:absolute;inset:0;opacity:.07;background-image:radial-gradient(circle at 25% 50%,#fff 1px,transparent 1px),radial-gradient(circle at 75% 25%,#fff 1px,transparent 1px);background-size:28px 28px;"></div>
                    <div style="position:absolute;top:-2rem;right:-2rem;width:8rem;height:8rem;background:rgba(255,255,255,.06);border-radius:50%;"></div>
                    <div style="position:absolute;bottom:-3rem;left:-2rem;width:10rem;height:10rem;background:rgba(255,255,255,.04);border-radius:50%;"></div>
                    {{-- Avatar --}}
                    <div style="position:relative;z-index:2;width:4.5rem;height:4.5rem;border-radius:50%;background:rgba(255,255,255,.2);border:3px solid rgba(255,255,255,.4);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(0,0,0,.2);">
                        <span style="color:#fff;font-weight:800;font-size:1.375rem;">{{ $initials }}</span>
                    </div>
                    {{-- Verified badge on cover --}}
                    @if(($inv->verification_status??'') === 'verified')
                    <div style="position:absolute;bottom:.75rem;right:.75rem;background:rgba(22,163,74,.9);color:#fff;font-size:.65rem;font-weight:700;padding:.2rem .6rem;border-radius:9999px;display:flex;align-items:center;gap:.25rem;">
                        <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Verified
                    </div>
                    @endif
                    {{-- Type badge --}}
                    <div style="position:absolute;top:.75rem;left:.75rem;background:rgba(0,0,0,.3);color:#fff;font-size:.65rem;font-weight:700;padding:.2rem .6rem;border-radius:9999px;backdrop-filter:blur(4px);">{{ $typeLabel[$inv->investor_type]??$inv->investor_type }}</div>
                </div>
                <div style="padding:1.25rem 1.5rem;flex:1;display:flex;flex-direction:column;">
                    {{-- Name & org --}}
                    <div style="margin-bottom:.875rem;">
                        <p style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0 0 .2rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $name }}</p>
                        @if($inv->designation)<p style="font-size:.75rem;color:#8d98a1;margin:0 0 .1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->designation }}</p>@endif
                        @if($inv->organization)<p style="font-size:.7rem;color:#8d98a1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">🏢 {{ $inv->organization }}</p>@endif
                    </div>

                    {{-- Stage badge --}}
                    <div style="display:flex;flex-wrap:wrap;gap:.375rem;margin-bottom:.875rem;">
                        @if($inv->investment_stage)<span style="font-size:.68rem;background:#f1f5f9;color:#475569;padding:.2rem .6rem;border-radius:9999px;">{{ $stageLabel[$inv->investment_stage]??$inv->investment_stage }}</span>@endif
                    </div>

                    {{-- Bio --}}
                    @if($inv->bio)<p style="font-size:.78rem;color:#8d98a1;line-height:1.55;margin:0 0 .875rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $inv->bio }}</p>@endif

                    {{-- Sectors --}}
                    @if(!empty($sectors))
                    <div style="display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.875rem;">
                        @foreach(array_slice($sectors,0,3) as $sec)
                        <span style="font-size:.65rem;background:#eff6ff;color:#1a3c8f;padding:.15rem .5rem;border-radius:9999px;border:1px solid #bfdbfe;">{{ $sec }}</span>
                        @endforeach
                        @if(count($sectors)>3)<span style="font-size:.65rem;color:#8d98a1;">+{{ count($sectors)-3 }} more</span>@endif
                    </div>
                    @endif

                    {{-- Footer --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.875rem;border-top:1px solid #f1f5f9;margin-top:auto;">
                        @if($inv->ticket_size_min && $inv->ticket_size_max)
                        <div>
                            <p style="font-size:.65rem;color:#8d98a1;margin:0 0 .1rem;text-transform:uppercase;letter-spacing:.04em;">Ticket</p>
                            <p style="font-size:.8rem;font-weight:700;color:#1a3c8f;margin:0;">৳{{ number_format($inv->ticket_size_min/100000,0) }}L – {{ number_format($inv->ticket_size_max/100000,0) }}L</p>
                        </div>
                        @else<span></span>@endif
                        <a href="{{ route('register.seeker') }}" style="background:#f97316;color:#fff;font-size:.72rem;font-weight:700;padding:.35rem .875rem;border-radius:.5rem;text-decoration:none;">Connect →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:2.5rem;">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</section>

{{-- Why Join --}}
<section style="background:#fff;padding:5rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
        <div>
            <span style="display:inline-block;background:#eff6ff;border:1px solid #bfdbfe;color:#1a3c8f;font-size:.75rem;font-weight:700;padding:.3rem .875rem;border-radius:9999px;margin-bottom:1rem;text-transform:uppercase;letter-spacing:.08em;">For Investors</span>
            <h2 style="font-size:2.25rem;font-weight:800;color:#0d2b6e;margin:.75rem 0 1.5rem;line-height:1.2;">Why Invest Through VentureMatch?</h2>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                @foreach([['Access curated, admin-verified startups across 10+ sectors.','#1a3c8f'],['Filter by stage, sector, ticket size and geography.','#f97316'],['Connect directly with founders — no intermediaries.','#16a34a'],['Track your interests and portfolio from your dashboard.','#8b5cf6']] as $item)
                <div style="display:flex;align-items:flex-start;gap:.875rem;">
                    <div style="width:1.5rem;height:1.5rem;border-radius:50%;background:{{ $item[1] }}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:.125rem;">
                        <svg width="10" height="10" fill="{{ $item[1] }}" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    </div>
                    <p style="font-size:.9375rem;color:#374151;margin:0;line-height:1.6;">{{ $item[0] }}</p>
                </div>
                @endforeach
            </div>
            <a href="{{ route('register.investor') }}" style="display:inline-block;margin-top:2rem;background:#1a3c8f;color:#fff;font-weight:700;padding:.875rem 2rem;border-radius:.75rem;text-decoration:none;font-size:.9375rem;">Join as Investor →</a>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            @foreach([['500+','Registered Investors','#eff6ff','#bfdbfe','#1a3c8f'],['$50M+','Capital Connected','#f0fdf4','#bbf7d0','#16a34a'],['200+','Startups Listed','#fff7ed','#fed7aa','#f97316'],['15+','Countries','#faf5ff','#ddd6fe','#8b5cf6']] as $s)
            <div style="background:{{ $s[2] }};border:1px solid {{ $s[3] }};border-radius:1rem;padding:1.5rem;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.04);">
                <p style="font-size:2rem;font-weight:800;color:{{ $s[4] }};margin:0 0 .25rem;">{{ $s[0] }}</p>
                <p style="font-size:.8rem;color:#8d98a1;margin:0;">{{ $s[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="background:linear-gradient(135deg,#0d2b6e 0%,#1a3c8f 50%,#2563eb 100%);padding:4rem 1.5rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-4rem;right:-4rem;width:20rem;height:20rem;background:rgba(249,115,22,.12);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:40rem;margin:0 auto;position:relative;">
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Have a Startup to Fund?</h2>
        <p style="color:rgba(255,255,255,.75);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Submit your startup and get in front of our entire investor network.</p>
        <a href="{{ route('register.seeker') }}" style="background:#f97316;color:#fff;font-weight:700;padding:1rem 2.25rem;border-radius:.875rem;text-decoration:none;font-size:1rem;display:inline-block;">Submit Your Startup →</a>
    </div>
</section>

@endsection
