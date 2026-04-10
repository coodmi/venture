@extends('layouts.admin')
@section('title', 'Header Settings')
@section('page-title', 'Header Settings')

@section('content')
<div class="max-w-2xl space-y-4">
    <div class="flex gap-3 mb-6 flex-wrap">
        <a href="{{ route('admin.settings.general') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">General</a>
        <a href="{{ route('admin.settings.header') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg">Header</a>
        <a href="{{ route('admin.settings.stats') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">Platform Stats</a>
        <a href="{{ route('admin.settings.testimonials') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">Testimonials</a>
        <a href="{{ route('admin.settings.about') }}" class="border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50">About Content</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.settings.header.update') }}" enctype="multipart/form-data"
              class="space-y-6" x-data="menuManager()" x-init="init({{ json_encode($menuItems) }})">
            @csrf

            {{-- Logo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Header Logo</label>
                @php $logo = \App\Models\Setting::get('site_logo'); @endphp
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo" class="h-10 mb-3 rounded">
                @endif
                <label class="inline-flex items-center gap-2 cursor-pointer border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/></svg>
                    Upload Logo
                    <input type="file" name="site_logo" accept="image/*" class="hidden">
                </label>
            </div>

            {{-- Nav Menu Items --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Navigation Menu Items</label>
                    <button type="button" @click="addItem"
                        class="inline-flex items-center gap-1 bg-primary-600 text-white text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-primary-700">
                        + Add Menu Item
                    </button>
                </div>

                <div class="space-y-3">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-5 text-center" x-text="index + 1"></span>
                            <input type="text" :name="'menu_label[]'" x-model="item.label" placeholder="Label"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <input type="text" :name="'menu_url[]'" x-model="item.url" placeholder="/url"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <button type="button" @click="removeItem(index)" class="text-red-400 hover:text-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <button type="submit" class="bg-primary-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                Save Settings
            </button>
        </form>
    </div>
</div>

<script>
function menuManager() {
    return {
        items: [],
        init(data) { this.items = data.length ? data : [{label:'Home',url:'/'},{label:'About',url:'/about'},{label:'Events',url:'/events'},{label:'News',url:'/news'},{label:'Membership',url:'/membership'}]; },
        addItem() { this.items.push({label:'',url:'/'}); },
        removeItem(i) { this.items.splice(i,1); }
    }
}
</script>
@endsection
