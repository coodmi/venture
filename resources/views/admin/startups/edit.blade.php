@extends('layouts.admin')
@section('title', 'Edit Startup')
@section('page-title', 'Edit Startup Profile')

@section('content')
@php
$inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;";
$lbl = "display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
$card = "background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);";
@endphp

<div style="display:grid;grid-template-columns:1fr 2fr;gap:1.25rem;align-items:start;">

    {{-- Left: Avatar + Stats --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div style="{{ $card }}text-align:center;">
            @if($startup->photo)
                <img src="{{ Storage::url($startup->photo) }}" style="width:6rem;height:6rem;border-radius:50%;object-fit:cover;border:3px solid #fed7aa;margin:0 auto .75rem;">
            @else
                <div style="width:6rem;height:6rem;background:linear-gradient(135deg,#f97316,#fb923c);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                    <span style="color:#fff;font-weight:800;font-size:2rem;">{{ strtoupper(substr($startup->user->name,0,1)) }}</span>
                </div>
            @endif
            <div style="font-weight:700;color:#111827;font-size:.9375rem;">{{ $startup->user->name }}</div>
            <div style="color:#9ca3af;font-size:.8125rem;margin-top:.25rem;">{{ $startup->user->email }}</div>
            @if($startup->company_name)
            <div style="margin-top:.5rem;display:flex;align-items:center;justify-content:center;gap:.375rem;">
                @if($startup->company_logo)
                    <img src="{{ Storage::url($startup->company_logo) }}" style="width:1.25rem;height:1.25rem;border-radius:.25rem;object-fit:cover;">
                @endif
                <span style="font-size:.8125rem;font-weight:600;color:#374151;">{{ $startup->company_name }}</span>
            </div>
            @endif
            <span style="display:inline-block;margin-top:.5rem;font-size:.7rem;font-weight:600;padding:.25rem .75rem;border-radius:9999px;background:#fff7ed;color:#f97316;">Seeker</span>
        </div>

        <div style="{{ $card }}">
            <h3 style="font-weight:700;color:#111827;font-size:.875rem;margin:0 0 .875rem;">Profile Stats</h3>
            <div style="display:flex;flex-direction:column;gap:.625rem;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:.8125rem;color:#6b7280;">Completion</span>
                    <span style="font-size:.8125rem;font-weight:700;color:#f97316;">{{ $startup->profile_completion ?? 0 }}%</span>
                </div>
                <div style="height:.375rem;background:#e5e7eb;border-radius:9999px;">
                    <div style="height:100%;background:#f97316;border-radius:9999px;width:{{ $startup->profile_completion ?? 0 }}%;"></div>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.8125rem;">
                    <span style="color:#6b7280;">Joined</span>
                    <span style="color:#374151;font-weight:500;">{{ $startup->user->created_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.8125rem;">
                    <span style="color:#6b7280;">Last Login</span>
                    <span style="color:#374151;font-weight:500;">{{ $startup->user->last_login_at?->format('d M Y') ?? 'Never' }}</span>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.startups-profiles.index') }}" style="display:flex;align-items:center;justify-content:center;gap:.375rem;color:#6b7280;text-decoration:none;font-size:.875rem;font-weight:500;padding:.625rem;background:#f3f4f6;border-radius:.75rem;" onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">
            ← Back to Startups
        </a>
    </div>

    {{-- Right: Form --}}
    <form method="POST" action="{{ route('admin.startups-profiles.update', $startup) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Account --}}
            <div style="{{ $card }}">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Account Information</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name',$startup->user->name) }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Email *</label>
                        <input type="email" name="email" value="{{ old('email',$startup->user->email) }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone',$startup->user->phone) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Account Status</label>
                        <select name="status" style="{{ $inp }}cursor:pointer;">
                            @foreach(['active','pending','suspended'] as $s)
                            <option value="{{ $s }}" {{ old('status',$startup->user->status)===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="{{ $lbl }}">New Password <span style="color:#9ca3af;font-weight:400;">(leave blank to keep current)</span></label>
                        <input type="password" name="password" style="{{ $inp }}" placeholder="••••••••" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                </div>
            </div>

            {{-- Photos --}}
            <div style="{{ $card }}">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Photos</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div>
                        <label style="{{ $lbl }}">Profile Photo</label>
                        @if($startup->photo)
                            <img src="{{ Storage::url($startup->photo) }}" style="width:3rem;height:3rem;border-radius:50%;object-fit:cover;border:2px solid #fed7aa;display:block;margin-bottom:.5rem;">
                        @endif
                        <input type="file" name="photo" accept="image/*" style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.8125rem;box-sizing:border-box;cursor:pointer;">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Company Logo</label>
                        @if($startup->company_logo)
                            <img src="{{ Storage::url($startup->company_logo) }}" style="width:3rem;height:3rem;border-radius:.5rem;object-fit:cover;border:1px solid #e5e7eb;display:block;margin-bottom:.5rem;">
                        @endif
                        <input type="file" name="company_logo" accept="image/*" style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.8125rem;box-sizing:border-box;cursor:pointer;">
                    </div>
                </div>
            </div>

            {{-- Startup Profile --}}
            <div style="{{ $card }}">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Startup Profile</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Company Name</label>
                        <input type="text" name="company_name" value="{{ old('company_name',$startup->company_name) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Industry</label>
                        <input type="text" name="industry" value="{{ old('industry',$startup->industry) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Stage</label>
                        <select name="stage" style="{{ $inp }}cursor:pointer;">
                            <option value="">Select stage</option>
                            @foreach(['Idea','MVP','Early Stage','Growth','Scale','Pre-Seed','Seed','Series A','Series B'] as $s)
                            <option value="{{ $s }}" {{ old('stage',$startup->stage)===$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Team Size</label>
                        <input type="number" name="team_size" value="{{ old('team_size',$startup->team_size) }}" min="1" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Location</label>
                        <input type="text" name="location" value="{{ old('location',$startup->location) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Country</label>
                        <input type="text" name="country" value="{{ old('country',$startup->country) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Website</label>
                        <input type="url" name="website" value="{{ old('website',$startup->website) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url',$startup->linkedin_url) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Twitter URL</label>
                        <input type="url" name="twitter_url" value="{{ old('twitter_url',$startup->twitter_url) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="{{ $lbl }}">Business Summary</label>
                        <textarea name="business_summary" rows="4" style="{{ $inp }}resize:vertical;" onfocus="this.style.borderColor='#f97316';" onblur="this.style.borderColor='#e5e7eb';">{{ old('business_summary',$startup->business_summary) }}</textarea>
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                            <input type="checkbox" name="is_visible" value="1" {{ old('is_visible',$startup->is_visible)?'checked':'' }} style="accent-color:#f97316;width:1rem;height:1rem;">
                            Visible on public startup directory
                        </label>
                    </div>
                </div>
            </div>

            {{-- Save --}}
            <div>
                <button type="submit" style="width:100%;display:flex;align-items:center;justify-content:center;gap:.375rem;background:#f97316;color:#fff;font-weight:700;padding:.75rem;border-radius:.75rem;border:none;cursor:pointer;font-size:.9375rem;" onmouseover="this.style.background='#ea6c0a';" onmouseout="this.style.background='#f97316';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Save Changes
                </button>
            </div>

            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:.75rem;padding:.875rem 1rem;">
                @foreach($errors->all() as $e)
                <p style="color:#dc2626;font-size:.8125rem;margin:.125rem 0;">• {{ $e }}</p>
                @endforeach
            </div>
            @endif
        </div>
    </form>
</div>
@endsection
