@extends('layouts.app')
@section('title', $news->meta_title ?? $news->title)
@section('meta_description', $news->meta_description ?? $news->summary)

@section('content')

@php
    $catMeta = [
        'Deal News'         => ['grad' => 'from-primary-600 to-primary-800',  'icon' => '💰', 'color' => 'bg-primary-50 text-primary-700 border-primary-100'],
        'Market Insights'   => ['grad' => 'from-blue-600 to-indigo-700',      'icon' => '📊', 'color' => 'bg-blue-50 text-blue-700 border-blue-100'],
        'Startup Spotlight' => ['grad' => 'from-purple-600 to-pink-600',      'icon' => '🚀', 'color' => 'bg-purple-50 text-purple-700 border-purple-100'],
        'Platform Update'   => ['grad' => 'from-green-600 to-teal-600',       'icon' => '⚙️', 'color' => 'bg-green-50 text-green-700 border-green-100'],
        'Press Release'     => ['grad' => 'from-gray-700 to-gray-900',        'icon' => '📢', 'color' => 'bg-gray-100 text-gray-700 border-gray-200'],
        'Founder Resources' => ['grad' => 'from-amber-500 to-orange-600',     'icon' => '💡', 'color' => 'bg-amber-50 text-amber-700 border-amber-100'],
        'Event Recap'       => ['grad' => 'from-rose-500 to-red-700',         'icon' => '🏆', 'color' => 'bg-rose-50 text-rose-700 border-rose-100'],
        'System Notice'     => ['grad' => 'from-slate-600 to-slate-800',      'icon' => '🔔', 'color' => 'bg-slate-100 text-slate-700 border-slate-200'],
    ];
    $meta = $catMeta[$news->category] ?? ['grad' => 'from-primary-600 to-primary-800', 'icon' => '📰', 'color' => 'bg-primary-50 text-primary-700 border-primary-100'];
@endphp

{{-- Hero / Cover --}}
<div class="relative w-full bg-gray-900 overflow-hidden" style="min-height: 420px;">
    @if($news->cover_image)
        <img src="{{ Storage::url($news->cover_image) }}" alt="{{ $news->title }}"
             class="absolute inset-0 w-full h-full object-cover opacity-40">
    @else
        <div class="absolute inset-0 bg-gradient-to-br {{ $meta['grad'] }} opacity-90"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="text-9xl opacity-20">{{ $meta['icon'] }}</span>
        </div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-14 flex flex-col justify-end" style="min-height: 420px;">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-white/60 text-xs mb-6">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" class="hover:text-white transition-colors">News & Media</a>
            <span>/</span>
            <span class="text-white/40 truncate max-w-48">{{ $news->title }}</span>
        </div>

        {{-- Category + Type badges --}}
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="text-xs font-bold px-3 py-1.5 rounded-full border {{ $meta['color'] }}">
                {{ $meta['icon'] }} {{ $news->category }}
            </span>
            @if($news->type === 'press_release')
            <span class="text-xs font-semibold bg-white/10 text-white border border-white/20 px-3 py-1.5 rounded-full backdrop-blur-sm">
                Press Release
            </span>
            @endif
            @if($news->is_featured)
            <span class="text-xs font-semibold bg-accent-500 text-white px-3 py-1.5 rounded-full">
                ⭐ Featured
            </span>
            @endif
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-5 max-w-3xl">
            {{ $news->title }}
        </h1>

        @if($news->summary)
        <p class="text-white/70 text-lg leading-relaxed max-w-2xl mb-6">{{ $news->summary }}</p>
        @endif

        {{-- Meta row --}}
        <div class="flex flex-wrap items-center gap-4 text-sm text-white/60">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <span class="text-white font-bold text-xs">{{ substr($news->author ?? 'V', 0, 1) }}</span>
                </div>
                <span class="text-white/80 font-medium">{{ $news->author ?? 'VentureMatch' }}</span>
            </div>
            <span class="text-white/30">·</span>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $news->published_at?->format('F d, Y') }}
            </div>
            @if($news->tags && count($news->tags))
            <span class="text-white/30">·</span>
            <div class="flex flex-wrap gap-1.5">
                @foreach(array_slice($news->tags, 0, 3) as $tag)
                <span class="bg-white/10 text-white/70 text-xs px-2 py-0.5 rounded-full border border-white/10">{{ $tag }}</span>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Article Body --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- Main Content --}}
            <article class="lg:col-span-8">
                <div class="prose prose-lg prose-gray max-w-none
                    prose-headings:font-extrabold prose-headings:text-gray-900
                    prose-h2:text-2xl prose-h3:text-xl
                    prose-p:text-gray-600 prose-p:leading-relaxed
                    prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline
                    prose-strong:text-gray-900
                    prose-ul:text-gray-600 prose-ol:text-gray-600
                    prose-li:my-1
                    prose-blockquote:border-primary-500 prose-blockquote:bg-primary-50 prose-blockquote:rounded-r-xl prose-blockquote:py-1">
                    {!! $news->body !!}
                </div>

                {{-- Tags --}}
                @if($news->tags && count($news->tags))
                <div class="mt-10 pt-8 border-t border-gray-100">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Tags</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($news->tags as $tag)
                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1.5 rounded-full hover:bg-primary-50 hover:text-primary-700 transition-colors cursor-default">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div class="mt-8 pt-8 border-t border-gray-100 flex items-center gap-4">
                    <p class="text-sm font-semibold text-gray-700">Share this article:</p>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                       target="_blank"
                       class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}"
                       target="_blank"
                       class="w-9 h-9 bg-sky-500 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>

                {{-- Author Card --}}
                <div class="mt-10 bg-gray-50 rounded-2xl p-6 border border-gray-100 flex items-start gap-4">
                    <div class="w-14 h-14 bg-primary-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-extrabold text-xl">{{ substr($news->author ?? 'V', 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $news->author ?? 'VentureMatch Editorial' }}</p>
                        <p class="text-sm text-primary-600 font-medium">VentureMatch</p>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            Covering investment trends, startup ecosystem news, and platform updates for the VentureMatch community.
                        </p>
                    </div>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="lg:col-span-4 space-y-6">

                {{-- Article Info Card --}}
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 sticky top-24">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Article Info</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Category</span>
                            <span class="font-semibold text-gray-800">{{ $news->category }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Published</span>
                            <span class="font-semibold text-gray-800">{{ $news->published_at?->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Author</span>
                            <span class="font-semibold text-gray-800 text-right max-w-32 truncate">{{ $news->author }}</span>
                        </div>
                        @if($news->type !== 'news')
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Type</span>
                            <span class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $news->type)) }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="mt-5 pt-5 border-t border-gray-200 space-y-2">
                        <a href="{{ route('news.index') }}"
                           class="flex items-center gap-2 text-sm text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Back to News
                        </a>
                        <a href="{{ route('notices.index') }}"
                           class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            View Notices
                        </a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>

{{-- Related Articles --}}
@if($related->count())
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-bold text-primary-600 uppercase tracking-widest">Keep Reading</span>
                <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Related Articles</h2>
            </div>
            <a href="{{ route('news.index') }}" class="text-sm text-primary-600 font-semibold hover:underline">View all →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($related as $r)
            @php
                $rMeta = $catMeta[$r->category] ?? ['grad' => 'from-primary-600 to-primary-800', 'icon' => '📰', 'color' => 'bg-primary-50 text-primary-700 border-primary-100'];
            @endphp
            <a href="{{ route('news.show', $r->slug) }}"
               class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                {{-- Thumbnail --}}
                @if($r->cover_image)
                    <div class="relative overflow-hidden h-44">
                        <img src="{{ Storage::url($r->cover_image) }}" alt="{{ $r->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                @else
                    <div class="h-44 bg-gradient-to-br {{ $rMeta['grad'] }} flex items-center justify-center relative overflow-hidden">
                        <span class="text-5xl opacity-60">{{ $rMeta['icon'] }}</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                @endif

                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold px-2.5 py-1 rounded-full border {{ $rMeta['color'] }}">
                            {{ $r->category }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors leading-snug line-clamp-2 flex-1 mb-3">
                        {{ $r->title }}
                    </h3>
                    @if($r->summary)
                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $r->summary }}</p>
                    @endif
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-auto">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-primary-700 font-bold text-xs">{{ substr($r->author ?? 'V', 0, 1) }}</span>
                            </div>
                            <span class="text-xs text-gray-400 truncate max-w-24">{{ $r->author }}</span>
                        </div>
                        <span class="text-xs text-gray-400">{{ $r->published_at?->format('M d, Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
