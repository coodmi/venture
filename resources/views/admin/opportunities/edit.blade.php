@extends('layouts.admin')
@section('title', 'Edit Startup')
@section('page-title', 'Edit Startup')

@section('content')
@php
    $inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;transition:border-color .15s;";
    $lbl = "display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
    $sectors = explode(',', \App\Models\Setting::get('startups_sectors','FinTech,AgriTech,HealthTech,EdTech,CleanTech,E-Commerce,Real Estate,Manufacturing,Logistics,Media'));
    $stages = ['Pre-Seed','Seed','Series A','Series B','Series C','Growth','Bootstrapped'];
    $o = $opportunity;
@endphp

<form method="POST" action="{{ route('admin.opportunities.update',$o) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start;">

        <div style="display:flex;flex-direction:column;gap:1.25rem;">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Basic Information</h3>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Startup Title *</label>
                        <input type="text" name="title" value="{{ old('title',$o->title) }}" required style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                        <div>
                            <label style="{{ $lbl }}">Sector</label>
                            <select name="sector" style="{{ $inp }}cursor:pointer;">
                                <option value="">Select sector</option>
                                @foreach($sectors as $s)
                                <option value="{{ trim($s) }}" {{ old('sector',$o->sector)===trim($s)?'selected':'' }}>{{ trim($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Stage</label>
                            <select name="stage" style="{{ $inp }}cursor:pointer;">
                                <option value="">Select stage</option>
                                @foreach($stages as $s)
                                <option value="{{ $s }}" {{ old('stage',$o->stage)===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Location</label>
                            <input type="text" name="location" value="{{ old('location',$o->location) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Country</label>
                            <input type="text" name="country" value="{{ old('country',$o->country) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Business Details</h3>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    @foreach([['business_problem','Business Problem'],['solution','Solution'],['target_market','Target Market'],['traction','Traction & Milestones'],['use_of_funds','Use of Funds'],['key_metrics','Key Metrics']] as [$name,$label])
                    <div>
                        <label style="{{ $lbl }}">{{ $label }}</label>
                        <textarea name="{{ $name }}" rows="3" style="{{ $inp }}resize:vertical;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ old($name,$o->$name) }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:1.25rem;">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Funding & Status</h3>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Ask Amount</label>
                        <input type="number" name="ask_amount" value="{{ old('ask_amount',$o->ask_amount) }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Currency</label>
                        <select name="ask_currency" style="{{ $inp }}cursor:pointer;">
                            @foreach(['BDT','USD','EUR','GBP'] as $c)
                            <option value="{{ $c }}" {{ old('ask_currency',$o->ask_currency)===$c?'selected':'' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Status</label>
                        <select name="status" style="{{ $inp }}cursor:pointer;">
                            @foreach(['draft','submitted','under_review','approved','rejected','archived'] as $s)
                            <option value="{{ $s }}" {{ old('status',$o->status)===$s?'selected':'' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:.5rem;">
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$o->is_featured)?'checked':'' }} style="accent-color:#6366f1;width:1rem;height:1rem;">
                            ⭐ Featured
                        </label>
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                            <input type="checkbox" name="is_hot_deal" value="1" {{ old('is_hot_deal',$o->is_hot_deal)?'checked':'' }} style="accent-color:#ef4444;width:1rem;height:1rem;">
                            🔥 Hot Deal
                        </label>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Company Logo</h3>
                <div style="display:flex;align-items:center;gap:1rem;">
                    <div style="position:relative;flex-shrink:0;">
                        @if($o->seekerProfile?->company_logo)
                            <img id="logoPreview" src="{{ Storage::url($o->seekerProfile->company_logo) }}"
                                 style="width:5rem;height:5rem;border-radius:.75rem;object-fit:contain;border:2px solid #e5e7eb;background:#f9fafb;padding:.25rem;display:block;">
                        @else
                            <div id="logoPreview" style="width:5rem;height:5rem;border-radius:.75rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;border:2px solid #e0e7ff;">
                                <span style="color:#fff;font-weight:800;font-size:1.25rem;">{{ strtoupper(substr($o->title,0,2)) }}</span>
                            </div>
                        @endif
                        <label for="logoInput" style="position:absolute;bottom:-4px;right:-4px;width:1.5rem;height:1.5rem;background:#6366f1;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.2);">
                            <svg width="10" height="10" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><circle cx="12" cy="13" r="3"/></svg>
                        </label>
                    </div>
                    <div style="flex:1;">
                        <p style="font-size:.8125rem;font-weight:600;color:#374151;margin:0 0 .25rem;">{{ $o->title }}</p>
                        <p style="font-size:.75rem;color:#9ca3af;margin:0 0 .625rem;">PNG, JPG — max 2MB</p>
                        <input type="file" id="logoInput" name="company_logo" accept="image/*"
                               style="display:none;"
                               onchange="previewAdminLogo(this)">
                        <label for="logoInput" style="display:inline-flex;align-items:center;gap:.375rem;font-size:.75rem;font-weight:600;color:#6366f1;cursor:pointer;padding:.35rem .875rem;background:#eef2ff;border-radius:.5rem;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Upload Logo
                        </label>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 .75rem;">Pitch Deck</h3>
                @if($o->pitch_deck)
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;padding:.5rem .75rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:.5rem;">
                    <svg width="14" height="14" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <a href="{{ Storage::url($o->pitch_deck) }}" target="_blank" style="font-size:.8rem;color:#059669;text-decoration:none;font-weight:600;">Current PDF</a>
                </div>
                @endif
                <input type="file" name="pitch_deck" accept=".pdf" style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.875rem;box-sizing:border-box;cursor:pointer;">
                <p style="font-size:.7rem;color:#9ca3af;margin:.375rem 0 0;">Leave empty to keep existing</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:.625rem;">
                <button type="submit" style="display:flex;align-items:center;justify-content:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:700;padding:.75rem;border-radius:.75rem;border:none;cursor:pointer;font-size:.9375rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;" onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Save Changes
                </button>
                <a href="{{ route('admin.opportunities.index') }}" style="display:flex;align-items:center;justify-content:center;color:#6b7280;text-decoration:none;font-size:.875rem;font-weight:500;padding:.625rem;background:#f3f4f6;border-radius:.75rem;" onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">Cancel</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function previewAdminLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var el = document.getElementById('logoPreview');
            if (el.tagName === 'IMG') {
                el.src = e.target.result;
            } else {
                var img = document.createElement('img');
                img.id = 'logoPreview';
                img.src = e.target.result;
                img.style.cssText = 'width:5rem;height:5rem;border-radius:.75rem;object-fit:contain;border:2px solid #e5e7eb;background:#f9fafb;padding:.25rem;display:block;';
                el.parentNode.replaceChild(img, el);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
