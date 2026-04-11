@php use Illuminate\Support\Facades\Storage; @endphp
<nav id="mainNav" style="background:#0d0a04;border-bottom:1px solid rgba(212,146,15,.2);position:sticky;top:0;z-index:50;box-shadow:0 2px 20px rgba(0,0,0,.6);">
    <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:center;justify-content:space-between;height:4.25rem;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;flex-shrink:0;">
                @php
                    $siteLogo = \App\Models\Setting::get('site_logo');
                    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
                @endphp
                @if($siteLogo)
                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2rem;width:auto;object-fit:contain;max-width:140px;">
                @else
                    <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <span style="color:#0d0a04;font-weight:800;font-size:.75rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                    </div>
                    <span style="font-weight:700;font-size:1.125rem;color:#fff;">{{ $siteName }}</span>
                @endif
            </a>

            {{-- Desktop Nav --}}
            @php $navItems = json_decode(\App\Models\Setting::get('nav_menu_items', '[]'), true) ?: [['label'=>'Home','url'=>'/'],['label'=>'About','url'=>'/about'],['label'=>'Top Startups','url'=>'/startups'],['label'=>'Top Investors','url'=>'/investors'],['label'=>'Events','url'=>'/events'],['label'=>'News','url'=>'/news']]; @endphp
            <div id="desktopNav" style="display:flex;align-items:center;gap:1.75rem;">
                @foreach($navItems as $item)
                <a href="{{ $item['url'] }}" style="font-size:.875rem;font-weight:500;color:rgba(255,255,255,.7);text-decoration:none;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.7)';">{{ $item['label'] }}</a>
                @endforeach
            </div>

            {{-- Auth + Mobile --}}
            <div style="display:flex;align-items:center;gap:.75rem;">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;">Admin Panel</a>
                    @elseif(auth()->user()->hasRole('investor'))
                        <a href="{{ route('investor.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;">Dashboard</a>
                    @elseif(auth()->user()->hasRole('seeker'))
                        <a href="{{ route('seeker.dashboard') }}" style="font-size:.8125rem;font-weight:600;color:#d4920f;text-decoration:none;">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="font-size:.8125rem;color:rgba(255,255,255,.5);background:none;border:none;cursor:pointer;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="font-size:.8125rem;font-weight:500;color:rgba(255,255,255,.7);text-decoration:none;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.7)';">Login</a>
                    <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.8125rem;font-weight:700;padding:.5rem 1.125rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;">Join as Investor</a>
                    <a id="seekerBtn" href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.5);color:#d4920f;font-size:.8125rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;">Join as Seeker</a>
                @endauth

                {{-- Mobile toggle --}}
                <button id="mobileToggle" onclick="toggleMobileMenu()" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,.7);padding:.25rem;display:none;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" style="display:none;border-top:1px solid rgba(212,146,15,.15);padding:.75rem 0 1rem;">
            @foreach($navItems as $item)
            <a href="{{ $item['url'] }}" style="display:block;padding:.5rem .75rem;font-size:.875rem;color:rgba(255,255,255,.7);text-decoration:none;border-radius:.5rem;" onmouseover="this.style.background='rgba(212,146,15,.1)';this.style.color='#d4920f';" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,.7)';">{{ $item['label'] }}</a>
            @endforeach
            @guest
            <div style="padding:.75rem .75rem 0;display:flex;flex-direction:column;gap:.5rem;">
                <a href="{{ route('register.investor') }}" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.875rem;font-weight:700;padding:.625rem 1rem;border-radius:.5rem;text-decoration:none;text-align:center;">Join as Investor</a>
                <a href="{{ route('register.seeker') }}" style="border:1px solid rgba(212,146,15,.4);color:#d4920f;font-size:.875rem;font-weight:600;padding:.625rem 1rem;border-radius:.5rem;text-decoration:none;text-align:center;">Join as Seeker</a>
            </div>
            @endguest
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu(){
    var m=document.getElementById('mobileMenu');
    m.style.display=m.style.display==='none'?'block':'none';
}
(function(){
    function handleResize(){
        var w=window.innerWidth;
        var dn=document.getElementById('desktopNav');
        var mt=document.getElementById('mobileToggle');
        var sb=document.getElementById('seekerBtn');
        var mm=document.getElementById('mobileMenu');
        if(w>=900){
            if(dn)dn.style.display='flex';
            if(mt)mt.style.display='none';
            if(sb)sb.style.display='inline-block';
            if(mm)mm.style.display='none';
        } else {
            if(dn)dn.style.display='none';
            if(mt)mt.style.display='block';
            if(sb)sb.style.display='none';
        }
    }
    window.addEventListener('resize',handleResize);
    document.addEventListener('DOMContentLoaded',handleResize);
    handleResize();
})();
</script>
