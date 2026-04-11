@extends('layouts.admin')
@section('title', 'Header Settings')
@section('page-title', 'Header Settings')

@section('content')
<div style="max-width:48rem;">
    <div style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1rem;padding:1.75rem;">
        <form method="POST" action="{{ route('admin.settings.header.update') }}" enctype="multipart/form-data"
              style="display:flex;flex-direction:column;gap:1.75rem;" x-data="menuManager()" x-init="init({{ json_encode($menuItems) }})">
            @csrf

            {{-- Logo --}}
            <div>
                <label style="display:block;font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em;">Header Logo</label>
                @php $logo = \App\Models\Setting::get('site_logo'); @endphp
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo" style="height:2.5rem;margin-bottom:.875rem;border-radius:.5rem;display:block;">
                @endif
                <label style="display:inline-flex;align-items:center;gap:.5rem;cursor:pointer;background:rgba(212,146,15,.08);border:1px solid rgba(212,146,15,.25);color:#d4920f;border-radius:.625rem;padding:.5rem 1rem;font-size:.875rem;font-weight:600;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/></svg>
                    Upload Logo
                    <input type="file" name="site_logo" accept="image/*" style="display:none;">
                </label>
                <p style="font-size:.75rem;color:#6b5c3e;margin-top:.5rem;">Recommended: PNG or SVG with transparent background</p>
            </div>

            {{-- Nav Menu Items --}}
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                    <label style="font-size:.8125rem;font-weight:600;color:rgba(212,146,15,.7);text-transform:uppercase;letter-spacing:.05em;">Navigation Menu Items</label>
                    <button type="button" @click="addItem"
                        style="display:inline-flex;align-items:center;gap:.375rem;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.8125rem;font-weight:700;padding:.4rem .875rem;border-radius:.5rem;border:none;cursor:pointer;">
                        + Add Item
                    </button>
                </div>

                <div style="display:flex;flex-direction:column;gap:.625rem;">
                    <template x-for="(item, index) in items" :key="index">
                        <div style="display:flex;align-items:center;gap:.625rem;background:#0d0a04;border:1px solid rgba(212,146,15,.12);border-radius:.625rem;padding:.625rem .875rem;">
                            <span style="font-size:.75rem;color:#6b5c3e;width:1.25rem;text-align:center;flex-shrink:0;" x-text="index + 1"></span>
                            <input type="text" :name="'menu_label[]'" x-model="item.label" placeholder="Label"
                                style="flex:1;background:transparent;border:none;color:#f0e6c8;font-size:.875rem;outline:none;min-width:0;">
                            <span style="color:rgba(212,146,15,.2);flex-shrink:0;">|</span>
                            <input type="text" :name="'menu_url[]'" x-model="item.url" placeholder="/url"
                                style="flex:1;background:transparent;border:none;color:#9a8a6a;font-size:.875rem;outline:none;min-width:0;">
                            <button type="button" @click="removeItem(index)" style="background:none;border:none;cursor:pointer;color:rgba(239,68,68,.5);flex-shrink:0;padding:.125rem;" onmouseover="this.style.color='#f87171';" onmouseout="this.style.color='rgba(239,68,68,.5)';">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </template>
                    <template x-if="items.length === 0">
                        <p style="font-size:.875rem;color:#6b5c3e;text-align:center;padding:1rem;">No menu items yet. Click "+ Add Item" to start.</p>
                    </template>
                </div>
            </div>

            <div>
                <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 1.75rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function menuManager() {
    return {
        items: [],
        init(data) {
            this.items = data.length ? data : [
                {label:'Home',url:'/'},
                {label:'About',url:'/about'},
                {label:'Top Startups',url:'/startups'},
                {label:'Top Investors',url:'/investors'},
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
