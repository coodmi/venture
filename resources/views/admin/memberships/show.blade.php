@extends('layouts.admin')
@section('title', 'Review Membership')
@section('page-title', 'Review Membership Application')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Applicant: {{ $membership->user->name }}</h3>
        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div><span class="text-gray-500">Plan:</span> <strong>{{ $membership->plan->name }}</strong></div>
            <div><span class="text-gray-500">Status:</span> {{ ucfirst(str_replace('_', ' ', $membership->status)) }}</div>
            <div><span class="text-gray-500">Applied:</span> {{ $membership->created_at->format('M d, Y') }}</div>
        </div>

        @if($membership->application_data)
        <div class="bg-gray-50 rounded-lg p-4 text-sm mb-4">
            <h4 class="font-medium text-gray-700 mb-2">Application Data</h4>
            @foreach($membership->application_data as $key => $val)
                @if($val)
                <div class="mb-1"><span class="text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}:</span> {{ $val }}</div>
                @endif
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.memberships.status', $membership) }}" class="space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    @foreach(['approved', 'rejected', 'under_review', 'revision_required'] as $s)
                        <option value="{{ $s }}" {{ $membership->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                <textarea name="admin_notes" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">{{ $membership->admin_notes }}</textarea>
            </div>
            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                Update Status
            </button>
        </form>
    </div>
</div>
@endsection
