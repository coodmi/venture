<!DOCTYPE html>
<html lang="en" style="height:100%;background:#f8fafc;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
    </style>
</head>
<body style="height:100%;background:#f8fafc;color:#111827;margin:0;">

<div style="display:flex;height:100vh;overflow:hidden;">

    @include('partials.admin-sidebar')

    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;">

        {{-- Top bar --}}
        <header style="background:#ffffff;border-bottom:1px solid #e5e7eb;padding:0 1.5rem;display:flex;align-items:center;justify-content:space-between;height:3.75rem;flex-shrink:0;box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display:flex;align-items:center;gap:.5rem;">
                <span style="font-size:.75rem;color:#9ca3af;">Admin</span>
                <span style="color:#d1d5db;">›</span>
                <h1 style="font-size:.9375rem;font-weight:600;color:#111827;margin:0;">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div style="display:flex;align-items:center;gap:1rem;">
                <div style="position:relative;" id="adminUserMenu">
                    <button onclick="toggleAdminMenu()" style="display:flex;align-items:center;gap:.625rem;background:none;border:1px solid #e5e7eb;border-radius:.75rem;padding:.375rem .625rem .375rem .375rem;cursor:pointer;transition:all .15s;" onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='none';">
                        @php $avatar = auth()->user()->avatar ?? null; @endphp
                        @if($avatar)
                            <img src="{{ Storage::url($avatar) }}" alt="{{ auth()->user()->name }}"
                                 style="width:2rem;height:2rem;border-radius:50%;object-fit:cover;border:2px solid #e0e7ff;flex-shrink:0;">
                        @else
                            <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span style="color:#fff;font-weight:700;font-size:.75rem;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                            </div>
                        @endif
                        <div style="text-align:left;line-height:1.2;">
                            <div style="font-size:.8125rem;font-weight:600;color:#111827;">{{ auth()->user()->name }}</div>
                            <div style="font-size:.6875rem;color:#9ca3af;">Administrator</div>
                        </div>
                        <svg width="14" height="14" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24" style="margin-left:.125rem;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    {{-- Dropdown --}}
                    <div id="adminMenuDropdown" style="display:none;position:absolute;right:0;top:calc(100% + .5rem);width:13rem;background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;box-shadow:0 10px 25px rgba(0,0,0,.1);z-index:999;overflow:hidden;">
                        <div style="padding:.875rem 1rem;border-bottom:1px solid #f3f4f6;">
                            <div style="font-size:.8125rem;font-weight:600;color:#111827;">{{ auth()->user()->name }}</div>
                            <div style="font-size:.75rem;color:#9ca3af;margin-top:.125rem;">{{ auth()->user()->email }}</div>
                        </div>
                        <div style="padding:.375rem;">
                            <a href="{{ route('home') }}" target="_blank"
                               style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;transition:background .1s;"
                               onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                View Site
                            </a>
                            <a href="{{ route('admin.settings.general') }}"
                               style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;transition:background .1s;"
                               onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                                Settings
                            </a>
                        </div>
                        <div style="padding:.375rem;border-top:1px solid #f3f4f6;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        style="display:flex;align-items:center;gap:.625rem;width:100%;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#ef4444;background:none;border:none;cursor:pointer;text-align:left;transition:background .1s;"
                                        onmouseover="this.style.background='#fef2f2';" onmouseout="this.style.background='transparent';">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                function toggleAdminMenu() {
                    var d = document.getElementById('adminMenuDropdown');
                    d.style.display = d.style.display === 'none' ? 'block' : 'none';
                }
                document.addEventListener('click', function(e) {
                    var menu = document.getElementById('adminUserMenu');
                    if (menu && !menu.contains(e.target)) {
                        document.getElementById('adminMenuDropdown').style.display = 'none';
                    }
                });
                </script>
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
