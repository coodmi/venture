@extends('layouts.admin')
@section('title', $user->name)
@section('page-title', 'User Details')

@section('content')
<div style="max-width:48rem;display:flex;flex-direction:column;gap:1.25rem;">
    <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
            <div style="width:3.5rem;height:3.5rem;background:#eff6ff;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="color:#1a3c8f;font-weight:800;font-size:1.25rem;">{{ substr($user->name,0,1) }}</span>
            </div>
            <div>
                <h2 style="font-size:1.125rem;font-weight:700;color:#0d2b6e;margin:0 0 .25rem;">{{ $user->name }}</h2>
                <p style="color:#8d98a1;font-size:.875rem;margin:0 0 .5rem;">{{ $user->email }}</p>
                <div style="display:flex;gap:.375rem;flex-wrap:wrap;">
                    @foreach($user->roles as $role)
                    <span style="background:#eff6ff;color:#1a3c8f;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ $role->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.users.status',$user) }}" style="display:flex;align-items:center;gap:.75rem;">
            @csrf @method('PATCH')
            <select name="status" style="background:#f4f7fb;border:1px solid #dde3ea;color:#374151;border-radius:.5rem;padding:.5rem .875rem;font-size:.875rem;outline:none;">
                <option value="active"    {{ $user->status==='active'?'selected':'' }}>Active</option>
                <option value="pending"   {{ $user->status==='pending'?'selected':'' }}>Pending</option>
                <option value="suspended" {{ $user->status==='suspended'?'selected':'' }}>Suspended</option>
            </select>
            <button type="submit" style="background:#1a3c8f;color:#fff;font-size:.875rem;font-weight:600;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;">Update Status</button>
        </form>
    </div>

    @if($user->investorProfile)
    <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <h3 style="font-weight:700;color:#0d2b6e;margin:0 0 1rem;font-size:.9375rem;">Investor Profile</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;font-size:.875rem;">
            <div><span style="color:#8d98a1;">Type:</span> <span style="color:#374151;font-weight:500;">{{ $user->investorProfile->investor_type }}</span></div>
            <div><span style="color:#8d98a1;">Organization:</span> <span style="color:#374151;font-weight:500;">{{ $user->investorProfile->organization }}</span></div>
            <div><span style="color:#8d98a1;">Stage:</span> <span style="color:#374151;font-weight:500;">{{ $user->investorProfile->investment_stage }}</span></div>
            <div><span style="color:#8d98a1;">Verification:</span> <span style="color:#374151;font-weight:500;">{{ $user->investorProfile->verification_status }}</span></div>
        </div>
    </div>
    @endif

    @if($user->seekerProfile)
    <div style="background:#fff;border-radius:1rem;border:1px solid #dde3ea;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <h3 style="font-weight:700;color:#0d2b6e;margin:0 0 1rem;font-size:.9375rem;">Seeker Profile</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;font-size:.875rem;">
            <div><span style="color:#8d98a1;">Company:</span> <span style="color:#374151;font-weight:500;">{{ $user->seekerProfile->company_name }}</span></div>
            <div><span style="color:#8d98a1;">Industry:</span> <span style="color:#374151;font-weight:500;">{{ $user->seekerProfile->industry }}</span></div>
            <div><span style="color:#8d98a1;">Stage:</span> <span style="color:#374151;font-weight:500;">{{ $user->seekerProfile->stage }}</span></div>
            <div><span style="color:#8d98a1;">Location:</span> <span style="color:#374151;font-weight:500;">{{ $user->seekerProfile->location }}</span></div>
        </div>
    </div>
    @endif
</div>
@endsection
