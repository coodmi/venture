@if ($paginator->hasPages())
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-top:1.5rem;">
    <p style="font-size:.8125rem;color:#6b5c3e;margin:0;">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </p>
    <div style="display:flex;align-items:center;gap:.375rem;">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(255,255,255,.04);color:#4a3a22;border:1px solid rgba(212,146,15,.1);cursor:not-allowed;">← Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(212,146,15,.08);color:#d4920f;border:1px solid rgba(212,146,15,.2);text-decoration:none;" onmouseover="this.style.background='rgba(212,146,15,.18)';" onmouseout="this.style.background='rgba(212,146,15,.08)';">← Prev</a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding:.4rem .5rem;font-size:.8125rem;color:#4a3a22;">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding:.4rem .75rem;border-radius:.5rem;font-size:.8125rem;font-weight:700;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;border:1px solid transparent;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding:.4rem .75rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(255,255,255,.04);color:#9a8a6a;border:1px solid rgba(212,146,15,.1);text-decoration:none;" onmouseover="this.style.background='rgba(212,146,15,.1)';this.style.color='#d4920f';" onmouseout="this.style.background='rgba(255,255,255,.04)';this.style.color='#9a8a6a';">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(212,146,15,.08);color:#d4920f;border:1px solid rgba(212,146,15,.2);text-decoration:none;" onmouseover="this.style.background='rgba(212,146,15,.18)';" onmouseout="this.style.background='rgba(212,146,15,.08)';">Next →</a>
        @else
            <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(255,255,255,.04);color:#4a3a22;border:1px solid rgba(212,146,15,.1);cursor:not-allowed;">Next →</span>
        @endif
    </div>
</div>
@endif
