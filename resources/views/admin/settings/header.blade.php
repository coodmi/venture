@extends('layouts.admin')
@section('title', 'Header Settings')
@section('page-title', 'Header Settings')

@section('content')
<form method="POST" action="{{ route('admin.settings.header.update') }}" enctype="multipart/form-data"
      x-data="menuManager()" x-init="init({{ json_encode($menuItems) }})">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 2fr;gap:1.25rem;align-items:start;">

        {{-- Left: Logo --}}
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
            <label style="display:block;font-size:.8125rem;font-weight:600;color:#374151;margin-bottom:1rem;text-transform:uppercase;letter-spacing:.05em;">Header Logo</label>
            @php $logo = \App\Models\Setting::get('site_logo'); @endphp
            @if($logo)
                <img src="{{ Storage::url($logo) }}" alt="Logo" style="height:2.5rem;margin-bottom:1rem;border-radius:.5rem;display:block;">
            @endif
            <label style="display:inline-flex;align-items:center;gap:.5rem;cursor:pointer;background:#eef2ff;border:1px solid #c7d2fe;color:#6366f1;border-radius:.625rem;padding:.5rem 1rem;font-size:.875rem;font-weight:600;transition:background .15s;"
                   onmouseover="this.style.background='#e0e7ff';" onmouseout="this.style.background='#eef2ff';">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/></svg>
                Upload Logo
                <input type="file" name="site_logo" accept="image/*" style="display:none;">
            </label>
            <p style="font-size:.75rem;color:#9ca3af;margin-top:.625rem;">Recommended: PNG or SVG with transparent background</p>
        </div>

        {{-- Right: Nav Items --}}
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                <label style="font-size:.8125rem;font-weight:600;color:#374151;text-transform:uppercase;letter-spacing:.05em;">Navigation Menu Items</label>
                <button type="button" @click="addItem"
                    style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.8125rem;font-weight:600;padding:.4rem .875rem;border-radius:.5rem;border:none;cursor:pointer;transition:background .15s;"
                    onmouseover="this.style.background='#4f46e5';" onmouseout="this.style.background='#6366f1';">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Add Item
                </button>
            </div>

            <div style="display:flex;flex-direction:column;gap:.625rem;">
                <template x-for="(item, index) in items" :key="index">
                    <div style="display:flex;align-items:center;gap:.625rem;background:#f8fafc;border:1px solid #e5e7eb;border-radius:.625rem;padding:.625rem .875rem;">
                        <span style="font-size:.75rem;color:#9ca3af;width:1.25rem;text-align:center;flex-shrink:0;font-weight:600;" x-text="index + 1"></span>
                        <input type="text" :name="'menu_label[]'" x-model="item.label" placeholder="Label"
                            style="flex:1;background:transparent;border:none;color:#111827;font-size:.875rem;outline:none;min-width:0;font-weight:500;">
                        <span style="color:#e5e7eb;flex-shrink:0;">|</span>
                        <input type="text" :name="'menu_url[]'" x-model="item.url" placeholder="/url"
                            style="flex:1;background:transparent;border:none;color:#6b7280;font-size:.875rem;outline:none;min-width:0;">
                        <button type="button" @click="removeItem(index)"
                                style="background:none;border:none;cursor:pointer;color:#fca5a5;flex-shrink:0;padding:.125rem;transition:color .15s;"
                                onmouseover="this.style.color='#ef4444';" onmouseout="this.style.color='#fca5a5';">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
                <template x-if="items.length === 0">
                    <p style="font-size:.875rem;color:#9ca3af;text-align:center;padding:1.5rem;">No menu items yet. Click "Add Item" to start.</p>
                </template>
            </div>

            <div style="margin-top:1.25rem;">
                <button type="submit"
                        style="background:#6366f1;color:#fff;font-weight:600;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
                        onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
                        onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
                    Save Settings
                </button>
            </div>
        </div>

    </div>
</form>

<script>
function menuManager() {
    return {
        items: [],
        init(data) {
            this.items = data.length ? data : [
                {label:'Home',url:'/'},
                {label:'About',url:'/about'},
                {label:'Top Startups',url:'/startups'},
                {label:'Events',url:'/events'},
                {label:'News',url:'/news'}
            ];
        },
        addItem() { this.items.push({label:'',url:'/'}); },
        removeItem(i) { this.items.splice(i,1); }
    }
}
</script>
@endsection
