@extends('layouts.admin')
@section('title', 'Platform Stats')
@section('page-title', 'Platform Statistics')

@section('content')
<div class="w-full">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.stats.update') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($stats as $stat)
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label</label>
                        <input type="text" name="stats[{{ $stat->id }}][label]" value="{{ $stat->label }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div class="w-32">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                        <input type="text" name="stats[{{ $stat->id }}][value]" value="{{ $stat->value }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>
                @endforeach
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">Update Stats</button>
        </form>
    </div>
</div>
@endsection
