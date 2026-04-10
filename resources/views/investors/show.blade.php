@extends('layouts.app')
@section('title', $investor->user->name . ' — Investor Profile')

@section('content')
@php
    $typeLabels = ['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate Investor','family_office'=>'Family Office','impact'=>'Impact Investor'];
    $stageLabels = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
    $riskLabels = ['conservative'=>'Conservative','moderate'=>'Moderate','aggressive'=>'Aggressive'];
    $typeColors = ['angel'=>'from-amber-500 to-orange-500','vc'=>'from-primary-600 to-primary-800','corporate'=>'from-blue-600 to-indigo-700','family_office'=>'from-purple-600 to-pink-600','impact'=>'from-green-600 to-teal-600'];
@endphp

<section class="bg-gradient-to-br from-primary-950 to-primary-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('investors.index') }}" class="text-primary-300 text-sm hover:text-white mb-6 inline-block">← Back to Investors</a>
        <div class="flex flex-wrap items-center gap-6">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br {{ $typeColors[$investor->investor_type] ?? 'from-primary-600 to-primary-800' }} flex items-center justify-center text-white font-bold text-3xl flex-shrink-0">
                {{ strtoupper(substr($investor->user->name, 0, 2)) }}
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl font-extrabold">{{ $investor->user->name }}</h1>
                    @if($investor->verification_status === 'verified')
                    <span class="text-primary-300" title="Verified Investor">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </span>
                    @endif
                </div>
                <p class="text-primary-200">{{ $investor->designation }} · {{ $investor->organization }}</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="text-xs bg-white/20 text-white px-3 py-1 rounded-full">{{ $typeLabels[$investor->investor_type] ?? $investor->investor_type }}</span>
                    @if($investor->investment_stage)<span class="text-xs bg-white/10 text-white px-3 py-1 rounded-full">{{ $stageLabels[$investor->investment_stage] ?? $investor->investment_stage }}</span>@endif
                </div>
            </div>
            <div class="flex gap-3">
                @if($investor->linkedin_url)
                <a href="{{ $investor->linkedin_url }}" target="_blank" class="bg-white/10 hover:bg-white/20 border border-white/30 text-white px-4 py-2 rounded-xl text-sm font-medium transition-all">LinkedIn →</a>
                @endif
                @guest
                <a href="{{ route('register.investor') }}" class="bg-accent-500 hover:bg-accent-600 text-white px-5 py-2 rounded-xl text-sm font-semibold transition-all">Connect</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Bio --}}
            <div class="lg:col-span-2 space-y-6">
                @if($investor->bio)
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h2 class="font-bold text-gray-900 text-lg mb-3">About</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $investor->bio }}</p>
                </div>
                @endif

                @if($investor->sector_preferences)
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h2 class="font-bold text-gray-900 text-lg mb-4">Sector Focus</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($investor->sector_preferences as $sector)
                        <span class="bg-primary-50 text-primary-700 font-semibold px-4 py-2 rounded-xl text-sm">{{ $sector }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">
                <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                    <h3 class="font-bold text-gray-900">Investment Profile</h3>
                    @if($investor->ticket_size_min && $investor->ticket_size_max)
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Ticket Size</p>
                        <p class="font-bold text-primary-700">৳{{ number_format($investor->ticket_size_min) }} – ৳{{ number_format($investor->ticket_size_max) }}</p>
                    </div>
                    @endif
                    @if($investor->investment_stage)
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Stage</span><span class="font-medium">{{ $stageLabels[$investor->investment_stage] ?? $investor->investment_stage }}</span></div>
                    @endif
                    @if($investor->risk_profile)
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Risk Profile</span><span class="font-medium">{{ $riskLabels[$investor->risk_profile] ?? $investor->risk_profile }}</span></div>
                    @endif
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Status</span>
                        <span class="text-green-600 font-semibold">✓ Verified</span>
                    </div>
                </div>

                <div class="bg-primary-600 rounded-2xl p-6 text-white text-center">
                    <p class="font-bold text-lg mb-2">Looking to raise funds?</p>
                    <p class="text-primary-200 text-sm mb-4">Submit your startup and get discovered by investors like {{ explode(' ', $investor->user->name)[0] }}.</p>
                    <a href="{{ route('register.seeker') }}" class="block bg-white text-primary-700 font-bold py-2.5 rounded-xl hover:bg-primary-50 transition-colors text-sm">
                        Submit Your Startup
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
