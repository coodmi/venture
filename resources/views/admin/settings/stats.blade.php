@extends('layouts.admin')
@section('title', 'Platform Stats')
@section('page-title', 'Platform Statistics')

@section('content')
<div class="w-full">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.stats.update') }}" style="display:flex;flex-direction:column;gap:1rem;">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($stats as $stat)
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label</label>
                        <input type="text" name="stats[{{ $stat->id }}][label]" value="{{ $stat->label }}"
                               style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                    </div>
                    <div class="w-32">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                        <input type="text" name="stats[{{ $stat->id }}][value]" value="{{ $stat->value }}"
                               style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                    </div>
                </div>
                @endforeach
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">Update Stats</button>
        </form>
    </div>
</div>
@endsection
