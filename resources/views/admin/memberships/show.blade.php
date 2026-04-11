@extends('layouts.admin')
@section('title', 'Review Membership')
@section('page-title', 'Review Membership Application')

@section('content')
<div class="max-w-2xl space-y-6">
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-6">
        <h3 style="font-weight:700;color:#f0e6c8;margin-bottom:1rem;">Applicant: {{ $membership->user->name }}</h3>
        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            <div><span style="color:#7a6a4a;">Plan:</span> <strong>{{ $membership->plan->name }}</strong></div>
            <div><span style="color:#7a6a4a;">Status:</span> {{ ucfirst(str_replace('_', ' ', $membership->status)) }}</div>
            <div><span style="color:#7a6a4a;">Applied:</span> {{ $membership->created_at->format('M d, Y') }}</div>
        </div>

        @if($membership->application_data)
        <div style="background:#110e05;" class=" rounded-lg p-4 text-sm mb-4">
            <h4 class="font-medium text-gray-700 mb-2">Application Data</h4>
            @foreach($membership->application_data as $key => $val)
                @if($val)
                <div class="mb-1"><span class="text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}:</span> {{ $val }}</div>
                @endif
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.memberships.status', $membership) }}" style="display:flex;flex-direction:column;gap:1rem;">
            @csrf @method('PATCH')
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Update Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    @foreach(['approved', 'rejected', 'under_review', 'revision_required'] as $s)
                        <option value="{{ $s }}" {{ $membership->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.375rem;">Admin Notes</label>
                <textarea name="admin_notes" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">{{ $membership->admin_notes }}</textarea>
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.5rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.875rem;text-decoration:none;display:inline-block;">
                Update Status
            </button>
        </form>
    </div>
</div>
@endsection
