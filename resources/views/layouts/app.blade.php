<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php $favicon = \App\Models\Setting::get('site_favicon'); @endphp
    <link rel="icon" type="image/png" href="{{ $favicon ? Storage::url($favicon) : asset('favicon.ico') }}">

    <title>@yield('title', config('app.name', 'VentureMatch')) — Connecting Investors & Startups</title>
    <meta name="description" content="@yield('meta_description', 'VentureMatch connects investors with high-potential startups and projects across sectors.')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', 'VentureMatch')">
    <meta property="og:description" content="@yield('meta_description', 'VentureMatch — Investment Ecosystem Platform')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-gray-900 font-sans antialiased" x-data>

    {{-- Navigation --}}
    @include('partials.navbar')

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             class="fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
