<!DOCTYPE html>
<html lang="en" style="height:100%;background:#f8fafc;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — VentureMatch</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
    </style>
</head>
<body style="height:100%;background:#f8fafc;color:#111827;margin:0;">

<div style="display:flex;height:100vh;overflow:hidden;">

    {{-- Sidebar --}}
    @include('partials.dashboard-sidebar')

    {{-- Main --}}
    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;">

        {{-- Top bar --}}
        <header style="background:#ffffff;border-bottom:1px solid #e5e7eb;padding:0 1.5rem;display:flex;align-items:center;justify-content:space-between;height:3.75rem;flex-shrink:0;box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display:flex;align-items:center;gap:.5rem;">
                <span style="font-size:.75rem;color:#9ca3af;">Dashboard</span>
                <span style="color:#d1d5db;">›</span>
                <h1 style="font-size:.9375rem;font-weight:600;color:#111827;margin:0;">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div style="display:flex;align-items:center;gap:.75rem;">
                <a href="{{ route('home') }}" target="_blank"
                   style="display:flex;align-items:center;gap:.375rem;font-size:.8125rem;color:#6b7280;text-decoration:none;padding:.375rem .75rem;border:1px solid #e5e7eb;border-radius:.5rem;transition:all .15s;"
                   onmouseover="this.style.background='#f9fafb';this.style.color='#374151';"
                   onmouseout="this.style.background='transparent';this.style.color='#6b7280';">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Site
                </a>
            </div>
        </header>

        @if(session('success'))
        <div style="margin:1rem 1.5rem 0;background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;display:flex;align-items:center;gap:.5rem;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="margin:1rem 1.5rem 0;background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;display:flex;align-items:center;gap:.5rem;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <main style="flex:1;overflow-y:auto;padding:1.5rem;background:#f8fafc;">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
