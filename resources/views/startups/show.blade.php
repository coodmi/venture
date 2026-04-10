@extends('layouts.app')
@section('title', $opportunity->title)

@section('content')
<section class="bg-gradient-to-br from-primary-950 to-primary-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('startups.index') }}" class="text-primary-300 text-sm hover:text-white mb-4 inline-block">← Back to Startups</a>
        <div class="flex flex-wrap items-start gap-6">
            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-2xl">{{ strtoupper(substr($opportunity->title,0,2)) }}</span>
            </div>
            <div class="flex-1">
                <div class="flex flex-wrap gap-2 mb-2">
                    @if($opportunity->sector)<span class="text-xs bg-primary-700/50 text-primary-200 px-2 py-0.5 rounded-full border border-primary-600">{{ $opportunity->sector }}</span>@endif
                    @if($opportunity->stage)<span class="text-xs bg-white/10 text-white px-2 py-0.5 rounded-full">{{ $opportunity->stage }}</span>@endif
                    @if($opportunity->is_featured)<span class="text-xs bg-amber-500 text-white px-2 py-0.5 rounded-full">⭐ Featured</span>@endif
                    @if($opportunity->is_hot_deal)<span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full">🔥 Hot Deal</span>@endif
                </div>
                <h1 class="text-3xl font-extrabold mb-2">{{ $opportunity->title }}</h1>
                @if($opportunity->location)<p class="text-primary-300 text-sm">📍 {{ $opportunity->location }}</p>@endif
            </div>
            @if($opportunity->ask_amount)
            <div class="bg-white/10 rounded-2xl p-5 text-center border border-white/20 min-w-[160px]">
                <p class="text-primary-300 text-xs mb-1">Investment Ask</p>
                <p class="text-3xl font-extrabold">৳{{ number_format($opportunity->ask_amount) }}</p>
                @if($opportunity->ask_currency)<p class="text-primary-300 text-xs">{{ $opportunity->ask_currency }}</p>@endif
            </div>
            @endif
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                @foreach([
                    ['label'=>'The Problem','content'=>$opportunity->business_problem],
                    ['label'=>'Our Solution','content'=>$opportunity->solution],
                    ['label'=>'Target Market','content'=>$opportunity->target_market],
                    ['label'=>'Traction','content'=>$opportunity->traction],
                    ['label'=>'Use of Funds','content'=>$opportunity->use_of_funds],
                ] as $section)
                @if(!empty($section['content']))
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h2 class="font-bold text-gray-900 text-lg mb-3">{{ $section['label'] }}</h2>
                    <div class="text-gray-600 text-sm leading-relaxed prose max-w-none">{!! nl2br(e($section['content'])) !!}</div>
                </div>
                @endif
                @endforeach
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">
                {{-- Invest CTA --}}
                <div class="bg-primary-600 rounded-2xl p-6 text-white text-center">
                    <p class="font-bold text-lg mb-1">Interested in investing?</p>
                    <p class="text-primary-200 text-sm mb-4">Connect with the founder and explore this opportunity.</p>
                    @auth
                        @if(auth()->user()->hasRole('investor'))
                            <a href="{{ route('investor.opportunities.show', $opportunity->slug) }}"
                               class="block bg-white text-primary-700 font-bold py-2.5 rounded-xl hover:bg-primary-50 transition-colors">
                                Express Interest
                            </a>
                        @else
                            <a href="{{ route('register.investor') }}"
                               class="block bg-white text-primary-700 font-bold py-2.5 rounded-xl hover:bg-primary-50 transition-colors">
                                Join as Investor
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register.investor') }}"
                           class="block bg-white text-primary-700 font-bold py-2.5 rounded-xl hover:bg-primary-50 transition-colors mb-2">
                            Join as Investor
                        </a>
                        <a href="{{ route('login') }}" class="text-primary-200 text-sm hover:text-white">Already have an account? Login</a>
                    @endauth
                </div>

                {{-- Key Metrics --}}
                @if($opportunity->key_metrics)
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-3">Key Metrics</h3>
                    <div class="text-sm text-gray-600 leading-relaxed">{!! nl2br(e($opportunity->key_metrics)) !!}</div>
                </div>
                @endif

                {{-- Stats --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-3">
                    <h3 class="font-bold text-gray-900 mb-3">Details</h3>
                    @if($opportunity->sector)
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Sector</span><span class="font-medium text-gray-900">{{ $opportunity->sector }}</span></div>
                    @endif
                    @if($opportunity->stage)
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Stage</span><span class="font-medium text-gray-900">{{ $opportunity->stage }}</span></div>
                    @endif
                    @if($opportunity->country)
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Country</span><span class="font-medium text-gray-900">{{ $opportunity->country }}</span></div>
                    @endif
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Views</span><span class="font-medium text-gray-900">{{ number_format($opportunity->views) }}</span></div>
                </div>
            </div>
        </div>

        {{-- Related --}}
        @if($related->count())
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-900 mb-5">More in {{ $opportunity->sector }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($related as $r)
                <a href="{{ route('startups.show', $r->slug) }}" class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $r->title }}</h3>
                    <p class="text-xs text-gray-400">{{ $r->stage }} · {{ $r->location }}</p>
                    @if($r->ask_amount)<p class="text-primary-600 font-bold text-sm mt-2">৳{{ number_format($r->ask_amount) }}</p>@endif
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
