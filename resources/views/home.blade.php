@extends('layouts.app')

@section('title', 'VentureMatch — Connect. Invest. Grow.')
@section('meta_description', 'VentureMatch connects investors with high-potential startups, projects, and ecosystem opportunities.')

@section('content')

{{-- Hero Slider --}}
@if(count($heroSlides) > 0)
<section class="relative w-full overflow-hidden" style="height: 90vh; min-height: 500px;" >
    @foreach($heroSlides as $i => $slide)
    <div class="vm-slide" style="position:absolute;inset:0;transition:opacity .7s;" data-index="{{ $i }}">

        {{-- Background --}}
        @if($slide['type'] === 'video' && !empty($slide['video_url']))
            @php
                preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $slide['video_url'], $m);
                $vid = $m[1] ?? '';
            @endphp
            @if($vid)
            <iframe src="https://www.youtube.com/embed/{{ $vid }}?autoplay=1&mute=1&loop=1&playlist={{ $vid }}&controls=0&showinfo=0&rel=0"
                class="absolute inset-0 w-full h-full object-cover scale-110"
                style="pointer-events:none; border:0; width:100%; height:100%;"
                allow="autoplay; encrypted-media" allowfullscreen></iframe>
            @endif
        @elseif(!empty($slide['image']))
            <img src="{{ Storage::url($slide['image']) }}" alt="{{ $slide['title'] }}"
                 class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800"></div>
        @endif

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/40"></div>
        {{-- Bottom gradient for dots visibility --}}
        <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-black/60 to-transparent"></div>

        {{-- Content --}}
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-2xl text-white">
                    @if(!empty($slide['title']))
                        <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mb-4">{{ $slide['title'] }}</h1>
                    @endif
                    @if(!empty($slide['subtitle']))
                        <p class="text-lg text-white/80 mb-8">{{ $slide['subtitle'] }}</p>
                    @endif
                    <div class="flex flex-wrap gap-3">
                        @if(!empty($slide['btn1_text']))
                            <a href="{{ $slide['btn1_url'] ?? '#' }}"
                               class="bg-accent-500 hover:bg-accent-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition-all">
                                {{ $slide['btn1_text'] }}
                            </a>
                        @endif
                        @if(!empty($slide['btn2_text']))
                            <a href="{{ $slide['btn2_url'] ?? '#' }}"
                               class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-6 py-3 rounded-xl backdrop-blur-sm transition-all">
                                {{ $slide['btn2_text'] }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Arrows - always visible --}}
    <button onclick="vmPrev()" class="absolute left-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 bg-white/20 hover:bg-white/90 hover:text-gray-900 text-white border border-white/40 rounded-full flex items-center justify-center backdrop-blur-sm transition-all shadow-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button onclick="vmNext()" class="absolute right-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 bg-white/20 hover:bg-white/90 hover:text-gray-900 text-white border border-white/40 rounded-full flex items-center justify-center backdrop-blur-sm transition-all shadow-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
        @foreach($heroSlides as $i => $slide)
        <button onclick="vmSet({{ $i }})" id="vmDot{{ $i }}" style="height:.5rem;border-radius:9999px;border:none;cursor:pointer;transition:all .3s;background:rgba(255,255,255,.45);width:.5rem;"></button>
        @endforeach
    </div>
</section>

@push('scripts')
<script>
(function(){
  var slides,dots,cur=0,tot={{ count($heroSlides) }},tmr;
  document.addEventListener('DOMContentLoaded',function(){
    slides=document.querySelectorAll('.vm-slide');
    dots=document.querySelectorAll('[id^=vmDot]');
    vmSet(0);
    if(tot>1) tmr=setInterval(function(){vmNext();},5000);
  });
  window.vmNext=function(){vmSet((cur+1)%tot);reset();};
  window.vmPrev=function(){vmSet((cur-1+tot)%tot);reset();};
  window.vmSet=function(i){
    if(slides){
      slides[cur].style.opacity='0';slides[cur].style.zIndex='0';
      if(dots[cur]){dots[cur].style.background='rgba(255,255,255,.45)';dots[cur].style.width='.5rem';}
      cur=i;
      slides[cur].style.opacity='1';slides[cur].style.zIndex='10';
      if(dots[cur]){dots[cur].style.background='#fff';dots[cur].style.width='1.5rem';}
    }
  };
  function reset(){clearInterval(tmr);if(tot>1)tmr=setInterval(function(){vmNext();},5000);}
})();
</script>
@endpush

@else
{{-- Fallback static hero --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-3xl">
            <span class="inline-block bg-primary-700/50 text-primary-200 text-xs font-semibold px-3 py-1 rounded-full mb-6 border border-primary-600">
                🚀 The Investment Ecosystem Platform
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                Where Investors Meet<br>
                <span class="text-accent-500">Tomorrow's Ventures</span>
            </h1>
            <p class="text-lg text-primary-200 mb-10 max-w-2xl leading-relaxed">
                VentureMatch brings together investors, founders, startups, partners, and ecosystem stakeholders on one powerful platform — making deal discovery, collaboration, and growth seamless.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('register.investor') }}" class="bg-accent-500 hover:bg-accent-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition-all">Join as Investor</a>
                <a href="{{ route('register.seeker') }}" class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-6 py-3 rounded-xl backdrop-blur-sm transition-all">Join as Seeker</a>
                <a href="{{ route('investor.opportunities.index') }}" class="border border-white/30 text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition-all">Explore Opportunities →</a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Stats Section --}}
@if($stats->count())
<section class="bg-white border-b border-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 text-center">
            @foreach($stats as $stat)
            <div>
                <div class="text-3xl font-extrabold text-primary-700" data-counter="{{ $stat->value }}">{{ $stat->value }}</div>
                <div class="text-sm text-gray-500 mt-1">{{ $stat->label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Platform Overview --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-gray-900">How VentureMatch Works</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">A connected ecosystem where every stakeholder finds value.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $steps = [
                    ['icon' => '🔍', 'title' => 'Discover', 'desc' => 'Investors browse curated opportunities filtered by sector, stage, and ticket size.'],
                    ['icon' => '🤝', 'title' => 'Connect', 'desc' => 'Express interest, request meetings, and engage directly with founders.'],
                    ['icon' => '🚀', 'title' => 'Grow', 'desc' => 'Close deals, join bootcamps, attend conferences, and scale together.'],
                ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="text-4xl mb-4">{{ $step['icon'] }}</div>
                <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-bold mx-auto mb-4">{{ $i + 1 }}</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Hot Deals --}}
@if($hotDeals->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-red-500 uppercase tracking-wider">🔥 Limited Time</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">Hot Deals</h2>
            </div>
            <a href="{{ route('investor.opportunities.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hotDeals as $deal)
            <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-red-50 text-red-600 text-xs font-semibold px-2 py-1 rounded-full">🔥 Hot Deal</span>
                    <span class="text-xs text-gray-400">{{ $deal->sector }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $deal->title }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $deal->solution }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-primary-700 font-bold text-sm">${{ number_format($deal->ask_amount) }} {{ $deal->ask_currency }}</span>
                    <a href="{{ route('investor.opportunities.show', $deal->slug) }}" class="text-xs text-primary-600 font-medium hover:underline">View Details →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Opportunities --}}
@if($featured->count())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-primary-600 uppercase tracking-wider">⭐ Curated</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">Featured Opportunities</h2>
            </div>
            <a href="{{ route('investor.opportunities.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featured as $opp)
            <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-primary-50 text-primary-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $opp->stage }}</span>
                    <span class="text-xs text-gray-400">{{ $opp->sector }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $opp->title }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $opp->solution }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-primary-700 font-bold text-sm">${{ number_format($opp->ask_amount) }}</span>
                    <a href="{{ route('investor.opportunities.show', $opp->slug) }}" class="text-xs text-primary-600 font-medium hover:underline">View Details →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Upcoming Events --}}
@if($events->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-green-600 uppercase tracking-wider">📅 Upcoming</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">Events & Conferences</h2>
            </div>
            <a href="{{ route('events.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($events as $event)
            <a href="{{ route('events.show', $event->slug) }}" class="group block bg-gray-50 rounded-2xl overflow-hidden hover:shadow-md transition-shadow">
                @if($event->banner)
                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}" class="w-full h-36 object-cover">
                @else
                    <div class="w-full h-36 bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                <div class="p-4">
                    <span class="text-xs text-primary-600 font-medium">{{ $event->start_date->format('M d, Y') }}</span>
                    <h3 class="font-semibold text-gray-900 mt-1 text-sm group-hover:text-primary-600 transition-colors line-clamp-2">{{ $event->title }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $event->venue ?? 'Online' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if($testimonials->count())
<section class="py-20 bg-primary-950 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold">What Our Members Say</h2>
            <p class="text-primary-300 mt-3">Real stories from investors, founders, and partners.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
            <div class="bg-primary-900/50 border border-primary-800 rounded-2xl p-6">
                <div class="flex gap-1 mb-4">
                    @for($i = 0; $i < $t->rating; $i++)
                        <span class="text-accent-500 text-sm">★</span>
                    @endfor
                </div>
                <p class="text-primary-200 text-sm leading-relaxed mb-6">"{{ $t->content }}"</p>
                <div class="flex items-center gap-3">
                    @if($t->photo)
                        <img src="{{ Storage::url($t->photo) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 bg-primary-700 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr($t->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="font-semibold text-white text-sm">{{ $t->name }}</p>
                        <p class="text-primary-400 text-xs">{{ $t->designation }}{{ $t->organization ? ', ' . $t->organization : '' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest News --}}
@if($latestNews->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Latest News</h2>
            <a href="{{ route('news.index') }}" class="text-primary-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestNews as $article)
            <a href="{{ route('news.show', $article->slug) }}" class="group block">
                @if($article->cover_image)
                    <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover rounded-xl mb-4">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl mb-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                @endif
                <span class="text-xs text-primary-600 font-medium">{{ $article->category }}</span>
                <h3 class="font-semibold text-gray-900 mt-1 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $article->title }}</h3>
                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $article->summary }}</p>
                <p class="text-xs text-gray-400 mt-2">{{ $article->published_at?->format('M d, Y') }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section class="py-20 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Join the Ecosystem?</h2>
        <p class="text-primary-200 mb-8 text-lg">Whether you're an investor looking for the next big opportunity or a founder seeking capital — VentureMatch is your platform.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register.investor') }}" class="bg-white text-primary-700 font-semibold px-8 py-3 rounded-xl hover:bg-gray-100 transition-colors">
                Join as Investor
            </a>
            <a href="{{ route('register.seeker') }}" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white/10 transition-colors">
                Join as Seeker
            </a>
        </div>
    </div>
</section>

@endsection
