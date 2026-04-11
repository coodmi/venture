@extends('layouts.admin')
@section('title', 'Membership Plans')
@section('page-title', 'Membership Plans')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($plans as $plan)
    <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 p-5">
        <h3 style="font-weight:700;color:#f0e6c8;">{{ $plan->name }}</h3>
        <p class="text-xs text-gray-400 mt-0.5">{{ ucfirst($plan->category) }}</p>
        <p class="text-2xl font-bold text-primary-700 mt-2">
            @if($plan->fee > 0) ৳{{ number_format($plan->fee) }} @else Free @endif
        </p>
        <p style="font-size:.75rem;color:#6b5c3e;">{{ $plan->duration_months }} months</p>
        <div class="mt-3 space-y-1">
            @foreach($plan->benefits ?? [] as $b)
                <p class="text-xs text-gray-600">✓ {{ $b }}</p>
            @endforeach
        </div>
        <div class="mt-3 flex items-center gap-2">
            <span class="text-xs px-2 py-0.5 rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                {{ $plan->is_active ? 'Active' : 'Inactive' }}
            </span>
            <span style="font-size:.75rem;color:#6b5c3e;">{{ $plan->memberships()->count() }} members</span>
        </div>
    </div>
    @endforeach
</div>
@endsection
