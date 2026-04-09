@extends('layouts.admin')
@section('title', 'Opportunities')
@section('page-title', 'Opportunity Management')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200">
        <form method="GET" class="flex gap-3">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                <option value="">All Status</option>
                @foreach(['draft', 'submitted', 'under_review', 'approved', 'rejected', 'archived'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                @endforeach
            </select>
            <select name="sector" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                <option value="">All Sectors</option>
                @foreach(['Technology', 'FinTech', 'HealthTech', 'EdTech', 'AgriTech', 'CleanTech', 'E-Commerce', 'Real Estate', 'Manufacturing', 'Logistics', 'Media', 'Other'] as $s)
                    <option value="{{ $s }}" {{ request('sector') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
        </form>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Title</th>
                <th class="px-4 py-3 text-left">Seeker</th>
                <th class="px-4 py-3 text-left">Sector</th>
                <th class="px-4 py-3 text-left">Ask</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Flags</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($opportunities as $opp)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ $opp->title }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $opp->user->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $opp->sector }}</td>
                <td class="px-4 py-3 font-medium text-primary-700">${{ number_format($opp->ask_amount) }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $opp->status === 'approved' ? 'bg-green-100 text-green-700' :
                           ($opp->status === 'submitted' ? 'bg-amber-100 text-amber-700' :
                           ($opp->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600')) }}">
                        {{ ucfirst(str_replace('_', ' ', $opp->status)) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    @if($opp->is_hot_deal)<span class="text-xs">🔥</span>@endif
                    @if($opp->is_featured)<span class="text-xs">⭐</span>@endif
                </td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.opportunities.show', $opp) }}" class="text-primary-600 hover:underline text-xs">Review</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $opportunities->links() }}</div>
</div>
@endsection
