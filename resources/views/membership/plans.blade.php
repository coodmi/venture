@extends('layouts.app')
@section('title', 'Membership Plans')

@section('content')
<section class="bg-gradient-to-br from-primary-950 to-primary-800 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Membership Plans</h1>
        <p class="text-primary-200 text-lg">Choose the plan that fits your goals.</p>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($plans as $plan)
            <div class="bg-white rounded-2xl border {{ $plan->category === 'partner' ? 'border-primary-500 ring-2 ring-primary-500' : 'border-gray-200' }} p-6 flex flex-col">
                @if($plan->category === 'partner')
                    <span class="bg-primary-600 text-white text-xs font-semibold px-3 py-1 rounded-full self-start mb-4">Most Popular</span>
                @endif
                <h3 class="text-lg font-bold text-gray-900">{{ $plan->name }}</h3>
                <p class="text-sm text-gray-500 mt-1 mb-4">{{ $plan->description }}</p>
                <div class="mb-6">
                    @if($plan->fee > 0)
                        <span class="text-3xl font-extrabold text-gray-900">৳{{ number_format($plan->fee) }}</span>
                        <span class="text-gray-400 text-sm">/year</span>
                    @else
                        <span class="text-3xl font-extrabold text-green-600">Free</span>
                    @endif
                </div>
                <ul class="space-y-2 flex-1 mb-6">
                    @foreach($plan->benefits ?? [] as $benefit)
                    <li class="flex items-start gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
                @auth
                    <a href="{{ route('membership.apply', $plan->slug) }}"
                       class="block text-center {{ $plan->category === 'partner' ? 'bg-primary-600 text-white hover:bg-primary-700' : 'border border-primary-600 text-primary-600 hover:bg-primary-50' }} font-semibold py-2.5 rounded-xl transition-colors text-sm">
                        Apply Now
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="block text-center border border-primary-600 text-primary-600 hover:bg-primary-50 font-semibold py-2.5 rounded-xl transition-colors text-sm">
                        Login to Apply
                    </a>
                @endauth
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
