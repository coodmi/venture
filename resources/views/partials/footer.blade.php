<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Brand --}}
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">VM</span>
                    </div>
                    <span class="font-bold text-xl text-white">VentureMatch</span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed max-w-sm">
                    Connecting investors with high-potential startups, projects, and ecosystem opportunities across sectors and geographies.
                </p>
                <div class="flex gap-4 mt-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Platform</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('register.investor') }}" class="hover:text-white transition-colors">Join as Investor</a></li>
                    <li><a href="{{ route('register.seeker') }}" class="hover:text-white transition-colors">Join as Seeker</a></li>
                    <li><a href="{{ route('membership.plans') }}" class="hover:text-white transition-colors">Membership Plans</a></li>
                    <li><a href="{{ route('events.index') }}" class="hover:text-white transition-colors">Events</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white transition-colors">News & Media</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('notices.index') }}" class="hover:text-white transition-colors">Notices</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>
        </div>

        {{-- Newsletter --}}
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h4 class="text-white font-semibold">Stay in the loop</h4>
                    <p class="text-sm text-gray-400 mt-1">Get the latest deals, events, and ecosystem updates.</p>
                </div>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex gap-2 w-full md:w-auto">
                    @csrf
                    <input type="email" name="email" placeholder="your@email.com" required
                           class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg px-4 py-2 w-64 focus:outline-none focus:border-primary-500">
                    <button type="submit" class="bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} VentureMatch. All rights reserved.
        </div>
    </div>
</footer>
