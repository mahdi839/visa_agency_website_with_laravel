<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EuroVisa') }} — Your Gateway to Europe</title>
    <meta name="description" content="Expert visa processing for Bangladesh and beyond. Schengen, work permits, student visas processed from Spain.">
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

        /* ── HERO ── */
        .hero { position: relative; min-height: 100vh; display: flex; align-items: center; padding: 9rem 2rem 5rem; overflow: hidden; }
        .hero-bg { position: absolute; inset: 0; background: linear-gradient(135deg, #060C1A 0%, #0A1225 55%, #0F1D3A 100%); }
        .hero-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(201,169,110,0.045) 1px, transparent 1px), linear-gradient(90deg, rgba(201,169,110,0.045) 1px, transparent 1px); background-size: 56px 56px; }
        .hero-orb1 { position: absolute; top: 20%; right: 22%; width: 360px; height: 360px; background: radial-gradient(circle, rgba(201,169,110,0.09), transparent 70%); border-radius: 50%; }
        .hero-orb2 { position: absolute; bottom: 20%; left: 15%; width: 240px; height: 240px; background: radial-gradient(circle, rgba(56,100,220,0.07), transparent 70%); border-radius: 50%; }
        .hero-badges { position: absolute; right: 5%; top: 22%; display: flex; flex-direction: column; gap: 14px; }
        .country-badge { background: rgba(255,255,255,0.065); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.12); border-radius: 28px; padding: 8px 18px; font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.85); animation: floatY 4s ease-in-out infinite alternate; }
        .country-badge:nth-child(2) { animation-delay: 0.4s; }
        .country-badge:nth-child(3) { animation-delay: 0.8s; }
        .country-badge:nth-child(4) { animation-delay: 1.2s; }
        .country-badge:nth-child(5) { animation-delay: 1.6s; }
        @keyframes floatY { from { transform: translateY(0); } to { transform: translateY(-12px); } }
        .hero-content { position: relative; z-index: 2; max-width: 620px; }
        .hero-pill { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 28px; animation: fadeUp 0.7s ease both; }
        .hero-pill-dot { width: 8px; height: 8px; border-radius: 50%; background: #C9A96E; animation: pulse 2s ease-in-out infinite; }
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.6;transform:scale(0.85)} }
        .hero-pill-text { color: #C9A96E; font-size: 11px; font-weight: 500; letter-spacing: 0.22em; text-transform: uppercase; }
        .hero-title { font-family: 'Cormorant Garamond', Georgia, serif; font-size: clamp(44px, 6vw, 72px); font-weight: 700; line-height: 1.04; letter-spacing: -0.02em; color: #fff; margin-bottom: 22px; animation: fadeUp 0.7s 0.1s ease both; }
        .hero-title .accent { background: linear-gradient(135deg, #E8C98A 0%, #C9A96E 50%, #E07B39 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-sub { color: rgba(255,255,255,0.55); font-size: 17px; line-height: 1.75; max-width: 480px; margin-bottom: 36px; animation: fadeUp 0.7s 0.2s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: translateY(0); } }
        .hero-cta { display: flex; gap: 14px; margin-bottom: 52px; flex-wrap: wrap; animation: fadeUp 0.7s 0.3s ease both; }
        .btn-gold-lg { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #C9A96E 0%, #A0784A 100%); color: #fff; font-size: 15px; font-weight: 600; padding: 14px 28px; border-radius: 9px; box-shadow: 0 4px 28px rgba(201,169,110,0.32); transition: all 0.22s; }
        .btn-gold-lg:hover { transform: translateY(-2px); box-shadow: 0 8px 40px rgba(201,169,110,0.44); color: #fff; }
        .btn-outline-lg { display: inline-flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.2); border-radius: 9px; padding: 14px 28px; font-size: 15px; font-weight: 600; color: rgba(255,255,255,0.8); background: rgba(255,255,255,0.04); transition: all 0.22s; }
        .btn-outline-lg:hover { color: #fff; border-color: rgba(255,255,255,0.38); background: rgba(255,255,255,0.08); }
        .hero-stats { display: flex; animation: fadeUp 0.7s 0.4s ease both; }
        .hero-stat-num { font-family: 'Cormorant Garamond', serif; font-size: 34px; font-weight: 700; color: #fff; line-height: 1; }
        .hero-stat-label { color: rgba(255,255,255,0.35); font-size: 12px; margin-top: 5px; }
        .hero-stat + .hero-stat { border-left: 1px solid rgba(255,255,255,0.1); padding-left: 28px; margin-left: 28px; }
        .scroll-cue { position: absolute; bottom: 36px; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: 6px; z-index: 2; }
        .scroll-cue-text { color: rgba(255,255,255,0.25); font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase; }
        .scroll-cue-line { width: 1px; height: 44px; background: linear-gradient(to bottom, rgba(255,255,255,0.3), transparent); animation: scrollFade 2s ease-in-out infinite; }
        @keyframes scrollFade { 0%,100%{opacity:0.4} 50%{opacity:1} }

        /* ── TRUST BAR ── */
        .trust-bar { background: #0A1225; border-top: 1px solid rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.04); padding: 16px 2rem; }
        .trust-bar-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 10px 20px; }
        .trust-item { color: rgba(255,255,255,0.22); font-size: 11px; font-weight: 500; letter-spacing: 0.2em; text-transform: uppercase; }
        .trust-sep { color: rgba(201,169,110,0.35); font-size: 11px; }

        /* ── COMMON ── */
        .section-wrap { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section-label { display: inline-block; color: #C9A96E; font-size: 10px; font-weight: 600; letter-spacing: 0.28em; text-transform: uppercase; }
        .section-title { font-family: 'Cormorant Garamond', Georgia, serif; font-size: clamp(32px, 4vw, 48px); font-weight: 700; color: #fff; line-height: 1.18; margin-top: 14px; }
        .section-sub { color: rgba(255,255,255,0.45); font-size: 16px; line-height: 1.7; margin-top: 14px; }
        .divider-gold { width: 100%; height: 1px; background: linear-gradient(to right, transparent, rgba(201,169,110,0.25), transparent); }

        /* ── SERVICES ── */
        .services-section { background: #060C1A; padding: 100px 0; }
        .services-header { text-align: center; margin-bottom: 60px; }
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .service-card { background: rgba(255,255,255,0.028); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 2rem; transition: all 0.3s ease; }
        .service-card:hover { background: rgba(255,255,255,0.055); border-color: rgba(201,169,110,0.22); transform: translateY(-5px); box-shadow: 0 24px 60px rgba(0,0,0,0.3); }
        .service-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 20px; }
        .icon-blue { background: rgba(59,130,246,0.13); }
        .icon-gold { background: rgba(201,169,110,0.13); }
        .icon-green { background: rgba(34,197,94,0.13); }
        .icon-purple { background: rgba(168,85,247,0.13); }
        .icon-orange { background: rgba(249,115,22,0.13); }
        .icon-teal { background: rgba(20,184,166,0.13); }
        .service-title { font-family: 'Cormorant Garamond', serif; font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 10px; }
        .service-desc { color: rgba(255,255,255,0.42); font-size: 14px; line-height: 1.65; }
        .service-more { display: inline-flex; align-items: center; gap: 5px; color: #C9A96E; font-size: 13px; font-weight: 500; margin-top: 18px; transition: gap 0.2s, color 0.2s; }
        .service-card:hover .service-more { gap: 9px; color: #E8C98A; }

        /* ── HOW IT WORKS ── */
        .how-section { background: #0A1225; padding: 100px 0; border-top: 1px solid rgba(255,255,255,0.04); }
        .how-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
        .step-list { display: flex; flex-direction: column; gap: 14px; }
        .step-card { display: flex; gap: 18px; align-items: flex-start; background: rgba(255,255,255,0.025); border: 1px solid rgba(255,255,255,0.055); border-radius: 11px; padding: 18px 20px; transition: border-color 0.3s; }
        .step-card:hover { border-color: rgba(201,169,110,0.18); }
        .step-num { font-family: 'Cormorant Garamond', serif; font-size: 30px; font-weight: 700; color: rgba(201,169,110,0.32); line-height: 1; min-width: 36px; }
        .step-title { color: #fff; font-size: 14px; font-weight: 600; margin-bottom: 5px; }
        .step-desc { color: rgba(255,255,255,0.38); font-size: 13px; line-height: 1.6; }

        /* ── BLOG ── */
        .blog-section { background: #060C1A; padding: 100px 0; border-top: 1px solid rgba(201,169,110,0.07); }
        .blog-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 50px; flex-wrap: wrap; gap: 20px; }
        .blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .blog-card { background: rgba(255,255,255,0.025); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; overflow: hidden; transition: all 0.3s ease; }
        .blog-card:hover { border-color: rgba(201,169,110,0.18); transform: translateY(-4px); box-shadow: 0 18px 50px rgba(0,0,0,0.28); }
        .blog-thumb { height: 175px; display: flex; align-items: flex-end; padding: 14px; }
        .blog-thumb-1 { background: linear-gradient(135deg, #0F1D3A 0%, #1a2f5a 100%); }
        .blog-thumb-2 { background: linear-gradient(135deg, #1a1230 0%, #2a1a5a 100%); }
        .blog-thumb-3 { background: linear-gradient(135deg, #0d2a1a 0%, #0f3d25 100%); }
        .blog-tag { background: linear-gradient(135deg, #C9A96E, #A0784A); color: #fff; font-size: 10px; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 11px; border-radius: 5px; }
        .blog-body { padding: 1.2rem 1.4rem; }
        .blog-meta { color: rgba(255,255,255,0.25); font-size: 11px; margin-bottom: 10px; }
        .blog-title { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; color: #fff; line-height: 1.45; margin-bottom: 12px; transition: color 0.2s; }
        .blog-card:hover .blog-title { color: #E8C98A; }
        .blog-read { color: #C9A96E; font-size: 12px; font-weight: 500; display: inline-flex; align-items: center; gap: 4px; transition: gap 0.2s; }
        .blog-card:hover .blog-read { gap: 8px; }

        /* ── TESTIMONIALS ── */
        .testi-section { background: #0A1225; padding: 100px 0; border-top: 1px solid rgba(255,255,255,0.04); }
        .testi-header { text-align: center; margin-bottom: 50px; }
        .testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .testi-card { background: rgba(255,255,255,0.025); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 1.75rem; transition: border-color 0.3s; }
        .testi-card:hover { border-color: rgba(201,169,110,0.18); }
        .testi-stars { color: #C9A96E; font-size: 14px; letter-spacing: 2px; margin-bottom: 14px; }
        .testi-text { color: rgba(255,255,255,0.55); font-size: 14px; line-height: 1.72; font-style: italic; margin-bottom: 20px; }
        .testi-footer { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 16px; display: flex; align-items: center; gap: 12px; }
        .testi-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #C9A96E, #A0784A); display: flex; align-items: center; justify-content: center; font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; color: #fff; flex-shrink: 0; }
        .testi-name { color: #fff; font-size: 14px; font-weight: 600; }
        .testi-loc { color: rgba(255,255,255,0.28); font-size: 12px; margin-top: 2px; }
        .testi-visa { color: rgba(201,169,110,0.7); font-size: 11px; margin-top: 2px; }

        /* ── CTA ── */
        .cta-section { position: relative; padding: 100px 2rem; text-align: center; overflow: hidden; background: linear-gradient(135deg, #0A1225 0%, #0F1D3A 50%, rgba(160,120,74,0.08) 100%); }
        .cta-grid-bg { position: absolute; inset: 0; background-image: linear-gradient(rgba(201,169,110,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(201,169,110,0.03) 1px, transparent 1px); background-size: 56px 56px; }
        .cta-content { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .cta-title { font-family: 'Cormorant Garamond', Georgia, serif; font-size: clamp(34px, 5vw, 54px); font-weight: 700; color: #fff; line-height: 1.15; margin-bottom: 18px; }
        .cta-sub { color: rgba(255,255,255,0.5); font-size: 17px; margin-bottom: 36px; line-height: 1.6; }
        .cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

        /* ── FOOTER ── */
        .footer { background: #060C1A; border-top: 1px solid rgba(255,255,255,0.05); padding: 70px 0 28px; }
        .footer-grid { display: grid; grid-template-columns: 1.6fr 1fr 1fr 1.2fr; gap: 48px; margin-bottom: 56px; }
        .footer-brand-row { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
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
            .hero-badges { display: none; }
            .services-grid { grid-template-columns: 1fr 1fr; }
            .blog-grid { grid-template-columns: 1fr 1fr; }
            .testi-grid { grid-template-columns: 1fr; }
            .how-grid { grid-template-columns: 1fr; gap: 48px; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .services-grid, .blog-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .hero-cta { flex-direction: column; }
            .btn-gold-lg, .btn-outline-lg { justify-content: center; width: 100%; }
            .cta-btns { flex-direction: column; align-items: center; }
            .hero-stats { flex-wrap: wrap; gap: 20px; }
            .hero-stat + .hero-stat { border-left: none; padding-left: 0; margin-left: 0; }
        }
    </style>
</head>
<body>

{{-- ── NAVBAR ── --}}
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
                <div class="nav-brand-name">EuroVisa</div>
                <div class="nav-brand-sub">Consultancy</div>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link active">Home</a>
            <a href="{{ route('services') }}" class="nav-link">Services</a>
            <a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
        </div>

        <div class="nav-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-ghost-sm">My Portal</a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost-sm">Login</a>
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
            <a href="{{ route('login') }}" class="btn-ghost-sm" style="flex:1;text-align:center">Login</a>
            <a href="{{ route('register') }}" class="btn-gold-sm" style="flex:1;text-align:center">Get Started</a>
        </div>
    </div>
</nav>


{{-- ── HERO ── --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-orb1"></div>
    <div class="hero-orb2"></div>

    <div class="hero-badges">
        <div class="country-badge">🇪🇸 Spain</div>
        <div class="country-badge">🇩🇪 Germany</div>
        <div class="country-badge">🇫🇷 France</div>
        <div class="country-badge">🇮🇹 Italy</div>
        <div class="country-badge">🇳🇱 Netherlands</div>
    </div>

    <div class="hero-content" style="max-width:1200px;margin:0 auto;padding:0 2rem;width:100%">
        <div class="hero-pill">
            <div class="hero-pill-dot"></div>
            <span class="hero-pill-text">Licensed Consultancy · Barcelona, Spain</span>
        </div>

        <h1 class="hero-title">
            Your Gateway<br>
            to <span class="accent">Europe</span><br>
            Starts Here.
        </h1>

        <p class="hero-sub">
            Expert visa processing for Bangladesh and beyond. We handle Schengen, work permits, student visas, and family reunification — so you can focus on your future.
        </p>

        <div class="hero-cta">
            <a href="{{ route('register') }}" class="btn-gold-lg">
                Start Your Application
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('services') }}" class="btn-outline-lg">Explore Services</a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">500+</div>
                <div class="hero-stat-label">Visas Approved</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">15+</div>
                <div class="hero-stat-label">Countries</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">98%</div>
                <div class="hero-stat-label">Success Rate</div>
            </div>
        </div>
    </div>

    <div class="scroll-cue">
        <span class="scroll-cue-text">Scroll</span>
        <div class="scroll-cue-line"></div>
    </div>
</section>


{{-- ── TRUST BAR ── --}}
<div class="trust-bar">
    <div class="trust-bar-inner">
        <span class="trust-item">Schengen Visa</span>
        <span class="trust-sep">✦</span>
        <span class="trust-item">Work Permit</span>
        <span class="trust-sep">✦</span>
        <span class="trust-item">Student Visa</span>
        <span class="trust-sep">✦</span>
        <span class="trust-item">Family Reunification</span>
        <span class="trust-sep">✦</span>
        <span class="trust-item">Business Visa</span>
        <span class="trust-sep">✦</span>
        <span class="trust-item">Residence Permit</span>
    </div>
</div>


{{-- ── SERVICES ── --}}
<section class="services-section">
    <div class="divider-gold"></div>
    <div class="section-wrap" style="padding-top:80px">
        <div class="services-header">
            <span class="section-label">What We Offer</span>
            <h2 class="section-title">Visa Services Tailored<br>for Your Journey</h2>
            <p class="section-sub" style="max-width:460px;margin-left:auto;margin-right:auto">From document collection to embassy submission — we manage every step with precision.</p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon icon-blue">✈️</div>
                <div class="service-title">Schengen Visa</div>
                <p class="service-desc">Travel across 27 European countries with a single visa. We prepare your complete file for tourist, business, or transit purposes.</p>
                <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
            </div>
            <div class="service-card">
                <div class="service-icon icon-gold">💼</div>
                <div class="service-title">Work Permit</div>
                <p class="service-desc">Secure your legal right to work in Spain or other EU countries. We handle employer documentation and labor authority submissions.</p>
                <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
            </div>
            <div class="service-card">
                <div class="service-icon icon-green">🎓</div>
                <div class="service-title">Student Visa</div>
                <p class="service-desc">Study at top European universities. We assist with enrollment verification, financial proofs, and visa applications.</p>
                <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
            </div>
            <div class="service-card">
                <div class="service-icon icon-purple">👨‍👩‍👧</div>
                <div class="service-title">Family Reunification</div>
                <p class="service-desc">Bring your family to Europe. We handle spousal and dependent visas with the highest care and legal accuracy.</p>
                <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
            </div>
            <div class="service-card">
                <div class="service-icon icon-orange">🏢</div>
                <div class="service-title">Business Visa</div>
                <p class="service-desc">Attend meetings, conferences, or explore business opportunities in Europe with a properly processed business visa.</p>
                <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
            </div>
            <div class="service-card">
                <div class="service-icon icon-teal">📋</div>
                <div class="service-title">Document Consulting</div>
                <p class="service-desc">Not sure what you need? Our experts review your situation and provide a full checklist tailored to your visa type.</p>
                <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
            </div>
        </div>
    </div>
</section>


{{-- ── HOW IT WORKS ── --}}
<section class="how-section">
    <div class="section-wrap">
        <div class="how-grid">
            <div>
                <span class="section-label">Our Process</span>
                <h2 class="section-title">Simple Steps,<br>Successful Visa.</h2>
                <p class="section-sub">Our digital portal keeps you updated at every stage — from document upload to embassy decision.</p>
                <div style="margin-top:32px">
                    <a href="{{ route('register') }}" class="btn-gold-lg">Create Free Account</a>
                </div>
            </div>

            <div class="step-list">
                <div class="step-card">
                    <div class="step-num">01</div>
                    <div>
                        <div class="step-title">Register & Book Consultation</div>
                        <div class="step-desc">Create your account and book a free 30-minute consultation with our visa expert.</div>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-num">02</div>
                    <div>
                        <div class="step-title">Submit Your Documents</div>
                        <div class="step-desc">Upload required documents through our secure portal. We verify and notify you of any missing items.</div>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-num">03</div>
                    <div>
                        <div class="step-title">We Process Your Application</div>
                        <div class="step-desc">Our team prepares and submits your visa application to the embassy with full legal compliance.</div>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-num">04</div>
                    <div>
                        <div class="step-title">Track & Receive Decision</div>
                        <div class="step-desc">Monitor your application status in real-time through your personal portal dashboard.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ── BLOG ── --}}
<section class="blog-section">
    <div class="section-wrap">
        <div class="blog-header">
            <div>
                <span class="section-label">Latest Updates</span>
                <h2 class="section-title" style="margin-top:12px">Visa News &<br>Insights</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn-ghost-sm">View All Posts →</a>
        </div>

        <div class="blog-grid">
            <article class="blog-card">
                <div class="blog-thumb blog-thumb-1"><span class="blog-tag">Schengen</span></div>
                <div class="blog-body">
                    <div class="blog-meta">Apr 28, 2026 &nbsp;·&nbsp; 5 min read</div>
                    <div class="blog-title">New Schengen Rules 2026: What Bangladeshi Applicants Must Know</div>
                    <a href="{{ route('blog.show', 1) }}" class="blog-read">Read Article <span>→</span></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-thumb blog-thumb-2"><span class="blog-tag">Work Permit</span></div>
                <div class="blog-body">
                    <div class="blog-meta">Apr 15, 2026 &nbsp;·&nbsp; 8 min read</div>
                    <div class="blog-title">How to Get a Spain Work Permit from Bangladesh in 2026</div>
                    <a href="{{ route('blog.show', 2) }}" class="blog-read">Read Article <span>→</span></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-thumb blog-thumb-3"><span class="blog-tag">Success Story</span></div>
                <div class="blog-body">
                    <div class="blog-meta">Apr 02, 2026 &nbsp;·&nbsp; 4 min read</div>
                    <div class="blog-title">From Dhaka to Barcelona: Our Client's Journey to a New Life</div>
                    <a href="{{ route('blog.show', 3) }}" class="blog-read">Read Article <span>→</span></a>
                </div>
            </article>
        </div>
    </div>
</section>


{{-- ── TESTIMONIALS ── --}}
<section class="testi-section">
    <div class="section-wrap">
        <div class="testi-header">
            <span class="section-label">Testimonials</span>
            <h2 class="section-title">Trusted by Hundreds</h2>
        </div>
        <div class="testi-grid">
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"I was nervous about the whole process but EuroVisa made it seamless. They guided me at every step and I got my work permit approved within 3 months!"</p>
                <div class="testi-footer">
                    <div class="testi-avatar">R</div>
                    <div>
                        <div class="testi-name">Rahim Uddin</div>
                        <div class="testi-loc">Dhaka, Bangladesh</div>
                        <div class="testi-visa">Work Permit — Spain</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Professional, responsive, and genuinely caring. They helped me get into my dream university in Berlin. Could not have done it without them."</p>
                <div class="testi-footer">
                    <div class="testi-avatar">N</div>
                    <div>
                        <div class="testi-name">Nusrat Jahan</div>
                        <div class="testi-loc">Chittagong, Bangladesh</div>
                        <div class="testi-visa">Student Visa — Germany</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Bringing my wife and children to Europe felt impossible. EuroVisa handled everything perfectly and now we are together in Paris. Forever grateful."</p>
                <div class="testi-footer">
                    <div class="testi-avatar">K</div>
                    <div>
                        <div class="testi-name">Karim Hossain</div>
                        <div class="testi-loc">Sylhet, Bangladesh</div>
                        <div class="testi-visa">Family Reunification — France</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ── FINAL CTA ── --}}
<section class="cta-section">
    <div class="cta-grid-bg"></div>
    <div class="cta-content">
        <h2 class="cta-title">Ready to Start Your<br>European Journey?</h2>
        <p class="cta-sub">Create a free account, upload your documents, and track your visa application — all in one place.</p>
        <div class="cta-btns">
            <a href="{{ route('register') }}" class="btn-gold-lg">
                Create Free Account
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('contact') }}" class="btn-outline-lg">Book Free Consultation</a>
        </div>
    </div>
</section>


{{-- ── FOOTER ── --}}
<footer class="footer">
    <div class="section-wrap">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-row">
                    <svg width="28" height="28" viewBox="0 0 36 36" fill="none">
                        <path d="M18 2L33 10V26L18 34L3 26V10L18 2Z" fill="url(#lg2)"/>
                        <path d="M12 18L16 22L24 14" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <defs>
                            <linearGradient id="lg2" x1="3" y1="2" x2="33" y2="34" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#C9A96E"/><stop offset="1" stop-color="#A0784A"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="footer-brand-name">EuroVisa Consultancy</div>
                </div>
                <p class="footer-brand-desc">Licensed visa consultancy based in Barcelona, Spain. Serving clients from Bangladesh and across South Asia since 2019.</p>
                <div class="footer-socials">
                    <a href="#" class="social-btn">Fb</a>
                    <a href="#" class="social-btn">Wa</a>
                    <a href="#" class="social-btn">Ig</a>
                </div>
            </div>

            <div>
                <div class="footer-col-title">Services</div>
                <ul class="footer-col-list">
                    <li><a href="">Schengen Visa</a></li>
                    <li><a href="">Work Permit</a></li>
                    <li><a href="">Student Visa</a></li>
                    <li><a href="">Family Reunification</a></li>
                    <li><a href="">Business Visa</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-col-title">Company</div>
                <ul class="footer-col-list">
                    <li><a href="">About Us</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="">Client Portal</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-col-title">Contact</div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">📍</span>
                    <span class="footer-contact-text">Carrer de Balmes 42,<br>Barcelona, Spain</span>
                </div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">✉️</span>
                    <span class="footer-contact-text">info@eurovisa.es</span>
                </div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">📞</span>
                    <span class="footer-contact-text">+34 612 345 678</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">© {{ date('Y') }} EuroVisa Consultancy. All rights reserved.</span>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Nav scroll glass effect
    var nav = document.getElementById('mainNav');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 40) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    document.getElementById('hamburger').addEventListener('click', function() {
        document.getElementById('mobileMenu').classList.toggle('open');
    });
</script>

</body>
</html>