@extends('layouts.admin')
@section('title', 'Add Startup')
@section('page-title', 'Add Startup')

@section('content')
@php
    $inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;transition:border-color .15s;";
    $lbl = "display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
    $sectors = explode(',', \App\Models\Setting::get('startups_sectors','FinTech,AgriTech,HealthTech,EdTech,CleanTech,E-Commerce,Real Estate,Manufacturing,Logistics,Media'));
    $stages = ['Pre-Seed','Seed','Series A','Series B','Series C','Growth','Bootstrapped'];
@endphp

<form method="POST" action="{{ route('admin.opportunities.store') }}" enctype="multipart/form-data">
    @csrf
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start;">

        {{-- Main Fields --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Basic Information</h3>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Startup Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required style="{{ $inp }}" placeholder="e.g. GreenHarvest AgriTech" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
                        <div>
                            <label style="{{ $lbl }}">Sector</label>
                            <select name="sector" style="{{ $inp }}cursor:pointer;">
                                <option value="">Select sector</option>
                                @foreach($sectors as $s)
                                <option value="{{ trim($s) }}" {{ old('sector')===trim($s)?'selected':'' }}>{{ trim($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Stage</label>
                            <select name="stage" style="{{ $inp }}cursor:pointer;">
                                <option value="">Select stage</option>
                                @foreach($stages as $s)
                                <option value="{{ $s }}" {{ old('stage')===$s?'selected':'' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. Dhaka, Bangladesh" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Country</label>
                            <input type="text" name="country" value="{{ old('country') }}" placeholder="Bangladesh" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Business Details</h3>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    @foreach([['business_problem','Business Problem / Pain Point','What problem does this startup solve?'],['solution','Solution','How does the startup solve it?'],['target_market','Target Market','Who are the customers?'],['traction','Traction & Milestones','Revenue, users, partnerships...'],['use_of_funds','Use of Funds','How will the investment be used?'],['key_metrics','Key Metrics','KPIs, growth rates, etc.']] as [$name,$label,$ph])
                    <div>
                        <label style="{{ $lbl }}">{{ $label }}</label>
                        <textarea name="{{ $name }}" rows="3" placeholder="{{ $ph }}" style="{{ $inp }}resize:vertical;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ old($name) }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Funding & Status</h3>
                <div style="display:flex;flex-direction:column;gap:.875rem;">
                    <div>
                        <label style="{{ $lbl }}">Ask Amount (৳)</label>
                        <input type="number" name="ask_amount" value="{{ old('ask_amount') }}" placeholder="5000000" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Currency</label>
                        <select name="ask_currency" style="{{ $inp }}cursor:pointer;">
                            @foreach(['BDT','USD','EUR','GBP'] as $c)
                            <option value="{{ $c }}" {{ old('ask_currency','BDT')===$c?'selected':'' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Status</label>
                        <select name="status" style="{{ $inp }}cursor:pointer;">
                            @foreach(['draft','submitted','under_review','approved','rejected','archived'] as $s)
                            <option value="{{ $s }}" {{ old('status','approved')===$s?'selected':'' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:.5rem;">
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured')?'checked':'' }} style="accent-color:#6366f1;width:1rem;height:1rem;">
                            ⭐ Mark as Featured
                        </label>
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;color:#374151;cursor:pointer;">
                            <input type="checkbox" name="is_hot_deal" value="1" {{ old('is_hot_deal')?'checked':'' }} style="accent-color:#ef4444;width:1rem;height:1rem;">
                            🔥 Mark as Hot Deal
                        </label>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Company Logo</h3>
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.5rem;">
                    <div id="logoPreviewCreate" style="width:3.5rem;height:3.5rem;border-radius:.75rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="20" height="20" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <input type="file" id="logoInputCreate" name="company_logo" accept="image/*" style="display:none;" onchange="previewCreateLogo(this)">
                        <label for="logoInputCreate" style="display:inline-flex;align-items:center;gap:.375rem;font-size:.8125rem;font-weight:600;color:#6366f1;cursor:pointer;padding:.4rem .875rem;background:#eef2ff;border-radius:.5rem;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Upload Logo
                        </label>
                        <p style="font-size:.7rem;color:#9ca3af;margin:.25rem 0 0;">PNG, JPG — max 2MB</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
                <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0 0 1rem;">Pitch Deck</h3>
                <input type="file" name="pitch_deck" accept=".pdf" style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.875rem;box-sizing:border-box;cursor:pointer;">
                <p style="font-size:.7rem;color:#9ca3af;margin:.375rem 0 0;">PDF only, max 10MB</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:.625rem;">
                <button type="submit" style="display:flex;align-items:center;justify-content:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:700;padding:.75rem;border-radius:.75rem;border:none;cursor:pointer;font-size:.9375rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;" onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Create Startup
                </button>
                <a href="{{ route('admin.opportunities.index') }}" style="display:flex;align-items:center;justify-content:center;color:#6b7280;text-decoration:none;font-size:.875rem;font-weight:500;padding:.625rem;background:#f3f4f6;border-radius:.75rem;transition:background .15s;" onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">Cancel</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function previewCreateLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var el = document.getElementById('logoPreviewCreate');
            var img = document.createElement('img');
            img.id = 'logoPreviewCreate';
            img.src = e.target.result;
            img.style.cssText = 'width:3.5rem;height:3.5rem;border-radius:.75rem;object-fit:contain;border:2px solid #e5e7eb;background:#f9fafb;padding:.25rem;display:block;flex-shrink:0;';
            el.parentNode.replaceChild(img, el);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
