@if ($paginator->hasPages())
<div style="display:flex;align-items:center;justify-content:space-between;margin-top:1.5rem;">
    @if ($paginator->onFirstPage())
        <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;background:rgba(255,255,255,.04);color:#4a3a22;border:1px solid rgba(212,146,15,.1);cursor:not-allowed;">← Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(212,146,15,.08);color:#d4920f;border:1px solid rgba(212,146,15,.2);text-decoration:none;">← Previous</a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:rgba(212,146,15,.08);color:#d4920f;border:1px solid rgba(212,146,15,.2);text-decoration:none;">Next →</a>
    @else
        <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;background:rgba(255,255,255,.04);color:#4a3a22;border:1px solid rgba(212,146,15,.1);cursor:not-allowed;">Next →</span>
    @endif
</div>
@endif
