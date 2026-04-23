@if ($paginator->hasPages())
<div style="display:flex;align-items:center;justify-content:space-between;margin-top:1.5rem;">
    @if ($paginator->onFirstPage())
        <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;background:#f1f5f9;color:#cbd5e1;border:1px solid #e2e8f0;cursor:not-allowed;">← Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#eff6ff;color:#1a3c8f;border:1px solid #bfdbfe;text-decoration:none;">← Previous</a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;font-weight:500;background:#eff6ff;color:#1a3c8f;border:1px solid #bfdbfe;text-decoration:none;">Next →</a>
    @else
        <span style="padding:.4rem .875rem;border-radius:.5rem;font-size:.8125rem;background:#f1f5f9;color:#cbd5e1;border:1px solid #e2e8f0;cursor:not-allowed;">Next →</span>
    @endif
</div>
@endif
