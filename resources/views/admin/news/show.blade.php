@extends('layouts.admin')
@section('title', $news->title)
@section('page-title', 'Article Details')

@section('content')
<div class="max-w-3xl bg-white rounded-xl border border-gray-200 p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $news->title }}</h2>
    <p class="text-sm text-gray-400 mb-4">{{ $news->type }} · {{ $news->status }} · {{ $news->published_at?->format('M d, Y') }}</p>
    <div class="prose prose-gray max-w-none">{!! $news->body !!}</div>
    <div class="mt-6 flex gap-3">
        <a href="{{ route('admin.news.edit', $news) }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">Edit</a>
        <a href="{{ route('admin.news.index') }}" style="color:#d4920f;text-decoration:none;font-weight:600;font-size:.8125rem;">Back</a>
    </div>
</div>
@endsection
