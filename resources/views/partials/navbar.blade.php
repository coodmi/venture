@php use Illuminate\Support\Facades\Storage; @endphp
@php
    $siteLogo = \App\Models\Setting::get('site_logo');
    $siteName = \App\Models\Setting::get('site_name', config('app.name'));
    $navItems = json_decode(\App\Models\Setting::get('nav_menu_items', '[]'), true) ?: [
        ['label'=>'Home','url'=>'/'],
        ['label'=>'About','url'=>'/about'],
        ['label'=>'Top Startups','url'=>'/startups'],
        ['label'=>'Investments','url'=>'/investment'],
        ['label'=>'Investors','url'=>'/investors'],
        ['label'=>'Events','url'=>'/events'],
        ['label'=>'News','url'=>'/news'],
    ];
    // Fix legacy nav: rename "Investors" pointing to /investment → "Investments"
    // and add a proper "Investors" → /investors entry if missing
    $hasInvestorsPage = false;
    foreach ($navItems as &$navItem) {
        if ($navItem['label'] === 'Investors' && rtrim($navItem['url'], '/') === '/investment') {
            $navItem['label'] = 'Investments';
        }
        if (rtrim($navItem['url'], '/') === '/investors') {
            $hasInvestorsPage = true;
        }
    }
    unset($navItem);
    if (!$hasInvestorsPage) {
        // Insert "Investors" after "Investments" in the nav
        $newNav = [];
        foreach ($navItems as $navItem) {
            $newNav[] = $navItem;
            if (rtrim($navItem['url'], '/') === '/investment') {
                $newNav[] = ['label' => 'Investors', 'url' => '/investors'];
            }
        }
        $navItems = $newNav;
    }
@endphp

<nav style="background:#1a3c8f;border-bottom:2px solid #0d2b6e;position:sticky;top:0;z-index:100;box-shadow:0 2px 12px rgba(26,60,143,.3);font-family:'Plus Jakarta Sans',sans-serif;">
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
                    <span style="font-weight:800;font-size:1.125rem;color:#fff;">{{ $siteName }}</span>
                </div>
            @endif
        </a>

        {{-- Desktop Nav --}}
        <div id="desktopNav" style="display:flex;align-items:center;gap:1.75rem;">
            @foreach($navItems as $item)
            <a href="{{ $item['url'] }}" style="font-size:.875rem;font-weight:600;color:rgba(255,255,255,.85);text-decoration:none;white-space:nowrap;padding:.25rem 0;border-bottom:2px solid transparent;transition:all .2s;" onmouseover="this.style.color='#fff';this.style.borderBottomColor='#f97316';" onmouseout="this.style.color='rgba(255,255,255,.85)';this.style.borderBottomColor='transparent';">{{ $item['label'] }}</a>
            @endforeach
        </div>

        {{-- Auth + Hamburger --}}
        <div style="display:flex;align-items:center;gap:.625rem;">
            <div id="desktopAuth" style="display:flex;align-items:center;gap:.625rem;">
                @auth
                    @php $navAvatar = auth()->user()->avatar ?? null; @endphp
                    <div style="position:relative;" id="navUserMenu">
                        <button onclick="toggleNavMenu()" style="display:flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.25);border-radius:.75rem;padding:.3rem .5rem .3rem .3rem;cursor:pointer;transition:all .15s;" onmouseover="this.style.background='rgba(255,255,255,.2)';" onmouseout="this.style.background='rgba(255,255,255,.1)';">
                            @if($navAvatar)
                                <img src="{{ Storage::url($navAvatar) }}" alt="{{ auth()->user()->name }}"
                                     style="width:1.875rem;height:1.875rem;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,.4);flex-shrink:0;">
                            @else
                                <div style="width:1.875rem;height:1.875rem;background:linear-gradient(135deg,#f97316,#fb923c);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <span style="color:#fff;font-weight:700;font-size:.6875rem;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                                </div>
                            @endif
                            <span style="font-size:.8125rem;font-weight:600;color:#fff;">{{ explode(' ', auth()->user()->name)[0] }}</span>
                            <svg width="12" height="12" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div id="navMenuDropdown" style="display:none;position:absolute;right:0;top:calc(100% + .5rem);width:13rem;background:#fff;border:1px solid #e5e7eb;border-radius:.875rem;box-shadow:0 10px 25px rgba(0,0,0,.1);z-index:999;overflow:hidden;">
                            <div style="padding:.875rem 1rem;border-bottom:1px solid #f3f4f6;">
                                <div style="font-size:.8125rem;font-weight:600;color:#111827;">{{ auth()->user()->name }}</div>
                                <div style="font-size:.75rem;color:#9ca3af;margin-top:.125rem;">{{ auth()->user()->email }}</div>
                            </div>
                            <div style="padding:.375rem;">
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}"
                                       style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;"
                                       onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Admin Panel
                                    </a>
                                @elseif(auth()->user()->hasRole('investor'))
                                    <a href="{{ route('investor.dashboard') }}"
                                       style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;"
                                       onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Dashboard
                                    </a>
                                    <a href="{{ route('investor.profile.edit') }}"
                                       style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;"
                                       onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        My Profile
                                    </a>
                                @elseif(auth()->user()->hasRole('seeker'))
                                    <a href="{{ route('seeker.dashboard') }}"
                                       style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;"
                                       onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Dashboard
                                    </a>
                                    <a href="{{ route('seeker.profile.edit') }}"
                                       style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#374151;text-decoration:none;"
                                       onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        My Profile
                                    </a>
                                @endif
                            </div>
                            <div style="padding:.375rem;border-top:1px solid #f3f4f6;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            style="display:flex;align-items:center;gap:.625rem;width:100%;padding:.5rem .75rem;border-radius:.5rem;font-size:.8125rem;color:#ef4444;background:none;border:none;cursor:pointer;text-align:left;"
                                            onmouseover="this.style.background='#fef2f2';" onmouseout="this.style.background='transparent';">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                    function toggleNavMenu(){var d=document.getElementById('navMenuDropdown');d.style.display=d.style.display==='none'?'block':'none';}
                    document.addEventListener('click',function(e){var m=document.getElementById('navUserMenu');if(m&&!m.contains(e.target)){var d=document.getElementById('navMenuDropdown');if(d)d.style.display='none';}});
                    </script>
                @else
                    <a href="{{ route('login') }}" style="font-size:.8125rem;font-weight:600;color:#fff;text-decoration:none;padding:.45rem .875rem;border-radius:.5rem;border:1px solid rgba(255,255,255,.4);" onmouseover="this.style.background='rgba(255,255,255,.15)';" onmouseout="this.style.background='transparent';">Login</a>
                    <a href="{{ route('register.investor') }}" style="background:#f97316;color:#fff;font-size:.8125rem;font-weight:700;padding:.45rem 1.125rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;" onmouseover="this.style.background='#ea6c0a';" onmouseout="this.style.background='#f97316';">Join as Investor</a>
                    <a id="seekerBtn" href="{{ route('register.seeker') }}" style="background:rgba(255,255,255,.15);color:#fff;font-size:.8125rem;font-weight:700;padding:.45rem 1.125rem;border-radius:.5rem;text-decoration:none;white-space:nowrap;border:1px solid rgba(255,255,255,.3);" onmouseover="this.style.background='rgba(255,255,255,.25)';" onmouseout="this.style.background='rgba(255,255,255,.15)';">Join as Seeker</a>
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
