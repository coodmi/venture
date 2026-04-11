@extends('layouts.app')
@section('title', $news->meta_title ?? $news->title)
@section('meta_description', $news->meta_description ?? $news->summary)

@section('content')

@php
    $catMeta = [
        'Deal News'         => ['grad' => 'linear-gradient(135deg,#d4920f,#b8780a)', 'icon' => '💰'],
        'Market Insights'   => ['grad' => 'linear-gradient(135deg,#3b82f6,#4f46e5)', 'icon' => '📊'],
        'Startup Spotlight' => ['grad' => 'linear-gradient(135deg,#9333ea,#db2777)', 'icon' => '🚀'],
        'Platform Update'   => ['grad' => 'linear-gradient(135deg,#10b981,#0d9488)', 'icon' => '⚙️'],
        'Press Release'     => ['grad' => 'linear-gradient(135deg,#374151,#111827)', 'icon' => '📢'],
        'Founder Resources' => ['grad' => 'linear-gradient(135deg,#f59e0b,#ea580c)', 'icon' => '💡'],
        'Event Recap'       => ['grad' => 'linear-gradient(135deg,#f43f5e,#b91c1c)', 'icon' => '🏆'],
        'System Notice'     => ['grad' => 'linear-gradient(135deg,#475569,#1e293b)', 'icon' => '🔔'],
    ];
    $meta = $catMeta[$news->category] ?? ['grad' => 'linear-gradient(135deg,#d4920f,#b8780a)', 'icon' => '📰'];
@endphp

{{-- Hero / Cover --}}
<div style="position:relative;width:100%;background:#0d0a04;overflow:hidden;min-height:420px;">
    @if($news->cover_image)
        <img src="{{ Storage::url($news->cover_image) }}" alt="{{ $news->title }}"
             style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.3;">
    @else
        <div style="position:absolute;inset:0;{{ $meta['grad'] }};opacity:.7;"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <span style="font-size:6rem;opacity:.15;">{{ $meta['icon'] }}</span>
        </div>
    @endif
    <div style="position:absolute;inset:0;background:linear-gradient(to top,#0d0a04 0%,rgba(13,10,4,.65) 50%,transparent 100%);"></div>

    <div style="position:relative;max-width:56rem;margin:0 auto;padding:4rem 1.5rem 3.5rem;display:flex;flex-direction:column;justify-content:flex-end;min-height:420px;">
        {{-- Breadcrumb --}}
        <div style="display:flex;align-items:center;gap:.5rem;color:rgba(240,230,200,.5);font-size:.75rem;margin-bottom:1.5rem;">
            <a href="{{ route('home') }}" style="color:rgba(240,230,200,.5);text-decoration:none;">Home</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" style="color:rgba(240,230,200,.5);text-decoration:none;">News & Media</a>
            <span>/</span>
            <span style="color:rgba(240,230,200,.3);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:12rem;">{{ $news->title }}</span>
        </div>

        {{-- Category + Type badges --}}
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:.5rem;margin-bottom:1rem;">
            <span style="font-size:.75rem;font-weight:700;padding:.375rem .75rem;border-radius:9999px;background:rgba(212,146,15,.12);color:#d4920f;border:1px solid rgba(212,146,15,.25);">
                {{ $meta['icon'] }} {{ $news->category }}
            </span>
            @if($news->type === 'press_release')
            <span style="font-size:.75rem;font-weight:600;background:rgba(240,230,200,.08);color:#f0e6c8;border:1px solid rgba(240,230,200,.15);padding:.375rem .75rem;border-radius:9999px;">
                Press Release
            </span>
            @endif
            @if($news->is_featured)
            <span style="font-size:.75rem;font-weight:600;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;padding:.375rem .75rem;border-radius:9999px;">
                ⭐ Featured
            </span>
            @endif
        </div>

        <h1 style="font-size:clamp(1.75rem,4vw,3rem);font-weight:800;color:#f0e6c8;line-height:1.2;margin-bottom:1.25rem;max-width:48rem;">
            {{ $news->title }}
        </h1>

        @if($news->summary)
        <p style="color:rgba(240,230,200,.6);font-size:1.125rem;line-height:1.7;max-width:40rem;margin-bottom:1.5rem;">{{ $news->summary }}</p>
        @endif

        {{-- Meta row --}}
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:1rem;font-size:.875rem;color:rgba(240,230,200,.5);">
            <div style="display:flex;align-items:center;gap:.5rem;">
                <div style="width:2rem;height:2rem;background:rgba(212,146,15,.2);border-radius:9999px;display:flex;align-items:center;justify-content:center;">
                    <span style="color:#d4920f;font-weight:700;font-size:.75rem;">{{ substr($news->author ?? 'V', 0, 1) }}</span>
                </div>
                <span style="color:rgba(240,230,200,.8);font-weight:500;">{{ $news->author ?? 'VentureMatch' }}</span>
            </div>
            <span style="color:rgba(240,230,200,.2);">·</span>
            <div style="display:flex;align-items:center;gap:.375rem;">
                <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $news->published_at?->format('F d, Y') }}
            </div>
            @if($news->tags && count($news->tags))
            <span style="color:rgba(240,230,200,.2);">·</span>
            <div style="display:flex;flex-wrap:wrap;gap:.375rem;">
                @foreach(array_slice($news->tags, 0, 3) as $tag)
                <span style="background:rgba(212,146,15,.1);color:rgba(240,230,200,.6);font-size:.75rem;padding:.125rem .5rem;border-radius:9999px;border:1px solid rgba(212,146,15,.15);">{{ $tag }}</span>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Article Body --}}
<div style="background:#0d0a04;">
    <div style="max-width:80rem;margin:0 auto;padding:3.5rem 1.5rem;">
        <div style="display:grid;grid-template-columns:1fr 300px;gap:3rem;align-items:start;">

            {{-- Main Content --}}
            <article>
                <div style="color:#9a8a6a;line-height:1.8;font-size:1rem;">
                    {!! $news->body !!}
                </div>

                {{-- Tags --}}
                @if($news->tags && count($news->tags))
                <div style="margin-top:2.5rem;padding-top:2rem;border-top:1px solid rgba(212,146,15,.1);">
                    <p style="font-size:.75rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.1em;margin-bottom:.75rem;">Tags</p>
                    <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
                        @foreach($news->tags as $tag)
                        <span style="background:rgba(212,146,15,.08);color:#9a8a6a;font-size:.75rem;font-weight:500;padding:.375rem .75rem;border-radius:9999px;border:1px solid rgba(212,146,15,.15);">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div style="margin-top:2rem;padding-top:2rem;border-top:1px solid rgba(212,146,15,.1);display:flex;align-items:center;gap:1rem;">
                    <p style="font-size:.875rem;font-weight:600;color:#9a8a6a;">Share this article:</p>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                       target="_blank"
                       style="width:2.25rem;height:2.25rem;background:#0a66c2;border-radius:.5rem;display:flex;align-items:center;justify-content:center;text-decoration:none;">
                        <svg style="width:1rem;height:1rem;color:#fff;" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}"
                       target="_blank"
                       style="width:2.25rem;height:2.25rem;background:#0ea5e9;border-radius:.5rem;display:flex;align-items:center;justify-content:center;text-decoration:none;">
                        <svg style="width:1rem;height:1rem;color:#fff;" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>

                {{-- Author Card --}}
                <div style="margin-top:2.5rem;background:#1a1408;border-radius:1.25rem;padding:1.5rem;border:1px solid rgba(212,146,15,.15);display:flex;align-items:flex-start;gap:1rem;">
                    <div style="width:3.5rem;height:3.5rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <span style="color:#0d0a04;font-weight:800;font-size:1.25rem;">{{ substr($news->author ?? 'V', 0, 1) }}</span>
                    </div>
                    <div>
                        <p style="font-weight:700;color:#f0e6c8;">{{ $news->author ?? 'VentureMatch Editorial' }}</p>
                        <p style="font-size:.875rem;color:#d4920f;font-weight:500;">VentureMatch</p>
                        <p style="font-size:.875rem;color:#7a6a4a;margin-top:.25rem;line-height:1.6;">
                            Covering investment trends, startup ecosystem news, and platform updates for the VentureMatch community.
                        </p>
                    </div>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside style="position:sticky;top:calc(50vh - 160px);align-self:start;">
                {{-- Article Info Card --}}
                <div style="background:#1a1408;border-radius:1.25rem;padding:1.5rem;border:1px solid rgba(212,146,15,.15);">
                    <h3 style="font-size:.75rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.1em;margin-bottom:1rem;">Article Info</h3>
                    <div style="display:flex;flex-direction:column;gap:.75rem;font-size:.875rem;">
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <span style="color:#7a6a4a;">Category</span>
                            <span style="font-weight:600;color:#f0e6c8;">{{ $news->category }}</span>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <span style="color:#7a6a4a;">Published</span>
                            <span style="font-weight:600;color:#f0e6c8;">{{ $news->published_at?->format('M d, Y') }}</span>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <span style="color:#7a6a4a;">Author</span>
                            <span style="font-weight:600;color:#f0e6c8;max-width:8rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $news->author }}</span>
                        </div>
                        @if($news->type !== 'news')
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <span style="color:#7a6a4a;">Type</span>
                            <span style="font-weight:600;color:#f0e6c8;">{{ ucfirst(str_replace('_', ' ', $news->type)) }}</span>
                        </div>
                        @endif
                    </div>

                    <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid rgba(212,146,15,.1);display:flex;flex-direction:column;gap:.5rem;">
                        <a href="{{ route('news.index') }}"
                           style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#d4920f;font-weight:600;text-decoration:none;">
                            <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Back to News
                        </a>
                        <a href="{{ route('notices.index') }}"
                           style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#7a6a4a;text-decoration:none;">
                            <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
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
<section style="padding:4rem 0;background:#0d0a04;border-top:1px solid rgba(212,146,15,.1);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2.5rem;">
            <div>
                <span style="font-size:.75rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">Keep Reading</span>
                <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;margin-top:.25rem;">Related Articles</h2>
            </div>
            <a href="{{ route('news.index') }}" style="font-size:.875rem;color:#d4920f;font-weight:600;text-decoration:none;">View all →</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
            @foreach($related as $r)
            @php
                $rMeta = $catMeta[$r->category] ?? ['grad' => 'linear-gradient(135deg,#d4920f,#b8780a)', 'icon' => '📰'];
            @endphp
            <a href="{{ route('news.show', $r->slug) }}"
               style="background:#1a1408;border-radius:1.25rem;border:1px solid rgba(212,146,15,.15);overflow:hidden;text-decoration:none;display:flex;flex-direction:column;">
                @if($r->cover_image)
                    <div style="overflow:hidden;height:11rem;">
                        <img src="{{ Storage::url($r->cover_image) }}" alt="{{ $r->title }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    </div>
                @else
                    <div style="height:11rem;background:{{ $rMeta['grad'] }};display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                        <span style="font-size:3rem;opacity:.5;">{{ $rMeta['icon'] }}</span>
                    </div>
                @endif

                <div style="padding:1.25rem;display:flex;flex-direction:column;flex:1;">
                    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;">
                        <span style="font-size:.75rem;font-weight:700;padding:.25rem .625rem;border-radius:9999px;background:rgba(212,146,15,.12);color:#d4920f;border:1px solid rgba(212,146,15,.2);">
                            {{ $r->category }}
                        </span>
                    </div>
                    <h3 style="font-weight:700;color:#f0e6c8;line-height:1.4;flex:1;margin-bottom:.75rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                        {{ $r->title }}
                    </h3>
                    @if($r->summary)
                    <p style="font-size:.875rem;color:#7a6a4a;margin-bottom:1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $r->summary }}</p>
                    @endif
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid rgba(212,146,15,.1);margin-top:auto;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <div style="width:1.5rem;height:1.5rem;background:rgba(212,146,15,.15);border-radius:9999px;display:flex;align-items:center;justify-content:center;">
                                <span style="color:#d4920f;font-weight:700;font-size:.625rem;">{{ substr($r->author ?? 'V', 0, 1) }}</span>
                            </div>
                            <span style="font-size:.75rem;color:#7a6a4a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:6rem;">{{ $r->author }}</span>
                        </div>
                        <span style="font-size:.75rem;color:#7a6a4a;">{{ $r->published_at?->format('M d, Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
