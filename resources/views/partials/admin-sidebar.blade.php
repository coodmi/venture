<aside id="adminSidebar" style="width:15rem;background:#ffffff;border-right:1px solid #e5e7eb;flex-shrink:0;display:flex;flex-direction:column;height:100vh;overflow:hidden;box-shadow:2px 0 8px rgba(0,0,0,.04);">
    {{-- Logo --}}
    <div style="padding:1.25rem 1.25rem 1rem;border-bottom:1px solid #f3f4f6;">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.625rem;text-decoration:none;">
            @php $siteLogo=\App\Models\Setting::get('site_logo'); $siteName=\App\Models\Setting::get('site_name',config('app.name')); @endphp
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:1.75rem;width:auto;object-fit:contain;max-width:110px;">
            @else
                <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 6px rgba(99,102,241,.35);">
                    <span style="color:#fff;font-weight:800;font-size:.7rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                </div>
                <span style="font-weight:700;font-size:.9375rem;color:#111827;">{{ $siteName }}</span>
            @endif
        </a>
        <p style="font-size:.65rem;color:#9ca3af;margin:.375rem 0 0;text-transform:uppercase;letter-spacing:.1em;font-weight:600;">Admin Panel</p>
    </div>

    {{-- Nav --}}
    <nav style="flex:1;padding:.75rem;overflow-y:auto;">
        @php
            $navItems=[
                ['route'=>'admin.dashboard',            'label'=>'Dashboard',      'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route'=>'admin.users.index',          'label'=>'Users',          'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route'=>'admin.opportunities.index',  'label'=>'Opportunities',  'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                ['route'=>'admin.events.index',         'label'=>'Events',         'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.news.index',           'label'=>'News & Media',   'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route'=>'admin.settings.header',      'label'=>'Header',         'icon'=>'M4 6h16M4 12h16M4 18h16'],
                ['route'=>'admin.settings.startups',    'label'=>'Startups Page',  'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                ['route'=>'admin.settings.hero',        'label'=>'Hero Slider',    'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.settings.stats',       'label'=>'Platform Stats', 'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['route'=>'admin.settings.testimonials','label'=>'Testimonials',   'icon'=>'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                ['route'=>'admin.settings.about',       'label'=>'About Content',  'icon'=>'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.settings.general',     'label'=>'Settings',       'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ];
        @endphp

        <p style="font-size:.65rem;font-weight:700;color:#d1d5db;text-transform:uppercase;letter-spacing:.1em;padding:.25rem .75rem .5rem;margin:0;">Main Menu</p>

        @foreach($navItems as $item)
        @php $active=request()->routeIs($item['route'].'*'); @endphp
        <a href="{{ route($item['route']) }}"
           style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.625rem;font-size:.8125rem;font-weight:{{ $active?'600':'500' }};text-decoration:none;margin-bottom:.125rem;transition:all .15s;{{ $active?'background:#eef2ff;color:#6366f1;':'color:#6b7280;' }}"
           onmouseover="{{ $active?'':'this.style.background=\'#f9fafb\';this.style.color=\'#374151\';' }}"
           onmouseout="{{ $active?'':'this.style.background=\'transparent\';this.style.color=\'#6b7280\';' }}">
            @if($active)
            <span style="width:3px;height:1rem;background:#6366f1;border-radius:2px;flex-shrink:0;margin-left:-3px;margin-right:3px;"></span>
            @endif
            <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
            </svg>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- User Profile + Logout --}}
    <div style="padding:.875rem 1rem;border-top:1px solid #f3f4f6;background:#fafafa;">
        <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:.625rem;">
            {{-- Avatar --}}
            @php $avatar = auth()->user()->avatar ?? null; @endphp
            @if($avatar)
                <img src="{{ Storage::url($avatar) }}" alt="{{ auth()->user()->name }}"
                     style="width:2.25rem;height:2.25rem;border-radius:50%;object-fit:cover;flex-shrink:0;border:2px solid #e0e7ff;">
            @else
                <div style="width:2.25rem;height:2.25rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 6px rgba(99,102,241,.3);">
                    <span style="color:#fff;font-weight:800;font-size:.8rem;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                </div>
            @endif
            {{-- Info --}}
            <div style="min-width:0;flex:1;">
                <p style="font-size:.8125rem;font-weight:600;color:#111827;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                <p style="font-size:.7rem;color:#9ca3af;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</p>
            </div>
        </div>
        {{-- Logout Button --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%;display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.5rem .75rem;background:#fff;border:1px solid #e5e7eb;border-radius:.625rem;font-size:.8rem;font-weight:600;color:#6b7280;cursor:pointer;transition:all .15s;"
                    onmouseover="this.style.background='#fef2f2';this.style.borderColor='#fecaca';this.style.color='#ef4444';"
                    onmouseout="this.style.background='#fff';this.style.borderColor='#e5e7eb';this.style.color='#6b7280';">
                <svg style="width:.875rem;height:.875rem;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Sign Out
            </button>
        </form>
    </div>
</aside>
