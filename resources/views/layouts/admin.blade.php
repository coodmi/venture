<!DOCTYPE html>
<html lang="en" style="height:100%;background:#0d0a04;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="height:100%;font-family:'Inter',sans-serif;background:#0d0a04;color:#f0e6c8;margin:0;" x-data="{ sidebarOpen: false }">

<div style="display:flex;height:100vh;overflow:hidden;">

    {{-- Sidebar --}}
    @include('partials.admin-sidebar')

    {{-- Main --}}
    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;">

        {{-- Top bar --}}
        <header style="background:#110e05;border-bottom:1px solid rgba(212,146,15,.15);padding:0 1.5rem;display:flex;align-items:center;justify-content:space-between;height:4rem;flex-shrink:0;box-shadow:0 2px 10px rgba(0,0,0,.3);">
            <div style="display:flex;align-items:center;gap:1rem;">
                <button @click="sidebarOpen = !sidebarOpen" style="background:none;border:none;cursor:pointer;color:rgba(212,146,15,.6);padding:.25rem;display:none;" id="adminMenuBtn">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 style="font-size:1rem;font-weight:700;color:#f0e6c8;margin:0;">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div style="display:flex;align-items:center;gap:1rem;">
                <a href="{{ route('home') }}" target="_blank" style="font-size:.8125rem;color:rgba(212,146,15,.6);text-decoration:none;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(212,146,15,.6)';">View Site →</a>
                <div style="display:flex;align-items:center;gap:.625rem;">
                    <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#0d0a04;font-weight:800;font-size:.75rem;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                    </div>
                    <span style="font-size:.8125rem;color:#c9b48a;">{{ auth()->user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="font-size:.8125rem;color:rgba(239,68,68,.6);background:none;border:none;cursor:pointer;" onmouseover="this.style.color='#f87171';" onmouseout="this.style.color='rgba(239,68,68,.6)';">Logout</button>
                </form>
            </div>
        </header>

        {{-- Flash --}}
        @if(session('success'))
        <div style="margin:1rem 1.5rem 0;background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#34d399;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;">
            ✓ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="margin:1rem 1.5rem 0;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#f87171;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;">
            {{ session('error') }}
        </div>
        @endif

        {{-- Content --}}
        <main style="flex:1;overflow-y:auto;padding:1.5rem;background:#0d0a04;">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
