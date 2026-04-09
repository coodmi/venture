<aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden lg:flex flex-col">
    <div class="p-6 border-b border-gray-100">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-sm">VM</span>
            </div>
            <span class="font-bold text-gray-900">VentureMatch</span>
        </a>
    </div>

    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        @auth
            @if(auth()->user()->hasRole('investor'))
                @php
                    $navItems = [
                        ['route' => 'investor.dashboard',           'label' => 'Dashboard'],
                        ['route' => 'investor.profile.edit',        'label' => 'My Profile'],
                        ['route' => 'investor.opportunities.index', 'label' => 'Browse Opportunities'],
                        ['route' => 'membership.status',            'label' => 'Membership'],
                    ];
                @endphp
            @elseif(auth()->user()->hasRole('seeker'))
                @php
                    $navItems = [
                        ['route' => 'seeker.dashboard',             'label' => 'Dashboard'],
                        ['route' => 'seeker.profile.edit',          'label' => 'My Profile'],
                        ['route' => 'seeker.opportunities.index',   'label' => 'My Opportunities'],
                        ['route' => 'seeker.opportunities.create',  'label' => 'Submit Opportunity'],
                        ['route' => 'membership.status',            'label' => 'Membership'],
                    ];
                @endphp
            @else
                @php $navItems = []; @endphp
            @endif

            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs($item['route'] . '*') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        @endauth
    </nav>

    <div class="p-4 border-t border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                <span class="text-primary-700 font-semibold text-xs">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</aside>
