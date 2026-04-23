@if ($paginator->hasPages())
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-top:1.5rem;">
    <p style="font-size:.8125rem;color:#8d98a1;margin:0;">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </p>
    <div style="display:flex;align-items:center;gap:.375rem;">
        @if ($paginator->onFirstPage())
            <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#f1f5f9;color:#cbd5e1;border:1px solid #e2e8f0;cursor:not-allowed;">← Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#eff6ff;color:#1a3c8f;border:1px solid #bfdbfe;text-decoration:none;" onmouseover="this.style.background='#dbeafe';" onmouseout="this.style.background='#eff6ff';">← Prev</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding:.4rem .5rem;font-size:.8125rem;color:#8d98a1;">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding:.4rem .75rem;border-radius:.5rem;font-size:.8125rem;font-weight:700;background:#1a3c8f;color:#fff;border:1px solid transparent;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding:.4rem .75rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#fff;color:#8d98a1;border:1px solid #e2e8f0;text-decoration:none;" onmouseover="this.style.background='#eff6ff';this.style.color='#1a3c8f';" onmouseout="this.style.background='#fff';this.style.color='#8d98a1';">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#eff6ff;color:#1a3c8f;border:1px solid #bfdbfe;text-decoration:none;" onmouseover="this.style.background='#dbeafe';" onmouseout="this.style.background='#eff6ff';">Next →</a>
        @else
            <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#f1f5f9;color:#cbd5e1;border:1px solid #e2e8f0;cursor:not-allowed;">Next →</span>
        @endif
    </div>
</div>
@endif
