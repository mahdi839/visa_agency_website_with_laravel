<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'EuroVisa') . ' — Your Gateway to Europe')</title>
    <meta name="description" content="@yield('meta_description', 'Expert visa processing for Bangladesh and beyond. Schengen, work permits, student visas processed from Spain.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #060C1A;
            color: #fff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; color: inherit; }

        /* ── NAV ── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(6,12,26,0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            transition: background 0.35s ease;
        }
        .nav.scrolled { background: rgba(6,12,26,0.97); }
        .nav-inner {
            max-width: 1200px; margin: 0 auto;
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 72px;
        }
        .nav-brand { display: flex; align-items: center; gap: 12px; }
        .site-logo { display: block; width: 44px; height: 44px; border-radius: 8px; object-fit: contain; background: #fff; padding: 3px; }
        .nav-brand-name { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1; }
        .nav-brand-sub { font-size: 9px; color: #C9A96E; letter-spacing: 0.22em; text-transform: uppercase; font-weight: 500; margin-top: 3px; }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-link { color: rgba(255,255,255,0.5); font-size: 14px; font-weight: 500; transition: color 0.2s; position: relative; padding-bottom: 3px; }
        .nav-link:hover { color: #fff; }
        .nav-link.active { color: #fff; }
        .nav-link.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1.5px; background: #C9A96E; border-radius: 99px; }
        .nav-actions { display: flex; align-items: center; gap: 10px; }
        .btn-ghost-sm { border: 1px solid rgba(255,255,255,0.14); border-radius: 7px; padding: 8px 18px; font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.7); background: rgba(255,255,255,0.03); transition: all 0.2s; display: inline-block; }
        .btn-ghost-sm:hover { color: #fff; border-color: rgba(255,255,255,0.28); background: rgba(255,255,255,0.07); }
        .btn-gold-sm { background: linear-gradient(135deg, #C9A96E 0%, #A0784A 100%); border-radius: 7px; padding: 8px 18px; font-size: 13px; font-weight: 600; color: #fff; box-shadow: 0 4px 20px rgba(201,169,110,0.28); transition: all 0.2s; display: inline-block; border: none; }
        .btn-gold-sm:hover { transform: translateY(-1px); box-shadow: 0 6px 28px rgba(201,169,110,0.4); }
        .nav-hamburger { display: none; background: none; border: none; cursor: pointer; padding: 6px; color: rgba(255,255,255,0.8); }
        .mobile-menu { display: none; background: rgba(6,12,26,0.98); border-top: 1px solid rgba(255,255,255,0.07); padding: 1.5rem 2rem 2rem; }
        .mobile-menu.open { display: block; }
        .mobile-menu a { display: block; padding: 12px 0; color: rgba(255,255,255,0.6); font-size: 15px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .mobile-menu-actions { display: flex; gap: 10px; margin-top: 1rem; }

        /* ── COMMON ── */
        .section-wrap { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section-label { display: inline-block; color: #C9A96E; font-size: 10px; font-weight: 600; letter-spacing: 0.28em; text-transform: uppercase; }
        .section-title { font-family: 'Cormorant Garamond', Georgia, serif; font-size: clamp(32px, 4vw, 48px); font-weight: 700; color: #fff; line-height: 1.18; margin-top: 14px; }
        .section-sub { color: rgba(255,255,255,0.45); font-size: 16px; line-height: 1.7; margin-top: 14px; }
        .divider-gold { width: 100%; height: 1px; background: linear-gradient(to right, transparent, rgba(201,169,110,0.25), transparent); }
        .btn-gold-lg { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #C9A96E 0%, #A0784A 100%); color: #fff; font-size: 15px; font-weight: 600; padding: 14px 28px; border-radius: 9px; box-shadow: 0 4px 28px rgba(201,169,110,0.32); transition: all 0.22s; }
        .btn-gold-lg:hover { transform: translateY(-2px); box-shadow: 0 8px 40px rgba(201,169,110,0.44); color: #fff; }
        .btn-outline-lg { display: inline-flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.2); border-radius: 9px; padding: 14px 28px; font-size: 15px; font-weight: 600; color: rgba(255,255,255,0.8); background: rgba(255,255,255,0.04); transition: all 0.22s; }
        .btn-outline-lg:hover { color: #fff; border-color: rgba(255,255,255,0.38); background: rgba(255,255,255,0.08); }

        /* ── FOOTER ── */
        .footer { background: #060C1A; border-top: 1px solid rgba(255,255,255,0.05); padding: 70px 0 28px; }
        .footer-grid { display: grid; grid-template-columns: 1.6fr 1fr 1fr 1.2fr; gap: 48px; margin-bottom: 56px; }
        .footer-brand-row { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .footer-logo { display: block; width: 36px; height: 36px; border-radius: 7px; object-fit: contain; background: #fff; padding: 3px; }
        .footer-brand-name { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; color: #fff; }
        .footer-brand-desc { color: rgba(255,255,255,0.25); font-size: 13px; line-height: 1.7; }
        .footer-socials { display: flex; gap: 10px; margin-top: 20px; }
        .social-btn { width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.35); font-size: 12px; font-weight: 700; transition: all 0.2s; }
        .social-btn:hover { background: rgba(255,255,255,0.08); color: #fff; border-color: rgba(255,255,255,0.16); }
        .footer-col-title { color: #fff; font-size: 10px; font-weight: 600; letter-spacing: 0.18em; text-transform: uppercase; margin-bottom: 18px; }
        .footer-col-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col-list a { color: rgba(255,255,255,0.32); font-size: 13px; transition: color 0.2s; }
        .footer-col-list a:hover { color: rgba(255,255,255,0.7); }
        .footer-contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; }
        .footer-contact-icon { color: #C9A96E; font-size: 14px; flex-shrink: 0; margin-top: 1px; }
        .footer-contact-text { color: rgba(255,255,255,0.32); font-size: 13px; line-height: 1.5; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.05); padding-top: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .footer-copy { color: rgba(255,255,255,0.15); font-size: 12px; }
        .footer-legal { display: flex; gap: 20px; }
        .footer-legal a { color: rgba(255,255,255,0.15); font-size: 12px; transition: color 0.2s; }
        .footer-legal a:hover { color: rgba(255,255,255,0.4); }

        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .nav-links, .nav-actions { display: none; }
            .nav-hamburger { display: flex; align-items: center; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; }
        }
    </style>

    {{-- Page-specific styles --}}
    @stack('styles')
</head>
<body>

    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        // Nav scroll glass effect
        var nav = document.getElementById('mainNav');
        window.addEventListener('scroll', function() {
            nav.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Mobile menu toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('open');
        });
    </script>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>
</html>
