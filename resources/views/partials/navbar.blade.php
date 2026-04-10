@php use Illuminate\Support\Facades\Storage; @endphp
<nav class="bg-white/95 backdrop-blur-sm border-b border-gray-100 sticky top-0 z-50 shadow-sm" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 cursor-pointer">
                @php $siteLogo = \App\Models\Setting::get('site_logo'); $siteName = \App\Models\Setting::get('site_name', config('app.name')); @endphp
                @include('partials.logo', ['logoClass' => 'h-8 w-auto object-contain max-w-[140px]'])
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-6">
                @php $navItems = json_decode(\App\Models\Setting::get('nav_menu_items', '[]'), true) ?: [['label'=>'Home','url'=>'/'],['label'=>'About','url'=>'/about'],['label'=>'Top Startups','url'=>'/startups'],['label'=>'Events','url'=>'/events'],['label'=>'News','url'=>'/news'],['label'=>'Membership','url'=>'/membership']]; @endphp
                @foreach($navItems as $item)
                    <a href="{{ $item['url'] }}" class="text-sm font-medium text-gray-600 hover:text-primary-600">{{ $item['label'] }}</a>
                @endforeach
            </div>

            {{-- Auth Buttons --}}
            <div class="hidden md:flex items-center gap-3">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Admin Panel</a>
                    @elseif(auth()->user()->hasRole('investor'))
                        <a href="{{ route('investor.dashboard') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Dashboard</a>
                    @elseif(auth()->user()->hasRole('seeker'))
                        <a href="{{ route('seeker.dashboard') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-500">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600">Login</a>
                    <a href="{{ route('register.investor') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">Join as Investor</a>
                    <a href="{{ route('register.seeker') }}" class="border border-primary-600 text-primary-600 text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-50">Join as Seeker</a>
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button @click="mobileOpen = !mobileOpen" class="md:hidden text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen" x-transition class="md:hidden pb-4 space-y-2">
            @foreach($navItems as $item)
                <a href="{{ $item['url'] }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">{{ $item['label'] }}</a>
            @endforeach
            @guest
                <div class="pt-2 flex flex-col gap-2">
                    <a href="{{ route('register.investor') }}" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg text-center">Join as Investor</a>
                    <a href="{{ route('register.seeker') }}" class="border border-primary-600 text-primary-600 text-sm font-medium px-4 py-2 rounded-lg text-center">Join as Seeker</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
