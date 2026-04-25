@extends('layouts.admin')
@section('title', 'About Content')
@section('page-title', 'About Page Content')

@section('content')
@php
    $inp = "width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;transition:border-color .15s;";
    $lbl = "display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;";
    $card = "background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);margin-bottom:1.25rem;";
    $cardHead = "padding:.875rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.625rem;";
    $cardBody = "padding:1.25rem;";

    $board = $sections['board_members']->extra ?? [];
    $highlights = $sections['highlights']->extra ?? [
        ['value'=>'500+','label'=>'Registered Investors'],
        ['value'=>'200+','label'=>'Startups Listed'],
        ['value'=>'$50M+','label'=>'Capital Connected'],
        ['value'=>'15+','label'=>'Countries Reached'],
    ];
@endphp

<form method="POST" action="{{ route('admin.settings.about.update') }}" enctype="multipart/form-data" x-data="boardManager()" x-init="init({{ json_encode($board) }})">
    @csrf

    {{-- ── Section Cards ── --}}
    @php
        $sectionDefs = [
            'hero'            => ['label'=>'Hero Section',       'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'color'=>'#6366f1', 'bg'=>'#eef2ff', 'subtitle'=>'Badge text, heading, and subheading for the hero banner'],
            'overview'        => ['label'=>'Who We Are',         'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color'=>'#3b82f6', 'bg'=>'#eff6ff', 'subtitle'=>'Organization overview heading and body text'],
            'vision'          => ['label'=>'Vision',             'icon'=>'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'color'=>'#8b5cf6', 'bg'=>'#f5f3ff', 'subtitle'=>'Vision statement title and content'],
            'mission'         => ['label'=>'Mission',            'icon'=>'M13 10V3L4 14h7v7l9-11h-7z', 'color'=>'#10b981', 'bg'=>'#ecfdf5', 'subtitle'=>'Mission statement title and content'],
        ];
    @endphp

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
        @foreach($sectionDefs as $key => $def)
        <div style="{{ $card }}">
            <div style="{{ $cardHead }}">
                <div style="width:2rem;height:2rem;background:{{ $def['bg'] }};border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="13" height="13" fill="none" stroke="{{ $def['color'] }}" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $def['icon'] }}"/></svg>
                </div>
                <div>
                    <p style="font-weight:700;color:#111827;font-size:.9rem;margin:0;">{{ $def['label'] }}</p>
                    <p style="font-size:.7rem;color:#9ca3af;margin:0;">{{ $def['subtitle'] }}</p>
                </div>
            </div>
            <div style="{{ $cardBody }}display:flex;flex-direction:column;gap:.75rem;">
                <div>
                    <label style="{{ $lbl }}">Title / Heading</label>
                    <input type="text" name="sections[{{ $key }}][title]" value="{{ $sections[$key]->title ?? '' }}" placeholder="Enter heading..." style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                </div>
                <div>
                    <label style="{{ $lbl }}">Content</label>
                    <textarea name="sections[{{ $key }}][content]" rows="4" placeholder="Enter content..." style="{{ $inp }}resize:vertical;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ $sections[$key]->content ?? '' }}</textarea>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Founder's Message — special card with photo upload --}}
        @php $founderPhoto = $sections['founder_message']->image ?? ''; @endphp
        <div style="{{ $card }}">
            <div style="{{ $cardHead }}">
                <div style="width:2rem;height:2rem;background:#fffbeb;border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="13" height="13" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <div>
                    <p style="font-weight:700;color:#111827;font-size:.9rem;margin:0;">Founder's Message</p>
                    <p style="font-size:.7rem;color:#9ca3af;margin:0;">Title = Founder name/role · Content = the message quote · Photo = portrait</p>
                </div>
            </div>
            <div style="{{ $cardBody }}display:flex;flex-direction:column;gap:.875rem;">
                {{-- Photo upload --}}
                <div style="display:flex;align-items:center;gap:1rem;">
                    <div style="width:5rem;height:5rem;border-radius:1rem;overflow:hidden;background:linear-gradient(135deg,#1a3c8f,#2563eb);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:2px solid #e5e7eb;" id="founderPhotoWrap">
                        @if($founderPhoto)
                            <img src="{{ Storage::url($founderPhoto) }}" alt="Founder" style="width:100%;height:100%;object-fit:cover;" id="founderPhotoPreview">
                        @else
                            <img id="founderPhotoPreview" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:none;">
                            <span style="color:#fff;font-weight:800;font-size:1.5rem;" id="founderInitial">{{ strtoupper(substr($sections['founder_message']->title ?? 'F', 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Founder Photo</label>
                        <label style="display:inline-flex;align-items:center;gap:.375rem;cursor:pointer;background:#eef2ff;border:1px solid #c7d2fe;color:#6366f1;border-radius:.5rem;padding:.4rem .875rem;font-size:.8125rem;font-weight:600;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/></svg>
                            Upload Photo
                            <input type="file" name="founder_photo" accept="image/*" style="display:none;" id="founderPhotoInput">
                        </label>
                        <p style="font-size:.7rem;color:#9ca3af;margin:.375rem 0 0;">Recommended: square portrait, min 300×300px</p>
                    </div>
                </div>
                <script>
                document.getElementById('founderPhotoInput').addEventListener('change', function() {
                    var file = this.files[0];
                    if (!file) return;
                    var url = URL.createObjectURL(file);
                    var img = document.getElementById('founderPhotoPreview');
                    var ini = document.getElementById('founderInitial');
                    img.src = url;
                    img.style.display = 'block';
                    if (ini) ini.style.display = 'none';
                });
                </script>
                <div>
                    <label style="{{ $lbl }}">Founder Name / Role (Title)</label>
                    <input type="text" name="sections[founder_message][title]" value="{{ $sections['founder_message']->title ?? '' }}" placeholder="e.g. Founder & CEO" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                </div>
                <div>
                    <label style="{{ $lbl }}">Message / Quote (Content)</label>
                    <textarea name="sections[founder_message][content]" rows="4" placeholder="Enter the founder's message..." style="{{ $inp }}resize:vertical;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">{{ $sections['founder_message']->content ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Highlights / Stats Boxes ── --}}
    <div style="{{ $card }}">
        <div style="{{ $cardHead }}">
            <div style="width:2rem;height:2rem;background:#ecfdf5;border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="13" height="13" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <div>
                <p style="font-weight:700;color:#111827;font-size:.9rem;margin:0;">Highlight Stats</p>
                <p style="font-size:.7rem;color:#9ca3af;margin:0;">4 stat boxes shown in the "Who We Are" section</p>
            </div>
        </div>
        <div style="{{ $cardBody }}">
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.875rem;">
                @foreach($highlights as $i => $h)
                <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:.625rem;padding:.875rem;">
                    <label style="{{ $lbl }}">Value</label>
                    <input type="text" name="highlights[value][]" value="{{ $h['value'] }}" placeholder="500+" style="{{ $inp }}margin-bottom:.5rem;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                    <label style="{{ $lbl }}">Label</label>
                    <input type="text" name="highlights[label][]" value="{{ $h['label'] }}" placeholder="Registered Investors" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Board Members ── --}}
    <div style="{{ $card }}">
        <div style="{{ $cardHead }}justify-content:space-between;">
            <div style="display:flex;align-items:center;gap:.625rem;">
                <div style="width:2rem;height:2rem;background:#eef2ff;border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="13" height="13" fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p style="font-weight:700;color:#111827;font-size:.9rem;margin:0;">Board Members</p>
                    <p style="font-size:.7rem;color:#9ca3af;margin:0;">Shown in the scrollable board section</p>
                </div>
            </div>
            <button type="button" @click="addMember"
                    style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.375rem .875rem;border-radius:.5rem;border:none;cursor:pointer;transition:background .15s;"
                    onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Add Member
            </button>
        </div>
        <div style="{{ $cardBody }}">
            <div style="display:flex;flex-direction:column;gap:.75rem;">
                <template x-for="(m, i) in members" :key="i">
                    <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:.75rem;padding:1rem;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;">
                            <span style="font-size:.75rem;font-weight:700;color:#6366f1;" x-text="'Member ' + (i+1)"></span>
                            <button type="button" @click="removeMember(i)"
                                    style="background:#fef2f2;border:none;cursor:pointer;color:#dc2626;border-radius:.375rem;padding:.25rem .5rem;font-size:.75rem;font-weight:600;transition:background .15s;"
                                    onmouseover="this.style.background='#fee2e2';" onmouseout="this.style.background='#fef2f2';">Remove</button>
                        </div>
                        <div style="display:grid;grid-template-columns:auto 1fr 1fr 1fr;gap:.625rem;align-items:start;margin-bottom:.625rem;">
                            {{-- Photo --}}
                            <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;">
                                <div style="width:4rem;height:4rem;border-radius:50%;overflow:hidden;background:#e5e7eb;border:2px solid #e5e7eb;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                                    <template x-if="m.photo || m._preview">
                                        <img :src="m._preview || '/storage/' + m.photo" style="width:100%;height:100%;object-fit:cover;">
                                    </template>
                                    <template x-if="!m.photo && !m._preview">
                                        <svg width="20" height="20" fill="none" stroke="#9ca3af" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </template>
                                </div>
                                <label style="display:inline-flex;align-items:center;gap:.25rem;cursor:pointer;background:#eef2ff;border:1px solid #c7d2fe;color:#6366f1;border-radius:.375rem;padding:.2rem .5rem;font-size:.7rem;font-weight:600;">
                                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/></svg>
                                    Photo
                                    <input type="file" :name="'board_member_photos[' + i + ']'" accept="image/*" style="display:none;" @change="previewPhoto($event, i)">
                                </label>
                                <input type="hidden" :name="'board_members[photo][]'" x-model="m.photo">
                            </div>
                            <div>
                                <label style="{{ $lbl }}">Full Name</label>
                                <input type="text" :name="'board_members[name][]'" x-model="m.name" placeholder="Dr. John Doe" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                            </div>
                            <div>
                                <label style="{{ $lbl }}">Role / Title</label>
                                <input type="text" :name="'board_members[role][]'" x-model="m.role" placeholder="Chairman" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                            </div>
                            <div>
                                <label style="{{ $lbl }}">Organization</label>
                                <input type="text" :name="'board_members[org][]'" x-model="m.org" placeholder="Company Name" style="{{ $inp }}" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                            </div>
                        </div>
                        <div>
                            <label style="{{ $lbl }}">Bio</label>
                            <textarea :name="'board_members[bio][]'" x-model="m.bio" rows="2" placeholder="Short biography..." style="{{ $inp }}resize:none;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';"></textarea>
                        </div>
                    </div>
                </template>
                <template x-if="members.length === 0">
                    <p style="text-align:center;color:#9ca3af;font-size:.875rem;padding:1.5rem 0;">No board members yet. Click "Add Member" to start.</p>
                </template>
            </div>
        </div>
    </div>

    {{-- Save --}}
    <div>
        <button type="submit"
                style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-weight:600;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
                onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
                onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Save About Content
        </button>
    </div>
</form>

<script>
function boardManager() {
    return {
        members: [],
        init(data) { this.members = data && data.length ? data : []; },
        addMember() { this.members.push({ name:'', role:'', org:'', bio:'', photo:'' }); },
        removeMember(i) { this.members.splice(i, 1); },
        previewPhoto(event, i) {
            var file = event.target.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = (e) => { this.members[i].photo = ''; this.members[i]._preview = e.target.result; };
            reader.readAsDataURL(file);
            // Update the img src directly since x-model won't work for blob URLs
            var img = event.target.closest('div').previousElementSibling;
            if (img && img.tagName === 'IMG') { img.src = URL.createObjectURL(file); }
        }
    }
}
</script>
@endsection
