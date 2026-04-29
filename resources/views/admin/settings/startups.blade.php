@extends('layouts.admin')
@section('title', 'Startups Page')
@section('page-title', 'Startups Page Settings')

@section('content')
@php
    $inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;transition:border-color .15s;";
    $lbl = "display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
@endphp

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">

    {{-- Hero Section --}}
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
        <div style="padding:.875rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.625rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);">
            <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <div>
                <p style="font-weight:700;color:#fff;font-size:.9rem;margin:0;">Hero Section</p>
                <p style="font-size:.7rem;color:rgba(255,255,255,.75);margin:0;">Customize the top banner of the /startups page</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.settings.startups.update') }}" style="padding:1.25rem;display:flex;flex-direction:column;gap:.875rem;">
            @csrf
            <div>
                <label style="{{ $lbl }}">Badge Text</label>
                <input type="text" name="startups_hero_badge" value="{{ \App\Models\Setting::get('startups_hero_badge','Investment Opportunities') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
            </div>
            <div>
                <label style="{{ $lbl }}">Hero Title</label>
                <input type="text" name="startups_hero_title" value="{{ \App\Models\Setting::get('startups_hero_title','Top Startups') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                <p style="font-size:.7rem;color:#9ca3af;margin:.25rem 0 0;">Wrap a word in &lt;span&gt; for orange highlight, e.g. Top &lt;span&gt;Startups&lt;/span&gt;</p>
            </div>
            <div>
                <label style="{{ $lbl }}">Hero Subtitle</label>
                <textarea name="startups_hero_subtitle" rows="3" style="{{ $inp }}resize:none;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ \App\Models\Setting::get('startups_hero_subtitle','Discover high-potential startups seeking investment. Browse, explore, and connect with founders.') }}</textarea>
            </div>
            <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;align-self:flex-start;transition:background .15s;" onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Save Hero
            </button>
        </form>
    </div>

    {{-- CTA + Sectors --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
            <div style="padding:.875rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.625rem;">
                <div style="width:2rem;height:2rem;background:#ecfdf5;border-radius:.5rem;display:flex;align-items:center;justify-content:center;">
                    <svg width="13" height="13" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                </div>
                <p style="font-weight:700;color:#111827;font-size:.9rem;margin:0;">Bottom CTA Section</p>
            </div>
            <form method="POST" action="{{ route('admin.settings.startups.update') }}" style="padding:1.25rem;display:flex;flex-direction:column;gap:.875rem;">
                @csrf
                <div>
                    <label style="{{ $lbl }}">CTA Title</label>
                    <input type="text" name="startups_cta_title" value="{{ \App\Models\Setting::get('startups_cta_title','Have a Startup to Fund?') }}" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                </div>
                <div>
                    <label style="{{ $lbl }}">CTA Subtitle</label>
                    <textarea name="startups_cta_subtitle" rows="2" style="{{ $inp }}resize:none;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ \App\Models\Setting::get('startups_cta_subtitle','Submit your startup and get discovered by 500+ verified investors.') }}</textarea>
                </div>
                <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;background:#10b981;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;align-self:flex-start;transition:background .15s;" onmouseover="this.style.background='#059669';" onmouseout="this.style.background='#10b981';">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Save CTA
                </button>
            </form>
        </div>

        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);">
            <div style="padding:.875rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.625rem;">
                <div style="width:2rem;height:2rem;background:#eff6ff;border-radius:.5rem;display:flex;align-items:center;justify-content:center;">
                    <svg width="13" height="13" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <p style="font-weight:700;color:#111827;font-size:.9rem;margin:0;">Sector Categories</p>
                    <p style="font-size:.7rem;color:#9ca3af;margin:0;">Comma-separated list shown as filter pills</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.settings.startups.update') }}" style="padding:1.25rem;display:flex;flex-direction:column;gap:.875rem;">
                @csrf
                <div>
                    <label style="{{ $lbl }}">Sectors (comma-separated)</label>
                    <textarea name="startups_sectors" rows="4" placeholder="FinTech, AgriTech, HealthTech, EdTech, CleanTech, E-Commerce" style="{{ $inp }}resize:none;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ \App\Models\Setting::get('startups_sectors','FinTech,AgriTech,HealthTech,EdTech,CleanTech,E-Commerce,Real Estate,Manufacturing,Logistics,Media') }}</textarea>
                    <p style="font-size:.7rem;color:#9ca3af;margin:.25rem 0 0;">These appear as filter pills on the startups page</p>
                </div>
                <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;background:#3b82f6;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;align-self:flex-start;transition:background .15s;" onmouseover="this.style.background='#2563eb';" onmouseout="this.style.background='#3b82f6';">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Save Sectors
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Startups List --}}
<div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);margin-top:1.25rem;">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <h3 style="font-weight:700;color:#111827;font-size:.9375rem;margin:0;">All Startups</h3>
            <p style="font-size:.75rem;color:#9ca3af;margin:.125rem 0 0;">Manage, edit, and create startup listings</p>
        </div>
        <a href="{{ route('admin.opportunities.create') }}"
           style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;text-decoration:none;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
           onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Startup
        </a>
    </div>
    <table style="width:100%;font-size:.875rem;border-collapse:collapse;">
        <thead style="background:#f8fafc;">
            <tr>
                @foreach(['Title','Sector','Stage','Ask','Status','Flags','Actions'] as $h)
                <th style="padding:.75rem 1rem;text-align:left;font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;border-bottom:1px solid #f3f4f6;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Opportunity::latest()->take(50)->get() as $opp)
            <tr style="border-bottom:1px solid #f9fafb;transition:background .1s;" onmouseover="this.style.background='#f8fafc';" onmouseout="this.style.background='transparent';">
                <td style="padding:.75rem 1rem;font-weight:600;color:#111827;max-width:14rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $opp->title }}</td>
                <td style="padding:.75rem 1rem;">
                    @if($opp->sector)<span style="background:#f3f4f6;color:#374151;font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;">{{ $opp->sector }}</span>@endif
                </td>
                <td style="padding:.75rem 1rem;color:#6b7280;font-size:.8125rem;">{{ $opp->stage ?? '—' }}</td>
                <td style="padding:.75rem 1rem;font-weight:700;color:#6366f1;font-size:.8125rem;">{{ $opp->ask_amount ? '৳'.number_format($opp->ask_amount) : '—' }}</td>
                <td style="padding:.75rem 1rem;">
                    <span style="font-size:.7rem;font-weight:600;padding:.2rem .5rem;border-radius:9999px;
                        {{ $opp->status==='approved'?'background:#ecfdf5;color:#059669;':($opp->status==='submitted'?'background:#fff7ed;color:#d97706;':($opp->status==='rejected'?'background:#fef2f2;color:#dc2626;':'background:#f3f4f6;color:#6b7280;')) }}">
                        {{ ucfirst(str_replace('_',' ',$opp->status)) }}
                    </span>
                </td>
                <td style="padding:.75rem 1rem;">
                    @if($opp->is_hot_deal)<span style="font-size:.75rem;">🔥</span>@endif
                    @if($opp->is_featured)<span style="font-size:.75rem;">⭐</span>@endif
                </td>
                <td style="padding:.75rem 1rem;">
                    <div style="display:flex;gap:.375rem;">
                        <a href="{{ route('admin.opportunities.edit',$opp) }}"
                           style="display:inline-flex;align-items:center;gap:.2rem;color:#6b7280;text-decoration:none;font-size:.8rem;font-weight:600;padding:.2rem .5rem;background:#f3f4f6;border-radius:.375rem;transition:background .15s;"
                           onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f3f4f6';">Edit</a>
                        <a href="{{ route('admin.opportunities.show',$opp) }}"
                           style="display:inline-flex;align-items:center;gap:.2rem;color:#6366f1;text-decoration:none;font-size:.8rem;font-weight:600;padding:.2rem .5rem;background:#eef2ff;border-radius:.375rem;transition:background .15s;"
                           onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">View</a>
                        <form method="POST" action="{{ route('admin.opportunities.destroy',$opp) }}" onsubmit="return confirm('Delete this startup?')" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="display:inline-flex;align-items:center;color:#dc2626;font-size:.8rem;font-weight:600;padding:.2rem .5rem;background:#fef2f2;border-radius:.375rem;border:none;cursor:pointer;transition:background .15s;" onmouseover="this.style.background='#fee2e2';" onmouseout="this.style.background='#fef2f2';">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:.875rem 1.25rem;border-top:1px solid #f3f4f6;">
        <a href="{{ route('admin.opportunities.index') }}" style="font-size:.8125rem;color:#6366f1;text-decoration:none;font-weight:600;">View all in Opportunities →</a>
    </div>
</div>
@endsection
