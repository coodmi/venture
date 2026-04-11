@extends('layouts.admin')
@section('title', 'News & Media')
@section('page-title', 'News & Media')

@section('content')
<div style="display:flex;flex-direction:column;gap:1rem;">
    <div class="flex justify-between items-center">
        <form method="GET" style="display:flex;gap:.75rem;">
            <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">All Types</option>
                @foreach(['news', 'notice', 'press_release', 'newsletter'] as $t)
                    <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $t)) }}</option>
                @endforeach
            </select>
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">All Status</option>
                @foreach(['draft', 'published', 'archived'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
        </form>
        <a href="{{ route('admin.news.create') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">+ Add Article</a>
    </div>

    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
        <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
            <thead style="background:#110e05;" style="background:#110e05;">
                <tr>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Title</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Type</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Status</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Published</th>
                    <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#7a6a4a;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid rgba(212,146,15,.12);">Actions</th>
                </tr>
            </thead>
            <tbody >
                @foreach($news as $article)
                <tr onmouseover="this.style.background='rgba(212,146,15,.04)';" onmouseout="this.style.background='transparent';">
                    <td style="padding:.75rem 1rem;font-weight:600;color:#f0e6c8;max-width:16rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;border-bottom:1px solid rgba(212,146,15,.06);">{{ $article->title }}</td>
                    <td style="padding:.75rem 1rem;color:#7a6a4a;border-bottom:1px solid rgba(212,146,15,.06);">{{ ucfirst(str_replace('_', ' ', $article->type)) }}</td>
                    <td style="padding:.75rem 1rem;border-bottom:1px solid rgba(212,146,15,.06);">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-400">{{ $article->published_at?->format('M d, Y') ?? '—' }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.news.edit', $article) }}" style="color:#d4920f;text-decoration:none;font-size:.75rem;font-weight:600;">Edit</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $article) }}" onsubmit="return confirm('Delete this article?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $news->links() }}</div>
    </div>
</div>
@endsection
