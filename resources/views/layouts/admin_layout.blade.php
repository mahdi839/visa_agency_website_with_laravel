<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} — VistaEU Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        /* Custom Scrollbar for Sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 999px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Custom Scrollbar for Main */
        .main-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .main-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .main-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }
        .main-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-slate-100 font-sans antialiased text-slate-900">

<div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: window.innerWidth >= 1024, mobileOverlay: false }" @resize.window="sidebarOpen = window.innerWidth >= 1024">

    <!-- ==================== MOBILE OVERLAY ==================== -->
    <div x-show="mobileOverlay" x-cloak
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileOverlay = false; sidebarOpen = false"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden"></div>


    <!-- ==================== SIDEBAR ==================== -->
    <aside x-show="sidebarOpen"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           :class="{ 'fixed inset-y-0 left-0 z-50': !sidebarOpen || window.innerWidth < 1024, 'relative': window.innerWidth >= 1024 }"
           class="w-[270px] bg-slate-900 flex flex-col shrink-0">

        <!-- Sidebar Header -->
        <div class="h-[68px] flex items-center justify-between px-5 border-b border-white/[0.06]">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A8.966 8.966 0 013 12c0-1.264.26-2.466.732-3.558" />
                    </svg>
                </div>
                <span class="text-base font-bold text-white tracking-tight">Vista<span class="text-emerald-400">EU</span></span>
            </a>
            <!-- Mobile Close -->
            <button @click="sidebarOpen = false; mobileOverlay = false" class="lg:hidden p-1 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto sidebar-scroll py-4 px-3">

            <!-- Main Menu -->
            <div class="space-y-0.5">
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
                          {{ request()->routeIs('dashboard') ? 'bg-emerald-600/15 text-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/[0.06]' }}">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('dashboard.users.index') }}"
                   class="{{ request()->routeIs('dashboard.users.*') ? 'bg-emerald-600/15 text-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/[0.06]' }} sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    Users
                    <span class="ml-auto text-xs bg-slate-700 text-slate-300 px-2 py-0.5 rounded-full font-medium">128</span>
                </a>
            </div>

            <!-- Applications Group -->
            <div class="mt-6">
                <p class="px-3 mb-2 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Applications</p>
                <div class="space-y-0.5">
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        Visa Applications
                        <span class="ml-auto text-xs bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded-full font-medium">24</span>
                    </a>
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                        Support Tickets
                        <span class="ml-auto text-xs bg-amber-500/20 text-amber-400 px-2 py-0.5 rounded-full font-medium">5</span>
                    </a>
                </div>
            </div>

            <!-- Management Group -->
            <div class="mt-6">
                <p class="px-3 mb-2 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Management</p>
                <div class="space-y-0.5">
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                        Application Progress
                    </a>
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        Payments
                    </a>
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        Documents
                    </a>
                </div>
            </div>

            <!-- Content Group -->
            <div class="mt-6">
                <p class="px-3 mb-2 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Content</p>
                <div class="space-y-0.5">
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                        Blog Posts
                    </a>
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.1-5.1m0 0L11.42 4.97m-5.1 5.1H21M3 21h18" />
                        </svg>
                        Services
                    </a>
                    <a href="{{ route('dashboard.about-us.index') }}"
                       class="{{ request()->routeIs('dashboard.about-us.*') ? 'bg-emerald-600/15 text-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/[0.06]' }} sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        About Us
                    </a>
                    <a href="#"
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/[0.06] transition-colors duration-150">
                        <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 01-1.021-.27l-.112-.194a8.965 8.965 0 01-1.1-4.39m5.158-7.274a8.965 8.965 0 014.39-1.1l.194-.112a.75.75 0 011.021.27l.38.657c.301.523.03 1.263-.511 1.463-.89.401-1.82.732-2.783.985m0 0a48.109 48.109 0 01-3.378.072 48.109 48.109 0 01-3.378-.072" />
                        </svg>
                        Testimonials
                    </a>
                </div>
            </div>

        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/[0.06]">
            <!-- User Card -->
            <div class="flex items-center gap-3 px-2 py-2">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=059669&color=fff&size=80&bold=true&font-size=0.35"
                     alt="{{ auth()->user()->name }}"
                     class="w-9 h-9 rounded-lg shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Log Out
                </button>
            </form>
        </div>

    </aside>


    <!-- ==================== MAIN AREA ==================== -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Header -->
        <header class="h-[68px] bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 shrink-0">

            <!-- Left: Hamburger + Breadcrumb -->
            <div class="flex items-center gap-4">
                <!-- Mobile Toggle -->
                <button @click="sidebarOpen = !sidebarOpen; mobileOverlay = sidebarOpen"
                        class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Breadcrumb -->
                <nav class="hidden sm:flex items-center gap-1.5 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-slate-600 transition-colors">Home</a>
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    <span class="text-slate-700 font-medium">{{ $title ?? 'Dashboard' }}</span>
                </nav>

                <!-- Mobile Title -->
                <h1 class="sm:hidden text-base font-semibold text-slate-800">{{ $title ?? 'Dashboard' }}</h1>
            </div>

            <!-- Right: Search + Actions + Profile -->
            <div class="flex items-center gap-2 sm:gap-3">

                <!-- Search -->
                <div class="hidden md:flex items-center relative">
                    <svg class="absolute left-3 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    <input type="text"
                           placeholder="Search..."
                           class="w-56 lg:w-64 pl-10 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                </div>

                <!-- Mobile Search Button -->
                <button class="md:hidden p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                </button>

                <!-- Notifications -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="relative p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        <!-- Notification Dot -->
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                    </button>

                    <!-- Notification Dropdown -->
                    <div x-show="open" x-cloak
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden z-50">

                        <!-- Dropdown Header -->
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-slate-800">Notifications</h4>
                            <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-medium">3 new</span>
                        </div>

                        <!-- Notification Items -->
                        <div class="max-h-72 overflow-y-auto">
                            <a href="#" class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-colors border-b border-slate-50">
                                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-700 leading-snug">New visa application submitted by <span class="font-medium">Rahim Uddin</span></p>
                                    <p class="text-xs text-slate-400 mt-1">2 minutes ago</p>
                                </div>
                                <span class="w-2 h-2 bg-emerald-500 rounded-full shrink-0 mt-2"></span>
                            </a>
                            <a href="#" class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-colors border-b border-slate-50">
                                <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-700 leading-snug">Payment of <span class="font-medium">€850</span> received from Karim Hossain</p>
                                    <p class="text-xs text-slate-400 mt-1">15 minutes ago</p>
                                </div>
                                <span class="w-2 h-2 bg-emerald-500 rounded-full shrink-0 mt-2"></span>
                            </a>
                            <a href="#" class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-700 leading-snug">New support ticket from <span class="font-medium">Fatima Begum</span></p>
                                    <p class="text-xs text-slate-400 mt-1">1 hour ago</p>
                                </div>
                                <span class="w-2 h-2 bg-emerald-500 rounded-full shrink-0 mt-2"></span>
                            </a>
                        </div>

                        <!-- Dropdown Footer -->
                        <div class="px-4 py-2.5 border-t border-slate-100 bg-slate-50">
                            <a href="#" class="block text-center text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">View all notifications</a>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="hidden sm:block w-px h-8 bg-slate-200"></div>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2.5 pl-1 pr-2 py-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=059669&color=fff&size=80&bold=true&font-size=0.35"
                             alt="{{ auth()->user()->name }}"
                             class="w-8 h-8 rounded-lg">
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-medium text-slate-700 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 leading-tight">Administrator</p>
                        </div>
                        <svg class="hidden sm:block w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-show="open" x-cloak
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden z-50">

                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="py-1.5">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                Profile Settings
                            </a>
                            <a href="#" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Settings
                            </a>
                        </div>

                        <div class="border-t border-slate-100 py-1.5">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto main-scroll bg-slate-50">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>
