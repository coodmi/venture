@extends('layouts.app')
@section('title', 'News & Media — VentureMatch')
@section('meta_description', 'Stay updated with the latest investment news, startup spotlights, market insights, and ecosystem updates from VentureMatch.')

@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-20 w-80 h-80 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-28">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-primary-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 bg-accent-400 rounded-full"></span>
                News & Media
            </span>
            <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-5 tracking-tight">
                Ecosystem<br>
                <span class="text-accent-400">Intelligence</span>
            </h1>
            <p class="text-lg text-primary-200 leading-relaxed max-w-xl mb-8">
                Deal news, market insights, startup spotlights, and platform updates — everything happening in the VentureMatch ecosystem.
            </p>
            {{-- Category filter pills --}}
            <div class="flex flex-wrap gap-2">
                @php
                    $cats = ['All', 'Deal News', 'Market Insights', 'Startup Spotlight', 'Platform Update', 'Founder Resources', 'Event Recap', 'Press Release'];
                @endphp
                @foreach($cats as $cat)
                <a href="{{ $cat === 'All' ? route('news.index') : route('news.index', ['category' => $cat]) }}"
                   class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all
                          {{ (request('category') === $cat || ($cat === 'All' && !request('category'))) ? 'bg-accent-500 text-white' : 'bg-white/10 text-white/80 hover:bg-white/20 border border-white/20' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 60L1440 60L1440 20C1200 60 960 0 720 20C480 40 240 0 0 20L0 60Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- Featured Article --}}
@php $featured = $news->firstWhere('is_featured', true) ?? $news->first(); @endphp
@if($featured)
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent-500 rounded-full"></span>
            <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Featured Story</span>
        </div>
        <a href="{{ route('news.show', $featured->slug) }}"
           class="group grid grid-cols-1 lg:grid-cols-5 gap-0 bg-gray-50 rounded-3xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="lg:col-span-3 relative overflow-hidden h-64 lg:h-auto">
                @if($featured->cover_image)
                    <img src="{{ Storage::url($featured->cover_image) }}" alt="{{ $featured->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @else
                    @php
                        $featGrads = ['Deal News'=>'from-primary-600 to-primary-800','Market Insights'=>'from-blue-600 to-indigo-700','Startup Spotlight'=>'from-purple-600 to-pink-600','Platform Update'=>'from-green-600 to-teal-600','Press Release'=>'from-gray-700 to-gray-900','Founder Resources'=>'from-amber-500 to-orange-600','Event Recap'=>'from-rose-500 to-red-700'];
                        $featGrad = $featGrads[$featured->category] ?? 'from-primary-600 to-primary-800';
                    @endphp
                    <div class="w-full h-full min-h-64 bg-gradient-to-br {{ $featGrad }} flex items-center justify-center">
                        <svg class="w-20 h-20 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent lg:hidden"></div>
            </div>
            <div class="lg:col-span-2 p-8 lg:p-10 flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-accent-100 text-accent-700 text-xs font-bold px-3 py-1 rounded-full">{{ $featured->category }}</span>
                    <span class="text-xs text-gray-400">{{ $featured->published_at?->format('M d, Y') }}</span>
                </div>
                <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-900 leading-tight mb-4 group-hover:text-primary-700 transition-colors">
                    {{ $featured->title }}
                </h2>
                <p class="text-gray-500 leading-relaxed mb-6 line-clamp-3">{{ $featured->summary }}</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-primary-100 rounded-full flex items-center justify-center">
                            <span class="text-primary-700 font-bold text-xs">{{ substr($featured->author ?? 'V', 0, 1) }}</span>
                        </div>
                        <span class="text-sm text-gray-500">{{ $featured->author }}</span>
                    </div>
                    <span class="text-primary-600 text-sm font-semibold group-hover:translate-x-1 transition-transform inline-block">Read More →</span>
                </div>
            </div>
        </a>
    </div>
</section>
@endif

{{-- All Articles Grid --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">Latest</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-1">All Articles</h2>
            </div>
            <a href="{{ route('notices.index') }}" class="text-sm text-primary-600 font-semibold hover:underline">View Notices →</a>
        </div>

        @php
            $catGrads = [
                'Deal News'        => ['grad' => 'from-primary-600 to-primary-800',  'icon' => '💰', 'color' => 'bg-primary-50 text-primary-700'],
                'Market Insights'  => ['grad' => 'from-blue-600 to-indigo-700',      'icon' => '📊', 'color' => 'bg-blue-50 text-blue-700'],
                'Startup Spotlight'=> ['grad' => 'from-purple-600 to-pink-600',      'icon' => '🚀', 'color' => 'bg-purple-50 text-purple-700'],
                'Platform Update'  => ['grad' => 'from-green-600 to-teal-600',       'icon' => '⚙️', 'color' => 'bg-green-50 text-green-700'],
                'Press Release'    => ['grad' => 'from-gray-700 to-gray-900',        'icon' => '📢', 'color' => 'bg-gray-100 text-gray-700'],
                'Founder Resources'=> ['grad' => 'from-amber-500 to-orange-600',     'icon' => '💡', 'color' => 'bg-amber-50 text-amber-700'],
                'Event Recap'      => ['grad' => 'from-rose-500 to-red-700',         'icon' => '🏆', 'color' => 'bg-rose-50 text-rose-700'],
                'System Notice'    => ['grad' => 'from-slate-600 to-slate-800',      'icon' => '🔔', 'color' => 'bg-slate-100 text-slate-700'],
            ];
        @endphp

        @forelse($news as $article)
        @if($loop->first)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

        <a href="{{ route('news.show', $article->slug) }}"
           class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
            {{-- Thumbnail --}}
            @if($article->cover_image)
                <div class="relative overflow-hidden h-48">
                    <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @if($article->is_featured)
                    <div class="absolute top-3 right-3">
                        <span class="bg-accent-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">⭐ Featured</span>
                    </div>
                    @endif
                </div>
            @else
                @php
                    $meta = $catGrads[$article->category] ?? ['grad' => 'from-primary-600 to-primary-800', 'icon' => '📰', 'color' => 'bg-primary-50 text-primary-700'];
                @endphp
                <div class="relative h-48 bg-gradient-to-br {{ $meta['grad'] }} flex items-center justify-center overflow-hidden">
                    <svg class="w-14 h-14 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @if($article->is_featured)
                    <div class="absolute top-3 right-3">
                        <span class="bg-accent-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">⭐ Featured</span>
                    </div>
                    @endif
                </div>
            @endif

            {{-- Content --}}
            <div class="p-5 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-3">
                    @php $meta = $catGrads[$article->category] ?? ['color' => 'bg-gray-100 text-gray-600']; @endphp
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $meta['color'] }}">{{ $article->category }}</span>
                    @if($article->type === 'press_release')
                    <span class="text-xs bg-gray-100 text-gray-500 font-medium px-2 py-0.5 rounded-full">Press Release</span>
                    @endif
                </div>
                <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors leading-snug mb-2 line-clamp-2 flex-1">
                    {{ $article->title }}
                </h3>
                <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $article->summary }}</p>
                <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-auto">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-primary-700 font-bold text-xs">{{ substr($article->author ?? 'V', 0, 1) }}</span>
                        </div>
                        <span class="text-xs text-gray-400 truncate max-w-28">{{ $article->author }}</span>
                    </div>
                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $article->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
        </a>

        @if($loop->last)
        </div>
        @endif

        @empty
        <div class="text-center py-20">
            <div class="text-5xl mb-4">📰</div>
            <p class="text-lg font-medium text-gray-500">No articles yet.</p>
            <p class="text-sm text-gray-400 mt-1">Check back soon for the latest ecosystem news.</p>
        </div>
        @endforelse

        <div class="mt-10">{{ $news->withQueryString()->links() }}</div>
    </div>
</section>

{{-- Press Releases Strip --}}
@php $pressReleases = $news->where('type', 'press_release'); @endphp
@if($pressReleases->isNotEmpty())
<section class="py-14 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Official</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Press Releases</h2>
        </div>
        <div class="space-y-3">
            @foreach($pressReleases as $pr)
            <a href="{{ route('news.show', $pr->slug) }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-primary-200 hover:bg-primary-50/30 transition-all group">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 text-sm group-hover:text-primary-700 transition-colors truncate">{{ $pr->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $pr->published_at?->format('M d, Y') }} · {{ $pr->author }}</p>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Newsletter CTA --}}
<section class="py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-20 w-64 h-64 bg-accent-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <span class="inline-block bg-white/10 border border-white/20 text-primary-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-5">
            Stay Informed
        </span>
        <h2 class="text-4xl font-extrabold mb-4">Get the Latest in Your Inbox</h2>
        <p class="text-primary-200 text-lg mb-8 max-w-xl mx-auto">
            Deal news, market reports, startup spotlights, and event invitations — delivered weekly to investors and founders who want to stay ahead.
        </p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST"
              class="flex flex-col sm:flex-row gap-3 justify-center max-w-md mx-auto">
            @csrf
            <input type="email" name="email" placeholder="your@email.com" required
                   class="flex-1 bg-white/10 border border-white/30 text-white placeholder-white/50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white backdrop-blur-sm">
            <button type="submit"
                    class="bg-accent-500 hover:bg-accent-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors text-sm flex-shrink-0">
                Subscribe
            </button>
        </form>
    </div>
</section>

@endsection
