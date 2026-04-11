<footer style="background:#0d0a04;border-top:1px solid rgba(212,146,15,.2);color:rgba(255,255,255,.6);">
    <div style="max-width:80rem;margin:0 auto;padding:4rem 1.5rem 2rem;">
        <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:3rem;margin-bottom:3rem;" class="footer-grid">

            {{-- Brand --}}
            <div>
                @php $siteLogo = \App\Models\Setting::get('site_logo'); $siteName = \App\Models\Setting::get('site_name', config('app.name')); @endphp
                @if($siteLogo)
                    <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" style="height:2rem;width:auto;object-fit:contain;margin-bottom:1rem;display:block;">
                @else
                    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;">
                        <div style="width:2rem;height:2rem;background:linear-gradient(135deg,#d4920f,#f59e0b);border-radius:.5rem;display:flex;align-items:center;justify-content:center;">
                            <span style="color:#0d0a04;font-weight:800;font-size:.75rem;">VM</span>
                        </div>
                        <span style="font-weight:700;font-size:1.125rem;color:#fff;">{{ $siteName }}</span>
                    </div>
                @endif
                <p style="font-size:.875rem;line-height:1.7;max-width:22rem;color:rgba(255,255,255,.45);">
                    Connecting investors with high-potential startups, projects, and ecosystem opportunities across Bangladesh and beyond.
                </p>
                <div style="display:flex;gap:1rem;margin-top:1.5rem;">
                    @php $linkedin = \App\Models\Setting::get('linkedin_url','#'); $twitter = \App\Models\Setting::get('twitter_url','#'); $facebook = \App\Models\Setting::get('facebook_url','#'); @endphp
                    <a href="{{ $facebook }}" style="color:rgba(255,255,255,.4);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.4)';">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $twitter }}" style="color:rgba(255,255,255,.4);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.4)';">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="{{ $linkedin }}" style="color:rgba(255,255,255,.4);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.4)';">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Platform --}}
            <div>
                <h4 style="color:#d4920f;font-weight:700;font-size:.8125rem;text-transform:uppercase;letter-spacing:.08em;margin:0 0 1.25rem;">Platform</h4>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.625rem;">
                    <li><a href="{{ route('register.investor') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Join as Investor</a></li>
                    <li><a href="{{ route('register.seeker') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Join as Seeker</a></li>
                    <li><a href="{{ route('startups.index') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Top Startups</a></li>
                    <li><a href="{{ route('investors.index') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Top Investors</a></li>
                    <li><a href="{{ route('events.index') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Events</a></li>
                    <li><a href="{{ route('news.index') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">News & Media</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h4 style="color:#d4920f;font-weight:700;font-size:.8125rem;text-transform:uppercase;letter-spacing:.08em;margin:0 0 1.25rem;">Company</h4>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.625rem;">
                    <li><a href="{{ route('about') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">About Us</a></li>
                    <li><a href="{{ route('notices.index') }}" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Notices</a></li>
                    <li><a href="#" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Privacy Policy</a></li>
                    <li><a href="#" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Terms of Service</a></li>
                    <li><a href="#" style="font-size:.875rem;color:rgba(255,255,255,.55);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#d4920f';" onmouseout="this.style.color='rgba(255,255,255,.55)';">Contact Us</a></li>
                </ul>
            </div>
        </div>

        {{-- Newsletter --}}
        <div style="border-top:1px solid rgba(212,146,15,.15);padding-top:2rem;margin-bottom:2rem;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1.5rem;">
            <div>
                <h4 style="color:#fff;font-weight:600;margin:0 0 .25rem;font-size:.9375rem;">Stay in the loop</h4>
                <p style="font-size:.8125rem;color:rgba(255,255,255,.4);margin:0;">Get the latest deals, events, and ecosystem updates.</p>
            </div>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;gap:.5rem;">
                @csrf
                <input type="email" name="email" placeholder="your@email.com" required
                       style="background:rgba(255,255,255,.06);border:1px solid rgba(212,146,15,.25);color:#fff;font-size:.875rem;border-radius:.5rem;padding:.5rem 1rem;width:16rem;outline:none;">
                <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.875rem;font-weight:700;padding:.5rem 1.25rem;border-radius:.5rem;border:none;cursor:pointer;white-space:nowrap;">Subscribe</button>
            </form>
        </div>

        <div style="border-top:1px solid rgba(255,255,255,.06);padding-top:1.5rem;text-align:center;font-size:.8125rem;color:rgba(255,255,255,.25);">
            © {{ date('Y') }} {{ $siteName ?? 'VentureMatch' }}. All rights reserved.
        </div>
    </div>
</footer>
