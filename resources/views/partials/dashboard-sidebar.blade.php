<aside style="width:15rem;background:#ffffff;border-right:1px solid #e5e7eb;flex-shrink:0;display:flex;flex-direction:column;height:100vh;overflow:hidden;box-shadow:2px 0 8px rgba(0,0,0,.04);">

    {{-- Logo --}}
    <div style="padding:1.25rem 1.25rem 1rem;border-bottom:1px solid #f3f4f6;">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.625rem;text-decoration:none;">
            @php $siteLogo=\App\Models\Setting::get('site_logo'); $siteName=\App\Models\Setting::get('site_name',config('app.name')); @endphp
            @if($siteLogo)
                <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:1.75rem;width:auto;object-fit:contain;max-width:110px;">
            @else
                <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#1a3c8f,#2563eb);border-radius:.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="color:#fff;font-weight:800;font-size:.7rem;">{{ strtoupper(substr($siteName,0,2)) }}</span>
                </div>
                <span style="font-weight:700;font-size:.9375rem;color:#111827;">{{ $siteName }}</span>
            @endif
        </a>
        @auth
        <div style="margin-top:.5rem;display:inline-flex;align-items:center;gap:.375rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:9999px;padding:.2rem .625rem;">
            <span style="width:.5rem;height:.5rem;background:#22c55e;border-radius:50%;display:inline-block;"></span>
            <span style="font-size:.65rem;font-weight:600;color:#1a3c8f;text-transform:uppercase;letter-spacing:.06em;">
                {{ auth()->user()->hasRole('investor') ? 'Investor' : 'Seeker' }}
            </span>
        </div>
        @endauth
    </div>

    {{-- Nav --}}
    <nav style="flex:1;padding:.75rem;overflow-y:auto;">
        @auth
            @if(auth()->user()->hasRole('investor'))
                @php
                    $navItems = [
                        ['route'=>'investor.dashboard',           'label'=>'Dashboard',            'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route'=>'investor.profile.edit',        'label'=>'My Profile',           'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['route'=>'investor.opportunities.index', 'label'=>'Browse Opportunities', 'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                    ];
                @endphp
            @elseif(auth()->user()->hasRole('seeker'))
                @php
                    $navItems = [
                        ['route'=>'seeker.dashboard',            'label'=>'Dashboard',          'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route'=>'seeker.profile.edit',         'label'=>'My Profile',         'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['route'=>'seeker.opportunities.index',  'label'=>'My Opportunities',   'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['route'=>'seeker.opportunities.create', 'label'=>'Submit Opportunity', 'icon'=>'M12 4v16m8-8H4'],
                    ];
                @endphp
            @else
                @php $navItems = []; @endphp
            @endif

            <p style="font-size:.65rem;font-weight:700;color:#d1d5db;text-transform:uppercase;letter-spacing:.1em;padding:.25rem .75rem .5rem;margin:0;">Main Menu</p>

            @foreach($navItems as $item)
            @php $active = request()->routeIs($item['route'].'*'); @endphp
            <a href="{{ route($item['route']) }}"
               style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.625rem;font-size:.8125rem;font-weight:{{ $active?'600':'500' }};text-decoration:none;margin-bottom:.125rem;transition:all .15s;{{ $active?'background:#eff6ff;color:#1a3c8f;':'color:#6b7280;' }}"
               onmouseover="{{ $active?'':'this.style.background=\'#f9fafb\';this.style.color=\'#374151\';' }}"
               onmouseout="{{ $active?'':'this.style.background=\'transparent\';this.style.color=\'#6b7280\';' }}">
                @if($active)
                <span style="width:3px;height:1rem;background:#1a3c8f;border-radius:2px;flex-shrink:0;margin-left:-3px;margin-right:3px;"></span>
                @endif
                <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                </svg>
                {{ $item['label'] }}
            </a>
            @endforeach

            {{-- Divider --}}
            <div style="height:1px;background:#f3f4f6;margin:.75rem 0;"></div>

            {{-- Public links --}}
            <p style="font-size:.65rem;font-weight:700;color:#d1d5db;text-transform:uppercase;letter-spacing:.1em;padding:.25rem .75rem .5rem;margin:0;">Explore</p>
            @foreach([['url'=>route('startups.index'),'label'=>'Top Startups','icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],['url'=>route('events.index'),'label'=>'Events','icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],['url'=>route('news.index'),'label'=>'News & Media','icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z']] as $link)
            <a href="{{ $link['url'] }}"
               style="display:flex;align-items:center;gap:.625rem;padding:.5rem .75rem;border-radius:.625rem;font-size:.8125rem;font-weight:500;text-decoration:none;margin-bottom:.125rem;color:#6b7280;transition:all .15s;"
               onmouseover="this.style.background='#f9fafb';this.style.color='#374151';"
               onmouseout="this.style.background='transparent';this.style.color='#6b7280';">
                <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                </svg>
                {{ $link['label'] }}
            </a>
            @endforeach
        @endauth
    </nav>

    {{-- User Profile + Logout --}}
    <div style="padding:.875rem 1rem;border-top:1px solid #f3f4f6;background:#fafafa;">
        <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:.625rem;">
            @php $avatar = auth()->user()->avatar ?? null; @endphp
            @if($avatar)
                <img src="{{ Storage::url($avatar) }}" alt="{{ auth()->user()->name }}"
                     style="width:2.25rem;height:2.25rem;border-radius:50%;object-fit:cover;flex-shrink:0;border:2px solid #bfdbfe;">
            @else
                <div style="width:2.25rem;height:2.25rem;background:linear-gradient(135deg,#1a3c8f,#2563eb);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 6px rgba(26,60,143,.3);">
                    <span style="color:#fff;font-weight:800;font-size:.8rem;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                </div>
            @endif
            <div style="min-width:0;flex:1;">
                <p style="font-size:.8125rem;font-weight:600;color:#111827;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                <p style="font-size:.7rem;color:#9ca3af;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</p>
            </div>
        </div>
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
