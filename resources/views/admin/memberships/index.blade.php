@extends('layouts.admin')
@section('title', 'Memberships')
@section('page-title', 'Membership Applications')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200">
        <form method="GET" class="flex gap-3">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">All Status</option>
                @foreach(['submitted', 'under_review', 'approved', 'rejected', 'revision_required'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary-600 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
            <a href="{{ route('admin.memberships.plans') }}" class="border border-gray-300 text-gray-700 text-sm px-4 py-2 rounded-lg hover:bg-gray-50">Manage Plans</a>
        </form>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Applicant</th>
                <th class="px-4 py-3 text-left">Plan</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Applied</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($memberships as $m)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    <p class="font-medium text-gray-900">{{ $m->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $m->user->email }}</p>
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $m->plan->name }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $m->status === 'approved' ? 'bg-green-100 text-green-700' :
                           ($m->status === 'rejected' ? 'bg-red-100 text-red-700' :
                           ($m->status === 'revision_required' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700')) }}">
                        {{ ucfirst(str_replace('_', ' ', $m->status)) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $m->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.memberships.show', $m) }}" class="text-primary-600 hover:underline text-xs">Review</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $memberships->links() }}</div>
</div>
@endsection
