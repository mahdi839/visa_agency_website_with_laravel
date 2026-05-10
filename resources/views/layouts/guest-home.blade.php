<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Home' }} — {{ config('app.name', 'Durdesh Travel Agency') }}</title>
        <meta name="description" content="{{ $description ?? 'Professional visa processing and immigration consultancy based in Spain.' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>

    <body class="font-sans antialiased text-slate-900 bg-white">

        <!-- ========== NAVIGATION ========== -->
        <nav x-data="{ open: false, scrolled: false }"
             x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
             :class="scrolled ? 'bg-white/95 shadow-sm' : 'bg-white/80'"
             class="fixed top-0 left-0 right-0 z-50 backdrop-blur-lg border-b border-slate-100 transition-all duration-300">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-18">

                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                            <div class="w-9 h-9 bg-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A8.966 8.966 0 013 12c0-1.264.26-2.466.732-3.558" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold tracking-tight text-slate-900">Vista<span class="text-emerald-600">EU</span></span>
                        </a>
                    </div>

                    <!-- Desktop Nav Links -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="#home" class="nav-link px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">Home</a>
                        <a href="#services" class="nav-link px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">Services</a>
                        <a href="#process" class="nav-link px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">Process</a>
                        <a href="#about" class="nav-link px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">About</a>
                        <a href="#blog" class="nav-link px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">Blog</a>
                        <a href="#contact" class="nav-link px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">Contact</a>
                    </div>

                    <!-- Desktop Auth Buttons -->
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                My Portal
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all">Register</a>
                        @endauth
                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="flex items-center md:hidden">
                        <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden border-t border-slate-100 bg-white/95 backdrop-blur-lg">

                <div class="px-4 py-4 space-y-1">
                    <a @click="open = false" href="#home" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Home</a>
                    <a @click="open = false" href="#services" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Services</a>
                    <a @click="open = false" href="#process" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Process</a>
                    <a @click="open = false" href="#about" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">About</a>
                    <a @click="open = false" href="#blog" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Blog</a>
                    <a @click="open = false" href="#contact" class="block px-4 py-2.5 text-sm font-medium text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Contact</a>
                </div>

                <div class="px-4 py-4 border-t border-slate-100 flex flex-col gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">My Portal</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- ========== PAGE CONTENT ========== -->
        {{ $slot }}

        <!-- ========== FOOTER ========== -->
        <footer class="bg-slate-950 text-slate-400">
            <!-- Main Footer -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

                    <!-- Brand -->
                    <div class="lg:col-span-1">
                        <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-5">
                            <div class="w-9 h-9 bg-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A8.966 8.966 0 013 12c0-1.264.26-2.466.732-3.558" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-white">Vista<span class="text-emerald-400">EU</span></span>
                        </a>
                        <p class="text-sm leading-relaxed mb-6">Professional visa processing and immigration consultancy based in Spain. Helping people worldwide achieve their European dreams.</p>
                        <div class="flex items-center gap-3">
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-emerald-600 text-slate-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-8.384 4.482A13.944 13.944 0 011.671 3.149a4.916 4.916 0 001.523 6.574 4.897 4.897 0 01-2.229-.616v.061a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 14.002-7.496 14.002-13.986 0-.21 0-.423-.015-.634A9.936 9.936 0 0024 4.557z"/></svg>
                            </a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-emerald-600 text-slate-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-emerald-600 text-slate-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-emerald-600 text-slate-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">Quick Links</h4>
                        <ul class="space-y-3">
                            <li><a href="#home" class="text-sm hover:text-emerald-400 transition-colors">Home</a></li>
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Our Services</a></li>
                            <li><a href="#process" class="text-sm hover:text-emerald-400 transition-colors">How It Works</a></li>
                            <li><a href="#about" class="text-sm hover:text-emerald-400 transition-colors">About Us</a></li>
                            <li><a href="#blog" class="text-sm hover:text-emerald-400 transition-colors">Blog & News</a></li>
                            <li><a href="#contact" class="text-sm hover:text-emerald-400 transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">Services</h4>
                        <ul class="space-y-3">
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Schengen Visa</a></li>
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Work Permit Visa</a></li>
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Student Visa</a></li>
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Family Reunification</a></li>
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Business Visa</a></li>
                            <li><a href="#services" class="text-sm hover:text-emerald-400 transition-colors">Golden Visa</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">Contact Us</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 0115 0z" />
                                </svg>
                                <span class="text-sm">Calle de Serrano, 45<br>Madrid, Spain 28001</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <span class="text-sm">+34 912 345 678</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <span class="text-sm">info@vistaeu.com</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">Mon - Fri: 9:00 - 18:00<br>Sat: 10:00 - 14:00</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-slate-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500">&copy; {{ date('Y') }} Durdesh Travel Agency. All rights reserved.</p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="text-xs text-slate-500 hover:text-slate-300 transition-colors">Privacy Policy</a>
                        <a href="#" class="text-xs text-slate-500 hover:text-slate-300 transition-colors">Terms of Service</a>
                        <a href="#" class="text-xs text-slate-500 hover:text-slate-300 transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </footer>

        @stack('scripts')
    </body>
</html>