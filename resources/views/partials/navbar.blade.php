@php use Illuminate\Support\Facades\Storage; @endphp
<nav style="background:#0d0a04;border-bottom:1px solid rgba(212,146,15,.2);position:sticky;top:0;z-index:50;box-shadow:0 2px 20px rgba(0,0,0,.6);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.25rem;">
        <div style="display:flex;align-items:center;justify-content:space-between;height:4rem;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;flex-shrink:0;">
                @php
                    $siteLogo = \App\Models\Setting::get('site_logo');
                    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
                @endphp
                @if($siteLogo)
                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2rem;width:auto;object-fit:contain;max-width:130px;">
                @else
                    <div style="display:flex;align-items:center;gap:.375rem;">
                        <div style="width:1.875rem;height:1.875rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:.4rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span style="color:#0d0a04;font-weight:800;font-size:.7rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                        </div>
                        <span style="font-weight:700;font-size:1rem;color:#f0e6c8;letter-spacing:-.01em;">{{ $siteName }}</span>
                    </div>
                @endif
            </a>

            {{-- Desktop Nav --}}
            @php $navItems = json_decode(\App\Models\Setting::get('nav_menu_items', '[]'), true) ?: [['label'=>'Home','url'=>'/'],['label'=>'About','url'=>'/about'],['label'=>'Top Startups','url'=>'/startups'],['label'=>'Top Investors','url'=>'/investors'],['label'=>'Events','url'=>'/events'],['label'=>'News','url'=>'/news']]; @endphp
            <div id="desktopNav" style="display:flex;align-items:center;gap:1.5rem;">
                @foreach($navItems as $item)
                <a href="{{ $item['url'] }}" style="font-size:.875rem;font-weight:500;color:rgba(255,255,255,.65);text-decoration:none;white-space:nowrap;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.65)';">{{ $item['label'] }}</a>
                @endforeach
            </div>

            {{-- Right side --}}
            <div style="display:flex;align-items:center;gap:.625rem;">
                {{-- Desktop auth --}}
                <div id="desktopAuth" style="display:flex;align-items:center;gap:.625rem;">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;white-space:nowrap;">Admin Panel</a>
                        @elseif(auth()->user()->hasRole('investor'))
                            <a href="{{ route('investor.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;white-space:nowrap;">Dashboard</a>
                        @elseif(auth()->user()->hasRole('seeker'))
                            <a href="{{ route('seeker.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;white-space:nowrap;">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="font-size:.8125rem;color:rgba(255,255,255,.45);background:none;border:none;cursor:pointer;white-space:nowrap;">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" style="font-size:.8125rem;font-weight:500;color:rgba(255,255,255,.65);text-decoration:none;white-space:nowrap;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.65)';">Login</a>
                        <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.8125rem;font-weight:700;padding:.45rem 1rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;">Join as Investor</a>
                        <a id="seekerBtn" href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.4);color:#d4920f;font-size:.8125rem;font-weight:600;padding:.45rem 1rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;">Join as Seeker</a>
                    @endauth
                </div>

                {{-- Hamburger --}}
                <button id="mobileToggle" onclick="toggleNav()" style="background:rgba(212,146,15,.1);border:1px solid rgba(212,146,15,.2);border-radius:.5rem;cursor:pointer;color:#d4920f;padding:.4rem .5rem;display:none;align-items:center;justify-content:center;">
                    <svg id="menuIcon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="closeIcon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" style="display:none;border-top:1px solid rgba(212,146,15,.12);padding:.75rem 0 1.25rem;">
            @foreach($navItems as $item)
            <a href="{{ $item['url'] }}" style="display:block;padding:.625rem .5rem;font-size:.9375rem;color:rgba(255,255,255,.7);text-decoration:none;border-radius:.5rem;font-weight:500;" onmouseover="this.style.background='rgba(212,146,15,.08)';this.style.color='#d4920f';" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,.7)';">{{ $item['label'] }}</a>
            @endforeach
            <div style="border-top:1px solid rgba(212,146,15,.1);margin-top:.75rem;padding-top:.75rem;display:flex;flex-direction:column;gap:.5rem;">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" style="font-size:.875rem;font-weight:600;color:#d4920f;text-decoration:none;padding:.5rem;">Admin Panel</a>
                    @else
                        <a href="{{ auth()->user()->hasRole('investor') ? route('investor.dashboard') : route('seeker.dashboard') }}" style="font-size:.875rem;font-weight:600;color:#d4920f;text-decoration:none;padding:.5rem;">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="font-size:.875rem;color:rgba(255,255,255,.45);background:none;border:none;cursor:pointer;padding:.5rem 0;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="font-size:.9375rem;font-weight:500;color:rgba(255,255,255,.7);text-decoration:none;padding:.5rem;">Login</a>
                    <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.75rem 1rem;border-radius:.625rem;text-decoration:none;text-align:center;font-size:.9375rem;">Join as Investor</a>
                    <a href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.35);color:#d4920f;font-weight:600;padding:.75rem 1rem;border-radius:.625rem;text-decoration:none;text-align:center;font-size:.9375rem;">Join as Seeker</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
var navOpen = false;
function toggleNav() {
    navOpen = !navOpen;
    document.getElementById('mobileMenu').style.display = navOpen ? 'block' : 'none';
    document.getElementById('menuIcon').style.display = navOpen ? 'none' : 'block';
    document.getElementById('closeIcon').style.display = navOpen ? 'block' : 'none';
}
(function(){
    function resize(){
        var w = window.innerWidth;
        var dn = document.getElementById('desktopNav');
        var da = document.getElementById('desktopAuth');
        var mt = document.getElementById('mobileToggle');
        var sb = document.getElementById('seekerBtn');
        var mm = document.getElementById('mobileMenu');
        if(w >= 900){
            if(dn) dn.style.display = 'flex';
            if(da) da.style.display = 'flex';
            if(mt) mt.style.display = 'none';
            if(sb) sb.style.display = 'inline-block';
            if(mm){ mm.style.display = 'none'; navOpen = false; }
        } else {
            if(dn) dn.style.display = 'none';
            if(da) da.style.display = 'none';
            if(mt) mt.style.display = 'flex';
            if(sb) sb.style.display = 'none';
        }
    }
    window.addEventListener('resize', resize);
    document.addEventListener('DOMContentLoaded', resize);
    resize();
})();
</script>
