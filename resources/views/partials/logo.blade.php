@php
    use Illuminate\Support\Facades\Storage;
    $siteLogo = \App\Models\Setting::get('site_logo');
    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
@endphp
@if($siteLogo)
    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="{{ $logoClass ?? 'h-8 w-auto object-contain max-w-[140px]' }}">
@else
    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
        <span class="text-white font-bold text-sm">{{ strtoupper(substr($siteName, 0, 2)) }}</span>
    </div>
    <span class="{{ $nameClass ?? 'font-bold text-lg text-gray-900' }}">{{ $siteName }}</span>
@endif
