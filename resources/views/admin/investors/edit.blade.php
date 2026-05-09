@extends('layouts.admin')
@section('title', 'Edit Investor')
@section('page-title', 'Edit Investor Profile')

@section('content')
@php
$inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;";
$lbl = "display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
$card = "background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);";
@endphp

<div style="display:grid;grid-template-columns:1fr 2fr;gap:1.25rem;align-items:start;">

    {{-- Left: Avatar + Account --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">

        {{-- Avatar Card --}}
        <div style="{{ $card }}text-align:center;">
            @if($investor->photo)
                <img src="{{ Storage::url($investor->photo) }}" style="width:6rem;height:6rem;border-radius:50%;object-fit:cover;border:3px solid #e0e7ff;margin:0 auto .75rem;">
            @else
                <div style="width:6rem;height:6rem;background:linear-gradient(135deg,#1a3c8f,#3b5fc0);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                    <span style="color:#fff;font-weight:800;font-size:2rem;">{{ strtoupper(substr($investor->user->name,0,1)) }}</span>
                </div>
            @endif
            <div style="font-weight:700;color:#111827;font-size:.9375rem;">{{ $investor->user->name }}</div>
            <div style="color:#9ca3af;font-size:.8125rem;margin-top:.25rem;">{{ $investor->user->email }}</div>
            <span style="display:inline-block;margin-top:.5rem;font-size:.7rem;font-weight:600;padding:.25rem .75rem;border-radius:9999px;background:#eff6ff;color:#1a3c8f;">Investor</span>
        </div>

        {{-- Quick Stats --}}
        <div style="{{ $card }}">
            <h3 style="font-weight:700;color:#111827;font-size:.875rem;margin:0 0 .875rem;">Profile Stats</h3>
            <div style="display:flex;flex-direction:column;gap:.625rem;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:.8125rem;color:#6b7280;">Completion</span>
                    <span style="font-size:.8125rem;font-weight:700;color:#6366f1;">{{ $investor->profile_completion ?? 0 }}%</span>
                </div>
                <div style="height:.375rem;background:#e5e7eb;border-radius:9999px;">
                    <div style="height:100%;background:#6366f1;border-radius:9999px;width:{{ $investor->profile_completion ?? 0 }}%;"></div>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.8125rem;">
                    <span style="color:#6b7280;">Joined</span>
                    <span style="color:#374151;font-weight:500;">{{ $investor->user->created_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.8125rem;">
                    <span style="color:#6b7280;">Last Login</span>
                    <span style="color:#374151;font-weight:500;">{{ $investor->user->last_login_at?->format('d M Y') ?? 'Never' }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.8125rem;">
                    <span style="color:#6b7280;">Visible</span>
                    <span style="color:#374151;font-weight:500;">{{ $investor->is_visible ? 'Yes' : 'No' }}</span>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.investors.index') }}" style="display:flex;align-items:center;justify-content:center;gap:.375rem;color:#6b7280;text-decoration:none;font-size:.875rem;font-weight:500;padding:.625rem;background:#f3f4f6;border-radius:.75rem;" onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">
            ← Back to Investors
        </a>
    </div>

    {{-- Right: Edit Form --}}
    <form method="POST" action="{{ route('admin.investors.update', $investor) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Account Info --}}
            <div style="{{ $card }}">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Account Information</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $investor->user->name) }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $investor->user->email) }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $investor->user->phone) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Account Status</label>
                        <select name="status" style="{{ $inp }}cursor:pointer;">
                            @foreach(['active','pending','suspended'] as $s)
                            <option value="{{ $s }}" {{ old('status',$investor->user->status)===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="{{ $lbl }}">New Password <span style="color:#9ca3af;font-weight:400;">(leave blank to keep current)</span></label>
                        <input type="password" name="password" style="{{ $inp }}" placeholder="••••••••" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                </div>
            </div>

            {{-- Profile Photo --}}
            <div style="{{ $card }}">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Profile Photo</h3>
                <div style="display:flex;align-items:center;gap:1rem;">
                    @if($investor->photo)
                        <img src="{{ Storage::url($investor->photo) }}" style="width:4rem;height:4rem;border-radius:50%;object-fit:cover;border:2px solid #e0e7ff;">
                    @else
                        <div style="width:4rem;height:4rem;background:linear-gradient(135deg,#1a3c8f,#3b5fc0);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <span style="color:#fff;font-weight:700;font-size:1.25rem;">{{ strtoupper(substr($investor->user->name,0,1)) }}</span>
                        </div>
                    @endif
                    <div style="flex:1;">
                        <input type="file" name="photo" accept="image/*" style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.875rem;box-sizing:border-box;cursor:pointer;">
                        <p style="font-size:.7rem;color:#9ca3af;margin:.25rem 0 0;">JPG, PNG, max 2MB</p>
                    </div>
                </div>
            </div>

            {{-- Investor Profile --}}
            <div style="{{ $card }}">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Investor Profile</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Investor Type</label>
                        <select name="investor_type" style="{{ $inp }}cursor:pointer;">
                            <option value="">Select type</option>
                            @foreach(['angel'=>'Angel Investor','vc'=>'Venture Capital','corporate'=>'Corporate','family_office'=>'Family Office','impact'=>'Impact Investor'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('investor_type',$investor->investor_type)===$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Organization</label>
                        <input type="text" name="organization" value="{{ old('organization',$investor->organization) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Designation</label>
                        <input type="text" name="designation" value="{{ old('designation',$investor->designation) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Investment Stage</label>
                        <select name="investment_stage" style="{{ $inp }}cursor:pointer;">
                            <option value="">Select stage</option>
                            @foreach(['pre_seed'=>'Pre-Seed','seed'=>'Seed','series_a'=>'Series A','series_b'=>'Series B','growth'=>'Growth','any'=>'Any Stage'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('investment_stage',$investor->investment_stage)===$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Min Ticket Size</label>
                        <input type="text" name="ticket_size_min" value="{{ old('ticket_size_min',$investor->ticket_size_min) }}" placeholder="e.g. 500000" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Max Ticket Size</label>
                        <input type="text" name="ticket_size_max" value="{{ old('ticket_size_max',$investor->ticket_size_max) }}" placeholder="e.g. 5000000" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Risk Profile</label>
                        <select name="risk_profile" style="{{ $inp }}cursor:pointer;">
                            <option value="">Select</option>
                            @foreach(['conservative'=>'Conservative','moderate'=>'Moderate','aggressive'=>'Aggressive'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('risk_profile',$investor->risk_profile)===$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Verification Status</label>
                        <select name="verification_status" style="{{ $inp }}cursor:pointer;">
                            @foreach(['pending'=>'Pending','verified'=>'Verified','rejected'=>'Rejected'] as $val=>$label)
                            <option value="{{ $val }}" {{ old('verification_status',$investor->verification_status)===$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url',$investor->linkedin_url) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Website</label>
                        <input type="url" name="website" value="{{ old('website',$investor->website) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="{{ $lbl }}">Bio</label>
                        <textarea name="bio" rows="3" style="{{ $inp }}resize:vertical;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ old('bio',$investor->bio) }}</textarea>
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                            <input type="checkbox" name="is_visible" value="1" {{ old('is_visible',$investor->is_visible)?'checked':'' }} style="accent-color:#6366f1;width:1rem;height:1rem;">
                            Visible on public investor directory
                        </label>
                    </div>
                </div>
            </div>

            {{-- Save --}}
            <div style="display:flex;gap:.75rem;">
                <button type="submit" style="flex:1;display:flex;align-items:center;justify-content:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:700;padding:.75rem;border-radius:.75rem;border:none;cursor:pointer;font-size:.9375rem;" onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
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
