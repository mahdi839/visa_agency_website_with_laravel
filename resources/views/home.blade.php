@extends('layouts.app')

@section('title', config('app.name', 'EuroVisa') . ' — Your Gateway to Europe')
@section('meta_description', 'Expert visa processing for Bangladesh and beyond. Schengen, work permits, student visas processed from Spain.')

@push('styles')
<style>
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
    .hero-stats { display: flex; animation: fadeUp 0.7s 0.4s ease both; }
    .hero-stat-num { font-family: 'Cormorant Garamond', serif; font-size: 34px; font-weight: 700; color: #fff; line-height: 1; }
    .hero-stat-label { color: rgba(255,255,255,0.35); font-size: 12px; margin-top: 5px; }
    .hero-stat + .hero-stat { border-left: 1px solid rgba(255,255,255,0.1); padding-left: 28px; margin-left: 28px; }
    .scroll-cue { position: absolute; bottom: 36px; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: 6px; z-index: 2; }
    .scroll-cue-text { color: rgba(255,255,255,0.25); font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase; }
    .scroll-cue-line { width: 1px; height: 44px; background: linear-gradient(to bottom, rgba(255,255,255,0.3), transparent); animation: scrollFade 2s ease-in-out infinite; }
    @keyframes scrollFade { 0%,100%{opacity:0.4} 50%{opacity:1} }
    .application-modal { position: fixed; inset: 0; z-index: 250; display: none; align-items: center; justify-content: center; padding: 22px; background: rgba(0,0,0,0.64); backdrop-filter: blur(14px); }
    .application-modal.open { display: flex; }
    .application-panel { width: min(920px, 100%); max-height: 92vh; overflow-y: auto; background: #fff; color: #162033; border-radius: 18px; box-shadow: 0 28px 90px rgba(0,0,0,0.42); }
    .application-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding: 24px 28px 18px; border-bottom: 1px solid #e5e7eb; }
    .application-kicker { color: #a0784a; font-size: 11px; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; margin-bottom: 8px; }
    .application-title { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 30px; line-height: 1.1; color: #0f172a; }
    .application-close { width: 38px; height: 38px; border: 1px solid #e2e8f0; border-radius: 9px; background: #f8fafc; cursor: pointer; color: #475569; font-size: 24px; line-height: 1; }
    .application-body { padding: 24px 28px 28px; }
    .application-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .application-field { display: flex; flex-direction: column; gap: 7px; }
    .application-field.full { grid-column: 1 / -1; }
    .application-field label { font-size: 13px; font-weight: 700; color: #334155; }
    .application-field input, .application-field select, .application-field textarea { width: 100%; border: 1px solid #cbd5e1; border-radius: 10px; padding: 11px 12px; color: #0f172a; background: #fff; font: inherit; font-size: 14px; outline: none; }
    .application-field textarea { min-height: 106px; resize: vertical; }
    .application-field input:focus, .application-field select:focus, .application-field textarea:focus { border-color: #c9a96e; box-shadow: 0 0 0 3px rgba(201,169,110,0.16); }
    .auth-box { border: 1px solid #e2e8f0; background: #f8fafc; border-radius: 14px; padding: 16px; margin-bottom: 18px; }
    .auth-tabs { display: inline-flex; padding: 3px; border: 1px solid #e2e8f0; background: #fff; border-radius: 10px; margin-bottom: 14px; }
    .auth-tab { border: 0; background: transparent; border-radius: 8px; padding: 8px 14px; font-size: 13px; font-weight: 700; color: #64748b; cursor: pointer; }
    .auth-tab.active { background: #0f172a; color: #fff; }
    .application-errors { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; border-radius: 12px; padding: 12px 14px; margin-bottom: 16px; font-size: 13px; }
    .application-actions { display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 20px; }
    .application-submit { border: 0; cursor: pointer; }
    .application-cancel { border: 1px solid #cbd5e1; border-radius: 9px; background: #fff; color: #475569; font-size: 14px; font-weight: 700; padding: 13px 20px; cursor: pointer; }
    body.modal-locked { overflow: hidden; }

    /* ── TRUST BAR ── */
    .trust-bar { background: #0A1225; border-top: 1px solid rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.04); padding: 16px 2rem; }
    .trust-bar-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 10px 20px; }
    .trust-item { color: rgba(255,255,255,0.22); font-size: 11px; font-weight: 500; letter-spacing: 0.2em; text-transform: uppercase; }
    .trust-sep { color: rgba(201,169,110,0.35); font-size: 11px; }

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
    .blog-thumb { height: 175px; display: flex; align-items: flex-end; padding: 14px; background-size: cover; background-position: center; }
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

    /* ── PAGE-SPECIFIC RESPONSIVE ── */
    @media (max-width: 960px) {
        .hero-badges { display: none; }
        .services-grid { grid-template-columns: 1fr 1fr; }
        .blog-grid { grid-template-columns: 1fr 1fr; }
        .testi-grid { grid-template-columns: 1fr; }
        .how-grid { grid-template-columns: 1fr; gap: 48px; }
    }
    @media (max-width: 600px) {
        .services-grid, .blog-grid { grid-template-columns: 1fr; }
        .hero-cta { flex-direction: column; }
        .btn-gold-lg, .btn-outline-lg { justify-content: center; width: 100%; }
        .cta-btns { flex-direction: column; align-items: center; }
        .hero-stats { flex-wrap: wrap; gap: 20px; }
        .hero-stat + .hero-stat { border-left: none; padding-left: 0; margin-left: 0; }
        .application-grid { grid-template-columns: 1fr; }
        .application-head, .application-body { padding-left: 18px; padding-right: 18px; }
    }
</style>
@endpush

@section('content')
@php
    $applicationCountries = [
        'Australia', 'Austria', 'Belgium', 'Canada', 'Denmark', 'Finland', 'France', 'Germany', 'Greece', 'Hungary',
        'Iceland', 'Italy', 'Luxembourg', 'Malta', 'Netherlands', 'Norway', 'Poland', 'Portugal', 'Spain', 'Sweden',
        'Switzerland', 'United Kingdom', 'United States',
    ];
@endphp

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
            <button type="button" class="btn-gold-lg application-open" style="border:0;cursor:pointer">
                Start Your Application
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </button>
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


<div id="applicationModal" class="application-modal {{ $errors->any() ? 'open' : '' }}" role="dialog" aria-modal="true" aria-labelledby="applicationModalTitle">
    <div class="application-panel">
        <div class="application-head">
            <div>
                <p class="application-kicker">Application Request</p>
                <h2 id="applicationModalTitle" class="application-title">Start your application</h2>
            </div>
            <button type="button" class="application-close application-close-btn" aria-label="Close application popup">&times;</button>
        </div>

        <form method="POST" action="{{ route('visa-applications.store') }}" enctype="multipart/form-data" class="application-body">
            @csrf

            @if($errors->any())
                <div class="application-errors">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @guest
                <div class="auth-box" data-auth-wrapper>
                    <div class="auth-tabs">
                        <button type="button" class="auth-tab" data-auth-tab="login">Log In</button>
                        <button type="button" class="auth-tab" data-auth-tab="register">Register</button>
                    </div>
                    <input type="hidden" name="auth_mode" id="authMode" value="{{ old('auth_mode', 'login') }}">

                    <div class="application-grid" data-auth-panel="register">
                        <div class="application-field full">
                            <label for="applicationName">Full Name</label>
                            <input id="applicationName" type="text" name="name" value="{{ old('name') }}" autocomplete="name">
                        </div>
                    </div>

                    <div class="application-grid">
                        <div class="application-field">
                            <label for="applicationEmail">Email Address</label>
                            <input id="applicationEmail" type="email" name="email" value="{{ old('email') }}" autocomplete="email">
                        </div>
                        <div class="application-field">
                            <label for="applicationPassword">Password</label>
                            <input id="applicationPassword" type="password" name="password" autocomplete="current-password">
                        </div>
                        <div class="application-field" data-auth-panel="register">
                            <label for="applicationPasswordConfirmation">Confirm Password</label>
                            <input id="applicationPasswordConfirmation" type="password" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                </div>
            @endguest

            <div class="application-grid">
                <div class="application-field">
                    <label for="subject">Application Subject</label>
                    <select id="subject" name="subject" required>
                        <option value="">Select subject</option>
                        @foreach(\App\Models\VisaApplication::SUBJECTS as $value => $label)
                            <option value="{{ $value }}" @selected(old('subject') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="application-field">
                    <label for="country">Country</label>
                    <input id="country" name="country" value="{{ old('country') }}" list="countryOptions" placeholder="Search and select country" required>
                    <datalist id="countryOptions">
                        @foreach($applicationCountries as $country)
                            <option value="{{ $country }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div class="application-field full">
                    <label for="description">Application Details</label>
                    <textarea id="description" name="description" placeholder="Tell us what you need help with">{{ old('description') }}</textarea>
                </div>

                <div class="application-field">
                    <label for="document">Document Image</label>
                    <input id="document" type="file" name="document" accept="image/*">
                </div>

                <div class="application-field">
                    <label for="urgency">Visa Urgency</label>
                    <select id="urgency" name="urgency" required>
                        @foreach(\App\Models\VisaApplication::URGENCIES as $value => $label)
                            <option value="{{ $value }}" @selected(old('urgency', 'normal') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="application-field full">
                    <label for="note">Note</label>
                    <textarea id="note" name="note" placeholder="Anything else our team should know">{{ old('note') }}</textarea>
                </div>
            </div>

            <div class="application-actions">
                <button type="button" class="application-cancel application-close-btn">Cancel</button>
                <button type="submit" class="btn-gold-lg application-submit">Submit Application</button>
            </div>
        </form>
    </div>
</div>

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
            @forelse($services as $index => $service)
                @php($iconClass = ['icon-blue', 'icon-gold', 'icon-green', 'icon-purple', 'icon-orange', 'icon-teal'][$index % 6])
                <div class="service-card">
                    <div class="service-icon {{ $iconClass }}">{{ $service->icon ?: '?' }}</div>
                    <div class="service-title">{{ $service->title }}</div>
                    <p class="service-desc">{{ $service->description }}</p>
                    <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
                </div>
            @empty
                <div class="service-card">
                    <div class="service-icon icon-blue">?</div>
                    <div class="service-title">Schengen Visa</div>
                    <p class="service-desc">Travel across Europe with a complete visa file prepared by our expert team.</p>
                    <a href="{{ route('services') }}" class="service-more">Learn more <span>→</span></a>
                </div>
            @endforelse
        </div>    </div>
</section>


{{-- HOW IT WORKS ── --}}
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
            @forelse($latestPosts as $index => $post)
                <article class="blog-card">
                    <div class="blog-thumb {{ $post->feature_image ? '' : 'blog-thumb-'.(($index % 3) + 1) }}"
                         @if($post->feature_image) style="background-image: linear-gradient(to top, rgba(6,12,26,0.7), rgba(6,12,26,0.05)), url('{{ asset('storage/'.$post->feature_image) }}')" @endif>
                        <span class="blog-tag">Visa News</span>
                    </div>
                    <div class="blog-body">
                        <div class="blog-meta">{{ ($post->published_at ?? $post->created_at)->format('M d, Y') }} &nbsp;·&nbsp; {{ max(1, ceil(str_word_count(strip_tags($post->description)) / 200)) }} min read</div>
                        <div class="blog-title">{{ $post->title }}</div>
                        <a href="{{ route('blog.show', $post) }}" class="blog-read">Read Article <span>→</span></a>
                    </div>
                </article>
            @empty
                <article class="blog-card">
                    <div class="blog-thumb blog-thumb-1"><span class="blog-tag">Visa News</span></div>
                    <div class="blog-body">
                        <div class="blog-meta">Coming soon</div>
                        <div class="blog-title">Fresh visa news and insights will appear here after publishing.</div>
                        <a href="{{ route('blog.index') }}" class="blog-read">View Blog <span>→</span></a>
                    </div>
                </article>
            @endforelse
        </div>    </div>
</section>


{{-- TESTIMONIALS ── --}}
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

@endsection

@push('scripts')
<script>
    (function () {
        var modal = document.getElementById('applicationModal');
        if (!modal) return;

        var authMode = document.getElementById('authMode');
        var authTabs = modal.querySelectorAll('[data-auth-tab]');
        var registerPanels = modal.querySelectorAll('[data-auth-panel="register"]');

        function openModal() {
            modal.classList.add('open');
            document.body.classList.add('modal-locked');
        }

        function closeModal() {
            modal.classList.remove('open');
            document.body.classList.remove('modal-locked');
        }

        function setAuthMode(mode) {
            if (!authMode) return;
            authMode.value = mode;
            authTabs.forEach(function (tab) {
                tab.classList.toggle('active', tab.dataset.authTab === mode);
            });
            registerPanels.forEach(function (panel) {
                panel.style.display = mode === 'register' ? '' : 'none';
            });
        }

        document.querySelectorAll('.application-open').forEach(function (button) {
            button.addEventListener('click', openModal);
        });

        modal.querySelectorAll('.application-close-btn').forEach(function (button) {
            button.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('open')) closeModal();
        });

        authTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                setAuthMode(tab.dataset.authTab);
            });
        });

        setAuthMode(authMode ? authMode.value : 'login');
        if (modal.classList.contains('open')) document.body.classList.add('modal-locked');
    })();
</script>
@endpush
