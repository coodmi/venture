@extends('layouts.admin')
@section('title', 'News & Media')
@section('page-title', 'News & Media')

@section('content')
<div style="display:flex;flex-direction:column;gap:1rem;">

    {{-- Toolbar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
        <form method="GET" style="display:flex;gap:.625rem;flex-wrap:wrap;align-items:center;">
            <select name="type" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;cursor:pointer;">
                <option value="">All Types</option>
                @foreach(['news', 'notice', 'press_release', 'newsletter'] as $t)
                    <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $t)) }}</option>
                @endforeach
            </select>
            <select name="status" style="background:#fff;border:1px solid #e5e7eb;color:#374151;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;cursor:pointer;">
                <option value="">All Status</option>
                @foreach(['draft', 'published', 'archived'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit"
                    style="background:#6366f1;color:#fff;font-size:.875rem;font-weight:600;padding:.5rem 1rem;border-radius:.5rem;border:none;cursor:pointer;display:flex;align-items:center;gap:.375rem;transition:background .15s;"
                    onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                Filter
            </button>
        </form>
        <a href="{{ route('admin.news.create') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
           onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
           onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Article
        </a>
    </div>

    {{-- Table Card --}}
    <div style="background:#fff;border-radius:.875rem;border:1px solid #e5e7eb;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
            <thead style="background:#f8fafc;">
                <tr>
                    @foreach(['Title','Type','Status','Published','Actions'] as $h)
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($news as $article)
                <tr style="border-bottom:1px solid #f9fafb;transition:background .1s;"
                    onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='transparent';">
                    <td style="padding:.75rem 1rem;font-weight:600;color:#111827;max-width:20rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $article->title }}</td>
                    <td style="padding:.75rem 1rem;">
                        <span style="background:#f3f4f6;color:#374151;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ ucfirst(str_replace('_', ' ', $article->type)) }}</span>
                    </td>
                    <td style="padding:.75rem 1rem;">
                        <span style="font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;
                            {{ $article->status === 'published' ? 'background:#ecfdf5;color:#059669;' :
                               ($article->status === 'archived' ? 'background:#f3f4f6;color:#6b7280;' : 'background:#fff7ed;color:#d97706;') }}">
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>
                    <td style="padding:.75rem 1rem;color:#9ca3af;font-size:.8125rem;">{{ $article->published_at?->format('M d, Y') ?? '—' }}</td>
                    <td style="padding:.75rem 1rem;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <a href="{{ route('admin.news.edit', $article) }}"
                               style="display:inline-flex;align-items:center;gap:.25rem;color:#6b7280;text-decoration:none;font-size:.8125rem;font-weight:600;padding:.25rem .625rem;background:#f3f4f6;border-radius:.375rem;transition:background .15s;"
                               onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">
                                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.news.destroy', $article) }}" onsubmit="return confirm('Delete this article?')" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="display:inline-flex;align-items:center;gap:.25rem;color:#dc2626;font-size:.8125rem;font-weight:600;padding:.25rem .625rem;background:#fef2f2;border-radius:.375rem;border:none;cursor:pointer;transition:background .15s;"
                                        onmouseover="this.style.background='#fee2e2';" onmouseout="this.style.background='#fef2f2';">
                                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">{{ $news->links() }}</div>
    </div>
</div>
@endsection
