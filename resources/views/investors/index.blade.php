@extends('layouts.app')
@section('title', 'Investors')

@section('content')
<section class="bg-gradient-to-br from-primary-950 to-primary-800 text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-primary-700/50 text-primary-200 text-xs font-semibold px-3 py-1 rounded-full mb-4 border border-primary-600">💼 Investment Community</span>
        <h1 class="text-4xl font-extrabold mb-3">Meet Our Investors</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Connect with verified investors across all categories — from angels to VCs, corporate ventures to impact funds.</p>
    </div>
</section>

{{-- Category Cards --}}
<section class="bg-white border-b border-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @php
                $catIcons = ['angel'=>'👼','vc'=>'🏢','corporate'=>'🏭','family_office'=>'🏠','impact'=>'🌱'];
                $catColors = ['angel'=>'from-amber-500 to-orange-500','vc'=>'from-primary-600 to-primary-800','corporate'=>'from-blue-600 to-indigo-700','family_office'=>'from-purple-600 to-pink-600','impact'=>'from-green-600 to-teal-600'];
            @endphp
            @foreach($types as $key => $label)
            <a href="{{ route('investors.index', ['type'=>$key]) }}"
               class="group relative rounded-2xl overflow-hidden p-5 text-center hover:-translate-y-1 transition-all duration-300 {{ request('type')===$key ? 'ring-2 ring-primary-500' : '' }}">
                <div class="absolute inset-0 bg-gradient-to-br {{ $catColors[$key] }} opacity-90"></div>
                <div class="relative z-10">
                    <div class="text-3xl mb-2">{{ $catIcons[$key] }}</div>
                    <p class="text-white font-bold text-sm">{{ $label }}</p>
                    <p class="text-white/70 text-xs mt-1">{{ $counts[$key] ?? 0 }} investors</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filters --}}
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-4 mb-8 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or organization..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <div class="min-w-[160px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Investor Type</label>
                <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Types</option>
                    @foreach($types as $k => $v)
                    <option value="{{ $k }}" {{ request('type')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-500 mb-1">Investment Stage</label>
                <select name="stage" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">All Stages</option>
                    @foreach($stages as $k => $v)
                    <option value="{{ $k }}" {{ request('stage')===$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-primary-700 text-sm">Filter</button>
            @if(request()->hasAny(['search','type','stage']))
            <a href="{{ route('investors.index') }}" class="text-sm text-gray-500 hover:text-red-500 py-2">Clear</a>
            @endif
        </form>

        <p class="text-sm text-gray-500 mb-5">{{ $investors->total() }} investor{{ $investors->total()!=1?'s':'' }} found</p>

        @if($investors->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p class="text-lg font-medium">No investors found</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($investors as $inv)
            @php
                $typeColors = ['angel'=>'bg-amber-100 text-amber-700','vc'=>'bg-primary-100 text-primary-700','corporate'=>'bg-blue-100 text-blue-700','family_office'=>'bg-purple-100 text-purple-700','impact'=>'bg-green-100 text-green-700'];
                $typeLabels = ['angel'=>'Angel','vc'=>'VC','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact'];
                $stageLabels = ['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth'];
            @endphp
            <a href="{{ route('investors.show', $inv->id) }}"
               class="group bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center flex-shrink-0 text-white font-bold text-xl">
                        {{ strtoupper(substr($inv->user->name ?? 'IN', 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors truncate">{{ $inv->user->name }}</h3>
                        <p class="text-sm text-gray-500 truncate">{{ $inv->designation }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $inv->organization }}</p>
                    </div>
                    @if($inv->verification_status === 'verified')
                    <span title="Verified" class="text-primary-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </span>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $typeColors[$inv->investor_type] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $typeLabels[$inv->investor_type] ?? $inv->investor_type }}
                    </span>
                    @if($inv->investment_stage)
                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ $stageLabels[$inv->investment_stage] ?? $inv->investment_stage }}</span>
                    @endif
                </div>

                @if($inv->bio)
                <p class="text-sm text-gray-500 line-clamp-2 flex-1 mb-4">{{ $inv->bio }}</p>
                @endif

                <div class="pt-4 border-t border-gray-100">
                    @if($inv->sector_preferences)
                    <div class="flex flex-wrap gap-1 mb-2">
                        @foreach(array_slice($inv->sector_preferences, 0, 3) as $sector)
                        <span class="text-xs bg-primary-50 text-primary-600 px-2 py-0.5 rounded-full">{{ $sector }}</span>
                        @endforeach
                    </div>
                    @endif
                    @if($inv->ticket_size_min && $inv->ticket_size_max)
                    <p class="text-xs text-gray-400">Ticket: <span class="font-medium text-gray-700">৳{{ number_format($inv->ticket_size_min) }} – ৳{{ number_format($inv->ticket_size_max) }}</span></p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</section>
@endsection
