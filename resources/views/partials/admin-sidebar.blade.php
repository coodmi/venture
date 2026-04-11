<aside id="adminSidebar" style="width:15rem;background:#110e05;border-right:1px solid rgba(212,146,15,.15);flex-shrink:0;display:flex;flex-direction:column;height:100vh;overflow:hidden;">
    {{-- Logo --}}
    <div style="padding:1.25rem 1.25rem 1rem;border-bottom:1px solid rgba(212,146,15,.12);">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.5rem;text-decoration:none;">
            @php $siteLogo = \App\Models\Setting::get('site_logo'); $siteName = \App\Models\Setting::get('site_name', config('app.name')); @endphp
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:1.75rem;width:auto;object-fit:contain;max-width:110px;">
            @else
                <div style="width:1.875rem;height:1.875rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:.4rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="color:#0d0a04;font-weight:800;font-size:.7rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                </div>
                <span style="font-weight:700;font-size:.9375rem;color:#f0e6c8;">{{ $siteName }}</span>
            @endif
        </a>
        <p style="font-size:.65rem;color:rgba(212,146,15,.4);margin:.375rem 0 0;text-transform:uppercase;letter-spacing:.1em;font-weight:600;">Admin Panel</p>
    </div>

    {{-- Nav --}}
    <nav style="flex:1;padding:.75rem;overflow-y:auto;">
        @php
            $navItems = [
                ['route'=>'admin.dashboard',           'label'=>'Dashboard',      'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route'=>'admin.users.index',         'label'=>'Users',          'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route'=>'admin.opportunities.index', 'label'=>'Opportunities',  'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                ['route'=>'admin.memberships.index',   'label'=>'Memberships',    'icon'=>'M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2'],
                ['route'=>'admin.events.index',        'label'=>'Events',         'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.news.index',          'label'=>'News & Media',   'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route'=>'admin.settings.header',     'label'=>'Header',         'icon'=>'M4 6h16M4 12h16M4 18h16'],
                ['route'=>'admin.settings.hero',       'label'=>'Hero Slider',    'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.settings.stats',      'label'=>'Platform Stats', 'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['route'=>'admin.settings.testimonials','label'=>'Testimonials',  'icon'=>'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                ['route'=>'admin.settings.about',      'label'=>'About Content',  'icon'=>'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.settings.general',    'label'=>'Settings',       'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ];
        @endphp

        @foreach($navItems as $item)
        @php $active = request()->routeIs($item['route'].'*'); @endphp
        <a href="{{ route($item['route']) }}"
           style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.625rem;font-size:.8125rem;font-weight:{{ $active ? '700' : '500' }};text-decoration:none;margin-bottom:.125rem;transition:all .15s;{{ $active ? 'background:rgba(212,146,15,.15);color:#d4920f;border:1px solid rgba(212,146,15,.2);' : 'color:rgba(240,230,200,.5);border:1px solid transparent;' }}"
           onmouseover="{{ $active ? '' : "this.style.background='rgba(212,146,15,.08)';this.style.color='#d4920f';" }}"
           onmouseout="{{ $active ? '' : "this.style.background='transparent';this.style.color='rgba(240,230,200,.5)';" }}">
            <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
            </svg>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>
</aside>
