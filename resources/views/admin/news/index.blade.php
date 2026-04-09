@extends('layouts.admin')
@section('title', 'News & Media')
@section('page-title', 'News & Media')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <form method="GET" class="flex gap-3">
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

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Published</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($news as $article)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ $article->title }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ ucfirst(str_replace('_', ' ', $article->type)) }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-400">{{ $article->published_at?->format('M d, Y') ?? '—' }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.news.edit', $article) }}" class="text-primary-600 hover:underline text-xs">Edit</a>
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
