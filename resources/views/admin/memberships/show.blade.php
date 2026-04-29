@extends('layouts.admin')
@section('title', 'Review Membership')
@section('page-title', 'Review Membership Application')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-base font-bold text-gray-900 mb-4">Applicant: {{ $membership->user->name }}</h3>
        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div><span class="text-gray-500">Plan:</span> <strong class="text-gray-800">{{ $membership->plan->name }}</strong></div>
            <div><span class="text-gray-500">Status:</span> <strong class="text-gray-800">{{ ucfirst(str_replace('_', ' ', $membership->status)) }}</strong></div>
            <div><span class="text-gray-500">Applied:</span> <span class="text-gray-700">{{ $membership->created_at->format('M d, Y') }}</span></div>
        </div>

        @if($membership->application_data)
        <div class="bg-gray-50 rounded-lg p-4 text-sm mb-4 border border-gray-100">
            <h4 class="font-semibold text-gray-700 mb-2">Application Data</h4>
            @foreach($membership->application_data as $key => $val)
                @if($val)
                <div class="mb-1"><span class="text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}:</span> <span class="text-gray-800">{{ $val }}</span></div>
                @endif
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.memberships.status', $membership) }}" class="flex flex-col gap-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Update Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    @foreach(['approved', 'rejected', 'under_review', 'revision_required'] as $s)
                        <option value="{{ $s }}" {{ $membership->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Admin Notes</label>
                <textarea name="admin_notes" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">{{ $membership->admin_notes }}</textarea>
            </div>
            <div>
                <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg text-sm transition-colors">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
