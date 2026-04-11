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

<nav style="background:#0d0a04;border-bottom:1px solid rgba(212,146,15,.2);position:sticky;top:0;z-index:100;box-shadow:0 2px 20px rgba(0,0,0,.6);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.25rem;display:flex;align-items:center;justify-content:space-between;height:4rem;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;flex-shrink:0;">
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:1.875rem;width:auto;object-fit:contain;max-width:120px;">
            @else
                <div style="display:flex;align-items:center;gap:.375rem;">
                    <div style="width:1.875rem;height:1.875rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:.4rem;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#0d0a04;font-weight:800;font-size:.7rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                    </div>
                    <span style="font-weight:700;font-size:1rem;color:#f0e6c8;">{{ $siteName }}</span>
                </div>
            @endif
        </a>

        {{-- Desktop Nav --}}
        <div id="desktopNav" style="display:flex;align-items:center;gap:1.5rem;">
            @foreach($navItems as $item)
            <a href="{{ $item['url'] }}" style="font-size:.875rem;font-weight:500;color:rgba(255,255,255,.65);text-decoration:none;white-space:nowrap;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.65)';">{{ $item['label'] }}</a>
            @endforeach
        </div>

        {{-- Desktop Auth + Hamburger --}}
        <div style="display:flex;align-items:center;gap:.625rem;">
            <div id="desktopAuth" style="display:flex;align-items:center;gap:.625rem;">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;">Admin Panel</a>
                    @elseif(auth()->user()->hasRole('investor'))
                        <a href="{{ route('investor.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;">Dashboard</a>
                    @elseif(auth()->user()->hasRole('seeker'))
                        <a href="{{ route('seeker.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">@csrf
                        <button type="submit" style="font-size:.8125rem;color:rgba(255,255,255,.45);background:none;border:none;cursor:pointer;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="font-size:.8125rem;font-weight:500;color:rgba(255,255,255,.65);text-decoration:none;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.65)';">Login</a>
                    <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.8125rem;font-weight:700;padding:.45rem 1rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;">Join as Investor</a>
                    <a id="seekerBtn" href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.4);color:#d4920f;font-size:.8125rem;font-weight:600;padding:.45rem 1rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;">Join as Seeker</a>
                @endauth
            </div>

            {{-- Hamburger --}}
            <button id="hamburger" onclick="openDrawer()" style="display:none;background:rgba(212,146,15,.12);border:1px solid rgba(212,146,15,.25);border-radius:.5rem;cursor:pointer;padding:.45rem .55rem;color:#d4920f;align-items:center;justify-content:center;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</nav>

{{-- Overlay --}}
<div id="drawerOverlay" onclick="closeDrawer()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:200;backdrop-filter:blur(2px);"></div>

{{-- Slide-in Drawer --}}
<div id="drawer" style="position:fixed;top:0;right:-320px;width:300px;height:100vh;background:#0d0a04;border-left:1px solid rgba(212,146,15,.2);z-index:300;transition:right .3s cubic-bezier(.4,0,.2,1);overflow-y:auto;box-shadow:-8px 0 30px rgba(0,0,0,.5);">
    {{-- Drawer Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.25rem 1rem;border-bottom:1px solid rgba(212,146,15,.12);">
        <a href="{{ route('home') }}" style="text-decoration:none;">
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:1.75rem;width:auto;object-fit:contain;">
            @else
                <span style="font-weight:700;font-size:.9375rem;color:#f0e6c8;">{{ $siteName }}</span>
            @endif
        </a>
        <button onclick="closeDrawer()" style="background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.2);border-radius:.5rem;cursor:pointer;padding:.375rem;color:#d4920f;display:flex;align-items:center;justify-content:center;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Nav Links --}}
    <div style="padding:1rem 1.25rem;">
        @foreach($navItems as $item)
        <a href="{{ $item['url'] }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem .875rem;font-size:.9375rem;font-weight:500;color:rgba(255,255,255,.7);text-decoration:none;border-radius:.625rem;margin-bottom:.25rem;transition:all .2s;" onmouseover="this.style.background='rgba(212,146,15,.1)';this.style.color='#d4920f';" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,.7)';">
            <span style="width:.375rem;height:.375rem;background:rgba(212,146,15,.4);border-radius:50%;flex-shrink:0;"></span>
            {{ $item['label'] }}
        </a>
        @endforeach
    </div>

    {{-- Auth Buttons --}}
    <div style="padding:1rem 1.25rem;border-top:1px solid rgba(212,146,15,.12);margin-top:.5rem;">
        @auth
            <div style="background:rgba(212,146,15,.08);border:1px solid rgba(212,146,15,.15);border-radius:.875rem;padding:1rem;margin-bottom:1rem;">
                <p style="font-size:.75rem;color:rgba(212,146,15,.6);margin:0 0 .25rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600;">Logged in as</p>
                <p style="font-size:.9375rem;font-weight:700;color:#f0e6c8;margin:0;">{{ auth()->user()->name }}</p>
            </div>
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.75rem 1rem;border-radius:.625rem;text-decoration:none;text-align:center;margin-bottom:.625rem;">Admin Panel</a>
            @else
                <a href="{{ auth()->user()->hasRole('investor') ? route('investor.dashboard') : route('seeker.dashboard') }}" style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.75rem 1rem;border-radius:.625rem;text-decoration:none;text-align:center;margin-bottom:.625rem;">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.5);font-size:.875rem;padding:.625rem;border-radius:.625rem;cursor:pointer;">Logout</button>
            </form>
        @else
            <a href="{{ route('register.investor') }}" style="display:block;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.875rem 1rem;border-radius:.75rem;text-decoration:none;text-align:center;font-size:.9375rem;margin-bottom:.625rem;">
                🚀 Join as Investor
            </a>
            <a href="{{ route('register.seeker') }}" style="display:block;border:1px solid rgba(212,146,15,.35);color:#d4920f;font-weight:600;padding:.875rem 1rem;border-radius:.75rem;text-decoration:none;text-align:center;font-size:.9375rem;margin-bottom:.625rem;">
                💡 Join as Seeker
            </a>
            <a href="{{ route('login') }}" style="display:block;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.6);font-weight:500;padding:.75rem 1rem;border-radius:.75rem;text-decoration:none;text-align:center;font-size:.875rem;">
                Login
            </a>
        @endauth
    </div>
</div>

<script>
function openDrawer(){
    document.getElementById('drawer').style.right='0';
    document.getElementById('drawerOverlay').style.display='block';
    document.body.style.overflow='hidden';
}
function closeDrawer(){
    document.getElementById('drawer').style.right='-320px';
    document.getElementById('drawerOverlay').style.display='none';
    document.body.style.overflow='';
}
(function(){
    function resize(){
        var w=window.innerWidth;
        var dn=document.getElementById('desktopNav');
        var da=document.getElementById('desktopAuth');
        var hb=document.getElementById('hamburger');
        var sb=document.getElementById('seekerBtn');
        if(w>=960){
            if(dn)dn.style.display='flex';
            if(da)da.style.display='flex';
            if(hb)hb.style.display='none';
            if(sb)sb.style.display='inline-block';
        } else {
            if(dn)dn.style.display='none';
            if(da)da.style.display='none';
            if(hb)hb.style.display='flex';
            if(sb)sb.style.display='none';
        }
    }
    window.addEventListener('resize',resize);
    document.addEventListener('DOMContentLoaded',resize);
    resize();
})();
</script>
