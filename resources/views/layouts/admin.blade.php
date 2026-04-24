<!DOCTYPE html>
<html lang="en" style="height:100%;background:#f4f7fb;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="height:100%;font-family:'Plus Jakarta Sans',sans-serif;background:#f4f7fb;color:#0f172a;margin:0;" x-data="{ sidebarOpen: false }">

<div style="display:flex;height:100vh;overflow:hidden;">

    @include('partials.admin-sidebar')

    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;">

        {{-- Top bar --}}
        <header style="background:#fff;border-bottom:1px solid #dde3ea;padding:0 1.5rem;display:flex;align-items:center;justify-content:space-between;height:4rem;flex-shrink:0;box-shadow:0 1px 4px rgba(0,0,0,.06);">
            <h1 style="font-size:1rem;font-weight:700;color:#0d2b6e;margin:0;">@yield('page-title', 'Dashboard')</h1>
            <div style="display:flex;align-items:center;gap:1rem;">
                <a href="{{ route('home') }}" target="_blank" style="font-size:.8125rem;color:#8d98a1;text-decoration:none;" onmouseover="this.style.color='#1a3c8f';" onmouseout="this.style.color='#8d98a1';">View Site →</a>
                <div style="display:flex;align-items:center;gap:.625rem;">
                    <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#1a3c8f,#2563eb);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#fff;font-weight:800;font-size:.75rem;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                    </div>
                    <span style="font-size:.8125rem;color:#374151;font-weight:500;">{{ auth()->user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="font-size:.8125rem;color:#ef4444;background:none;border:none;cursor:pointer;font-weight:500;" onmouseover="this.style.color='#dc2626';" onmouseout="this.style.color='#ef4444';">Logout</button>
                </form>
            </div>
        </header>

        @if(session('success'))
        <div style="margin:1rem 1.5rem 0;background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;">
            ✓ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="margin:1rem 1.5rem 0;background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:.75rem 1rem;border-radius:.75rem;font-size:.875rem;">
            {{ session('error') }}
        </div>
        @endif

        <main style="flex:1;overflow-y:auto;padding:1.5rem;background:#f4f7fb;">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
