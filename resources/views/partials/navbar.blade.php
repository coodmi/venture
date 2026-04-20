@php use Illuminate\Support\Facades\Storage; @endphp
@php
    $siteLogo = \App\Models\Setting::get('site_logo');
    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
    $navItems = json_decode(\App\Models\Setting::get('nav_menu_items', '[]'), true) ?: [
        ['label'=>'Home','url'=>'/'],
        ['label'=>'About','url'=>'/about'],
        ['label'=>'Top Startups','url'=>'/startups'],
        ['label'=>'Top Investors','url'=>'/investors'],
        ['label'=>'Events','url'=>'/events'],
        ['label'=>'News','url'=>'/news'],
    ];
@endphp

<nav style="background:#fff;border-bottom:2px solid #1a3c8f;position:sticky;top:0;z-index:100;box-shadow:0 2px 12px rgba(26,60,143,.1);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.25rem;display:flex;align-items:center;justify-content:space-between;height:4.25rem;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;flex-shrink:0;">
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2.25rem;width:auto;object-fit:contain;max-width:140px;">
            @else
                <div style="display:flex;align-items:center;gap:.375rem;">
                    <div style="width:2.25rem;height:2.25rem;background:linear-gradient(135deg,#1a3c8f,#0d2b6e);border-radius:.5rem;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#fff;font-weight:800;font-size:.75rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                    </div>
                    <span style="font-weight:800;font-size:1.125rem;color:#0d2b6e;">{{ $siteName }}</span>
                </div>
            @endif
        </a>

        {{-- Desktop Nav --}}
        <div id="desktopNav" style="display:flex;align-items:center;gap:1.75rem;">
            @foreach($navItems as $item)
            <a href="{{ $item['url'] }}" style="font-size:.875rem;font-weight:600;color:#374151;text-decoration:none;white-space:nowrap;padding:.25rem 0;border-bottom:2px solid transparent;transition:all .2s;" onmouseover="this.style.color='#1a3c8f';this.style.borderBottomColor='#f97316';" onmouseout="this.style.color='#374151';this.style.borderBottomColor='transparent';">{{ $item['label'] }}</a>
            @endforeach
        </div>

        {{-- Auth + Hamburger --}}
        <div style="display:flex;align-items:center;gap:.625rem;">
            <div id="desktopAuth" style="display:flex;align-items:center;gap:.625rem;">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#1a3c8f;text-decoration:none;">Admin Panel</a>
                    @elseif(auth()->user()->hasRole('investor'))
                        <a href="{{ route('investor.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#1a3c8f;text-decoration:none;">Dashboard</a>
                    @elseif(auth()->user()->hasRole('seeker'))
                        <a href="{{ route('seeker.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#1a3c8f;text-decoration:none;">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">@csrf
                        <button type="submit" style="font-size:.8125rem;color:#6b7280;background:none;border:none;cursor:pointer;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="font-size:.8125rem;font-weight:600;color:#1a3c8f;text-decoration:none;padding:.45rem .875rem;border-radius:.5rem;border:1px solid #1a3c8f;" onmouseover="this.style.background='#1a3c8f';this.style.color='#fff';" onmouseout="this.style.background='transparent';this.style.color='#1a3c8f';">Login</a>
                    <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-size:.8125rem;font-weight:700;padding:.45rem 1.125rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;" onmouseover="this.style.background='#ea6c0a';" onmouseout="this.style.background='#f97316';">Join as Investor</a>
                    <a id="seekerBtn" href="{{ route('register.seeker') }}" style="background:#1a3c8f;color:#fff;font-size:.8125rem;font-weight:700;padding:.45rem 1.125rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;" onmouseover="this.style.background='#0d2b6e';" onmouseout="this.style.background='#1a3c8f';">Join as Seeker</a>
                @endauth
            </div>

            {{-- Hamburger --}}
            <button id="hamburger" onclick="openDrawer()" style="display:none;background:#1a3c8f;border:none;border-radius:.5rem;cursor:pointer;padding:.45rem .55rem;color:#fff;align-items:center;justify-content:center;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</nav>

{{-- Overlay --}}
<div id="drawerOverlay" onclick="closeDrawer()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;"></div>

{{-- Slide-in Drawer --}}
<div id="drawer" style="position:fixed;top:0;right:-320px;width:300px;height:100vh;background:#fff;border-left:3px solid #1a3c8f;z-index:300;transition:right .3s cubic-bezier(.4,0,.2,1);overflow-y:auto;box-shadow:-8px 0 30px rgba(0,0,0,.15);">
    <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem;border-bottom:2px solid #1a3c8f;background:#0d2b6e;">
        <a href="{{ route('home') }}" style="text-decoration:none;">
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:1.75rem;width:auto;object-fit:contain;">
            @else
                <span style="font-weight:800;font-size:.9375rem;color:#fff;">{{ $siteName }}</span>
            @endif
        </a>
        <button onclick="closeDrawer()" style="background:rgba(255,255,255,.15);border:none;border-radius:.5rem;cursor:pointer;padding:.375rem;color:#fff;display:flex;align-items:center;justify-content:center;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <div style="padding:1rem 1.25rem;">
        @foreach($navItems as $item)
        <a href="{{ $item['url'] }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem .875rem;font-size:.9375rem;font-weight:600;color:#374151;text-decoration:none;border-radius:.625rem;margin-bottom:.25rem;border-left:3px solid transparent;" onmouseover="this.style.background='#eff6ff';this.style.color='#1a3c8f';this.style.borderLeftColor='#f97316';" onmouseout="this.style.background='transparent';this.style.color='#374151';this.style.borderLeftColor='transparent';">
            {{ $item['label'] }}
        </a>
        @endforeach
    </div>

    <div style="padding:1rem 1.25rem;border-top:1px solid #e5e7eb;margin-top:.5rem;">
        @auth
            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:.875rem;padding:1rem;margin-bottom:1rem;">
                <p style="font-size:.75rem;color:#1a3c8f;margin:0 0 .25rem;font-weight:600;">Logged in as</p>
                <p style="font-size:.9375rem;font-weight:700;color:#0d2b6e;margin:0;">{{ auth()->user()->name }}</p>
            </div>
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" style="display:block;background:#1a3c8f;color:#fff;font-weight:700;padding:.75rem 1rem;border-radius:.625rem;text-decoration:none;text-align:center;margin-bottom:.625rem;">Admin Panel</a>
            @else
                <a href="{{ auth()->user()->hasRole('investor') ? route('investor.dashboard') : route('seeker.dashboard') }}" style="display:block;background:#1a3c8f;color:#fff;font-weight:700;padding:.75rem 1rem;border-radius:.625rem;text-decoration:none;text-align:center;margin-bottom:.625rem;">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" style="width:100%;background:#f1f5f9;border:1px solid #e5e7eb;color:#6b7280;font-size:.875rem;padding:.625rem;border-radius:.625rem;cursor:pointer;">Logout</button>
            </form>
        @else
            <a href="{{ route('register.investor') }}" style="display:block;background:#f97316;color:#fff;font-weight:700;padding:.875rem 1rem;border-radius:.75rem;text-decoration:none;text-align:center;font-size:.9375rem;margin-bottom:.625rem;">🚀 Join as Investor</a>
            <a href="{{ route('register.seeker') }}" style="display:block;background:#1a3c8f;color:#fff;font-weight:700;padding:.875rem 1rem;border-radius:.75rem;text-decoration:none;text-align:center;font-size:.9375rem;margin-bottom:.625rem;">💡 Join as Seeker</a>
            <a href="{{ route('login') }}" style="display:block;background:#f8fafc;border:1px solid #e5e7eb;color:#374151;font-weight:500;padding:.75rem 1rem;border-radius:.75rem;text-decoration:none;text-align:center;font-size:.875rem;">Login</a>
        @endauth
    </div>
</div>

<script>
function openDrawer(){document.getElementById('drawer').style.right='0';document.getElementById('drawerOverlay').style.display='block';document.body.style.overflow='hidden';}
function closeDrawer(){document.getElementById('drawer').style.right='-320px';document.getElementById('drawerOverlay').style.display='none';document.body.style.overflow='';}
(function(){
    function resize(){
        var w=window.innerWidth;
        var dn=document.getElementById('desktopNav');
        var da=document.getElementById('desktopAuth');
        var hb=document.getElementById('hamburger');
        var sb=document.getElementById('seekerBtn');
        if(w>=960){if(dn)dn.style.display='flex';if(da)da.style.display='flex';if(hb)hb.style.display='none';if(sb)sb.style.display='inline-block';}
        else{if(dn)dn.style.display='none';if(da)da.style.display='none';if(hb)hb.style.display='flex';if(sb)sb.style.display='none';}
    }
    window.addEventListener('resize',resize);document.addEventListener('DOMContentLoaded',resize);resize();
})();
</script>
