<nav class="nav" id="mainNav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-brand">
            <svg width="34" height="34" viewBox="0 0 36 36" fill="none">
                <path d="M18 2L33 10V26L18 34L3 26V10L18 2Z" fill="url(#lg1)"/>
                <path d="M12 18L16 22L24 14" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                    <linearGradient id="lg1" x1="3" y1="2" x2="33" y2="34" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#C9A96E"/><stop offset="1" stop-color="#A0784A"/>
                    </linearGradient>
                </defs>
            </svg>
            <div> 
                <div class="nav-brand-name">
                    EuroVisa</div>
                <div class="nav-brand-sub">Consultancy</div>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('home') }}"     class="nav-link {{ request()->routeIs('home')        ? 'active' : '' }}">Home</a>
            <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services')    ? 'active' : '' }}">Services</a>
            <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*')    ? 'active' : '' }}">Blog</a>
            <a href="{{ route('about') }}"    class="nav-link {{ request()->routeIs('about')       ? 'active' : '' }}">About</a>
            <a href="{{ route('contact') }}"  class="nav-link {{ request()->routeIs('contact')     ? 'active' : '' }}">Contact</a>
        </div>

        <div class="nav-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-ghost-sm">My Portal</a>
            @else
                <a href="{{ route('login') }}"    class="btn-ghost-sm">Login</a>
                <a href="{{ route('register') }}" class="btn-gold-sm">Get Started</a>
            @endauth
        </div>

        <button class="nav-hamburger" id="hamburger" aria-label="Open menu">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" viewBox="0 0 24 24">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="{{ route('blog.index') }}">Blog</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
        <div class="mobile-menu-actions" style="margin-top:16px">
            <a href="{{ route('login') }}"    class="btn-ghost-sm" style="flex:1;text-align:center">Login</a>
            <a href="{{ route('register') }}" class="btn-gold-sm"  style="flex:1;text-align:center">Get Started</a>
        </div>
    </div>
</nav>