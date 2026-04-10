@extends('layouts.app')
@section('title', 'News & Media')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0d0a04,#1a1208,#241c0a);padding:5rem 1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-5rem;right:-5rem;width:25rem;height:25rem;background:rgba(212,146,15,.07);border-radius:50%;filter:blur(60px);"></div>
    <div style="max-width:80rem;margin:0 auto;position:relative;">
        <span style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.5rem;">
            <span style="width:.375rem;height:.375rem;background:#f59e0b;border-radius:50%;display:inline-block;"></span>
            News & Media
        </span>
        <h1 style="font-size:clamp(2.5rem,6vw,3.75rem);font-weight:800;line-height:1.1;margin:0 0 1.25rem;color:#fff;letter-spacing:-.03em;">
            Ecosystem <span style="color:#d4920f;">Intelligence</span>
        </h1>
        <p style="font-size:1.125rem;color:rgba(212,146,15,.6);max-width:32rem;line-height:1.7;margin:0 0 2rem;">
            Deal news, market insights, startup spotlights, and platform updates from the VentureMatch ecosystem.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
            @php $cats=['All','Deal News','Market Insights','Startup Spotlight','Platform Update','Founder Resources','Event Recap','Press Release']; @endphp
            @foreach($cats as $cat)
            <a href="{{ $cat==='All' ? route('news.index') : route('news.index',['category'=>$cat]) }}"
               style="padding:.4rem 1rem;border-radius:.625rem;font-size:.78rem;font-weight:600;text-decoration:none;{{ (request('category')===$cat||($cat==='All'&&!request('category'))) ? 'background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;' : 'background:rgba(255,255,255,.07);color:rgba(255,255,255,.65);border:1px solid rgba(212,146,15,.18);' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- Featured Article --}}
@php $featured = $news->firstWhere('is_featured', true) ?? $news->first(); @endphp
@if($featured)
@php $featGrads=['Deal News'=>'linear-gradient(135deg,#1d4ed8,#3b82f6)','Market Insights'=>'linear-gradient(135deg,#7c3aed,#a78bfa)','Startup Spotlight'=>'linear-gradient(135deg,#db2777,#f472b6)','Platform Update'=>'linear-gradient(135deg,#059669,#34d399)','Press Release'=>'linear-gradient(135deg,#374151,#6b7280)','Founder Resources'=>'linear-gradient(135deg,#d97706,#fbbf24)','Event Recap'=>'linear-gradient(135deg,#dc2626,#f97316)']; @endphp
<div style="background:#110e05;padding:3rem 1.5rem;border-bottom:1px solid rgba(212,146,15,.1);">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:1.25rem;">
            <span style="width:.25rem;height:1.25rem;background:#d4920f;border-radius:9999px;display:inline-block;"></span>
            <span style="font-size:.7rem;font-weight:700;color:rgba(212,146,15,.6);text-transform:uppercase;letter-spacing:.1em;">Featured Story</span>
        </div>
        <a href="{{ route('news.show', $featured->slug) }}" style="text-decoration:none;display:grid;grid-template-columns:3fr 2fr;background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1.5rem;overflow:hidden;transition:all .25s;" onmouseover="this.style.boxShadow='0 16px 40px rgba(0,0,0,.5)';this.style.borderColor='rgba(212,146,15,.35)';" onmouseout="this.style.boxShadow='none';this.style.borderColor='rgba(212,146,15,.15)';">
            <div style="position:relative;min-height:18rem;overflow:hidden;">
                @if($featured->cover_image)
                    <img src="{{ Storage::url($featured->cover_image) }}" alt="{{ $featured->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                @else
                    <div style="width:100%;height:100%;min-height:18rem;background:{{ $featGrads[$featured->category] ?? 'linear-gradient(135deg,#1d4ed8,#3b82f6)' }};display:flex;align-items:center;justify-content:center;">
                        <svg width="64" height="64" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                @endif
            </div>
            <div style="padding:2.5rem;display:flex;flex-direction:column;justify-content:center;">
                <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:1rem;">
                    <span style="background:rgba(212,146,15,.15);color:#d4920f;font-size:.7rem;font-weight:700;padding:.25rem .75rem;border-radius:9999px;">{{ $featured->category }}</span>
                    <span style="font-size:.75rem;color:#6b5c3e;">{{ $featured->published_at?->format('M d, Y') }}</span>
                </div>
                <h2 style="font-size:1.5rem;font-weight:800;color:#f0e6c8;line-height:1.3;margin:0 0 1rem;">{{ $featured->title }}</h2>
                <p style="color:#7a6a4a;line-height:1.7;margin:0 0 1.5rem;font-size:.9rem;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $featured->summary }}</p>
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <div style="width:1.75rem;height:1.75rem;background:rgba(212,146,15,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <span style="color:#d4920f;font-weight:700;font-size:.75rem;">{{ substr($featured->author??'V',0,1) }}</span>
                        </div>
                        <span style="font-size:.8125rem;color:#7a6a4a;">{{ $featured->author }}</span>
                    </div>
                    <span style="font-size:.8125rem;color:#d4920f;font-weight:600;">Read More →</span>
                </div>
            </div>
        </a>
    </div>
</div>
@endif

{{-- All Articles --}}
<div style="background:#0d0a04;padding:4rem 1.5rem;">
    <div style="max-width:80rem;margin:0 auto;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span style="font-size:.7rem;font-weight:700;color:#d4920f;text-transform:uppercase;letter-spacing:.1em;">Latest</span>
                <h2 style="font-size:2rem;font-weight:800;color:#f0e6c8;margin:.5rem 0 0;">All Articles</h2>
            </div>
            <a href="{{ route('notices.index') }}" style="font-size:.875rem;color:#d4920f;font-weight:600;text-decoration:none;">View Notices →</a>
        </div>

        @php $catGrads=['Deal News'=>'linear-gradient(135deg,#1d4ed8,#3b82f6)','Market Insights'=>'linear-gradient(135deg,#7c3aed,#a78bfa)','Startup Spotlight'=>'linear-gradient(135deg,#db2777,#f472b6)','Platform Update'=>'linear-gradient(135deg,#059669,#34d399)','Press Release'=>'linear-gradient(135deg,#374151,#6b7280)','Founder Resources'=>'linear-gradient(135deg,#d97706,#fbbf24)','Event Recap'=>'linear-gradient(135deg,#dc2626,#f97316)','System Notice'=>'linear-gradient(135deg,#475569,#64748b)']; @endphp

        @forelse($news as $article)
        @if($loop->first)<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">@endif

        <a href="{{ route('news.show', $article->slug) }}" style="text-decoration:none;background:#1a1408;border:1px solid rgba(212,146,15,.12);border-radius:1.25rem;overflow:hidden;display:flex;flex-direction:column;transition:all .25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(0,0,0,.4)';this.style.transform='translateY(-3px)';this.style.borderColor='rgba(212,146,15,.3)';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='rgba(212,146,15,.12)';">
            @if($article->cover_image)
                <div style="position:relative;height:11rem;overflow:hidden;">
                    <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                    @if($article->is_featured)<div style="position:absolute;top:.75rem;right:.75rem;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.68rem;font-weight:700;padding:.2rem .6rem;border-radius:9999px;">⭐ Featured</div>@endif
                </div>
            @else
                <div style="position:relative;height:11rem;background:{{ $catGrads[$article->category] ?? 'linear-gradient(135deg,#1d4ed8,#3b82f6)' }};display:flex;align-items:center;justify-content:center;">
                    <svg width="40" height="40" fill="none" stroke="rgba(255,255,255,.35)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @if($article->is_featured)<div style="position:absolute;top:.75rem;right:.75rem;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.68rem;font-weight:700;padding:.2rem .6rem;border-radius:9999px;">⭐ Featured</div>@endif
                </div>
            @endif
            <div style="padding:1.25rem;flex:1;display:flex;flex-direction:column;">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;flex-wrap:wrap;">
                    <span style="font-size:.68rem;font-weight:700;background:rgba(212,146,15,.12);color:#d4920f;padding:.2rem .6rem;border-radius:9999px;">{{ $article->category }}</span>
                </div>
                <h3 style="font-weight:700;color:#f0e6c8;margin:0 0 .5rem;line-height:1.4;font-size:.9375rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $article->title }}</h3>
                <p style="font-size:.78rem;color:#7a6a4a;line-height:1.5;margin:0 0 1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $article->summary }}</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:.75rem;border-top:1px solid rgba(212,146,15,.08);margin-top:auto;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <div style="width:1.5rem;height:1.5rem;background:rgba(212,146,15,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span style="color:#d4920f;font-weight:700;font-size:.65rem;">{{ substr($article->author??'V',0,1) }}</span>
                        </div>
                        <span style="font-size:.72rem;color:#6b5c3e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:8rem;">{{ $article->author }}</span>
                    </div>
                    <span style="font-size:.72rem;color:#6b5c3e;flex-shrink:0;">{{ $article->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
        </a>

        @if($loop->last)</div>@endif
        @empty
        <div style="text-align:center;padding:5rem 0;color:#6b5c3e;">
            <div style="font-size:3rem;margin-bottom:1rem;">📰</div>
            <p style="font-size:1.125rem;font-weight:500;color:#9a8a6a;">No articles yet.</p>
        </div>
        @endforelse

        <div style="margin-top:2.5rem;">{{ $news->withQueryString()->links() }}</div>
    </div>
</div>

{{-- Newsletter CTA --}}
<div style="background:linear-gradient(135deg,#1a1208,#241c0a);padding:4rem 1.5rem;text-align:center;">
    <div style="max-width:40rem;margin:0 auto;">
        <span style="display:inline-block;background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.25);color:rgba(212,146,15,.8);font-size:.75rem;font-weight:600;padding:.375rem 1rem;border-radius:9999px;margin-bottom:1.25rem;">Stay Informed</span>
        <h2 style="font-size:2rem;font-weight:800;color:#fff;margin:0 0 .75rem;">Get the Latest in Your Inbox</h2>
        <p style="color:rgba(212,146,15,.55);font-size:1rem;margin:0 0 2rem;line-height:1.6;">Deal news, market reports, startup spotlights, and event invitations — delivered weekly.</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;gap:.625rem;max-width:28rem;margin:0 auto;">
            @csrf
            <input type="email" name="email" placeholder="your@email.com" required style="flex:1;background:rgba(255,255,255,.06);border:1px solid rgba(212,146,15,.25);color:#fff;font-size:.875rem;border-radius:.625rem;padding:.625rem 1rem;outline:none;">
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;white-space:nowrap;">Subscribe</button>
        </form>
    </div>
</div>

@endsection
