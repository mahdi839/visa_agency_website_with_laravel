@extends('layouts.app')

@section('title', 'Login — EuroVisa Consultancy')

@push('styles')
<style>
    /* Hide main nav padding since this is a full-screen auth page */
    body { background: #060C1A; }

    .auth-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding-top: 72px; /* offset fixed nav */
    }

    /* ── LEFT PANEL ── */
    .auth-left {
        position: relative;
        background: linear-gradient(145deg, #060C1A 0%, #0A1830 60%, #0F2040 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem;
        overflow: hidden;
    }
    .auth-left-grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(201,169,110,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(201,169,110,0.04) 1px, transparent 1px);
        background-size: 48px 48px;
    }
    .auth-left-orb1 {
        position: absolute; top: 15%; left: 10%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(201,169,110,0.08), transparent 65%);
        border-radius: 50%;
    }
    .auth-left-orb2 {
        position: absolute; bottom: 20%; right: 5%;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(56,100,220,0.07), transparent 65%);
        border-radius: 50%;
    }
    .auth-left-content { position: relative; z-index: 2; }
    .auth-left-badge {
        display: inline-flex; align-items: center; gap: 8px;
        margin-bottom: 2rem;
        animation: fadeUp 0.6s ease both;
    }
    .auth-left-badge-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #C9A96E;
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }
    .auth-left-badge-text {
        color: #C9A96E; font-size: 10px; font-weight: 600;
        letter-spacing: 0.25em; text-transform: uppercase;
    }
    .auth-left-heading {
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-size: clamp(34px, 3.5vw, 52px);
        font-weight: 700; color: #fff;
        line-height: 1.1; margin-bottom: 1.25rem;
        animation: fadeUp 0.6s 0.1s ease both;
    }
    .auth-left-heading .accent {
        background: linear-gradient(135deg, #E8C98A 0%, #C9A96E 50%, #E07B39 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .auth-left-sub {
        color: rgba(255,255,255,0.42);
        font-size: 15px; line-height: 1.75;
        max-width: 380px; margin-bottom: 2.5rem;
        animation: fadeUp 0.6s 0.2s ease both;
    }

    /* Trust points */
    .auth-trust-list {
        display: flex; flex-direction: column; gap: 14px;
        animation: fadeUp 0.6s 0.3s ease both;
    }
    .auth-trust-item {
        display: flex; align-items: center; gap: 12px;
    }
    .auth-trust-icon {
        width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
        background: rgba(201,169,110,0.1);
        border: 1px solid rgba(201,169,110,0.18);
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
    }
    .auth-trust-text {
        color: rgba(255,255,255,0.5); font-size: 13px;
    }
    .auth-trust-text strong { color: rgba(255,255,255,0.82); font-weight: 500; }

    /* Stat row */
    .auth-stats {
        display: flex; gap: 28px; margin-top: 3rem; padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.07);
        animation: fadeUp 0.6s 0.4s ease both;
    }
    .auth-stat-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 700; color: #fff; line-height: 1;
    }
    .auth-stat-label { color: rgba(255,255,255,0.3); font-size: 11px; margin-top: 4px; }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* ── RIGHT PANEL (Form) ── */
    .auth-right {
        background: #080E1E;
        border-left: 1px solid rgba(255,255,255,0.06);
        display: flex; align-items: center; justify-content: center;
        padding: 3rem 2rem;
    }
    .auth-form-wrap {
        width: 100%; max-width: 400px;
        animation: fadeUp 0.7s 0.15s ease both;
    }
    .auth-form-title {
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-size: 32px; font-weight: 700; color: #fff;
        margin-bottom: 6px;
    }
    .auth-form-sub {
        color: rgba(255,255,255,0.35); font-size: 14px; margin-bottom: 2rem;
    }
    .auth-form-sub a {
        color: #C9A96E; transition: color 0.2s;
    }
    .auth-form-sub a:hover { color: #E8C98A; }

    /* Form fields */
    .form-group { margin-bottom: 1.25rem; }
    .form-label {
        display: block; color: rgba(255,255,255,0.55);
        font-size: 12px; font-weight: 500; letter-spacing: 0.06em;
        text-transform: uppercase; margin-bottom: 8px;
    }
    .form-input {
        width: 100%; background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 9px; padding: 12px 16px;
        color: #fff; font-size: 14px; font-family: 'DM Sans', sans-serif;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .form-input::placeholder { color: rgba(255,255,255,0.2); }
    .form-input:focus {
        border-color: rgba(201,169,110,0.45);
        background: rgba(201,169,110,0.04);
        box-shadow: 0 0 0 3px rgba(201,169,110,0.08);
    }
    .form-input:autofill,
    .form-input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 40px #0F1728 inset !important;
        -webkit-text-fill-color: #fff !important;
    }

    /* Error */
    .form-error {
        color: #f87171; font-size: 12px; margin-top: 6px;
        display: flex; align-items: center; gap: 5px;
    }
    .form-error::before { content: '!'; font-weight: 700; font-size: 10px; width: 16px; height: 16px; border-radius: 50%; background: rgba(248,113,113,0.18); display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }

    /* Row between forgot + remember */
    .form-row {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    .form-checkbox-label {
        display: flex; align-items: center; gap: 8px; cursor: pointer;
    }
    .form-checkbox {
        width: 16px; height: 16px; border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.15);
        background: rgba(255,255,255,0.04);
        accent-color: #C9A96E; cursor: pointer;
    }
    .form-checkbox-text { color: rgba(255,255,255,0.45); font-size: 13px; }
    .form-forgot {
        color: rgba(201,169,110,0.7); font-size: 13px;
        transition: color 0.2s;
    }
    .form-forgot:hover { color: #C9A96E; }

    /* Submit button */
    .btn-auth-submit {
        width: 100%; padding: 13px 24px;
        background: linear-gradient(135deg, #C9A96E 0%, #A0784A 100%);
        border: none; border-radius: 9px; cursor: pointer;
        color: #fff; font-size: 15px; font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        box-shadow: 0 4px 24px rgba(201,169,110,0.28);
        transition: all 0.22s; display: flex; align-items: center;
        justify-content: center; gap: 8px;
    }
    .btn-auth-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 36px rgba(201,169,110,0.4);
    }
    .btn-auth-submit:active { transform: translateY(0); }

    /* Session status */
    .session-status {
        background: rgba(34,197,94,0.08);
        border: 1px solid rgba(34,197,94,0.2);
        border-radius: 9px; padding: 12px 16px;
        color: #86efac; font-size: 13px; margin-bottom: 1.25rem;
    }

    /* Divider */
    .auth-divider {
        display: flex; align-items: center; gap: 12px; margin: 1.5rem 0;
    }
    .auth-divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.07); }
    .auth-divider-text { color: rgba(255,255,255,0.2); font-size: 11px; letter-spacing: 0.1em; }

    .auth-register-link {
        text-align: center; color: rgba(255,255,255,0.3);
        font-size: 13px; margin-top: 1.25rem;
    }
    .auth-register-link a { color: #C9A96E; font-weight: 500; transition: color 0.2s; }
    .auth-register-link a:hover { color: #E8C98A; }

    /* ── RESPONSIVE ── */
    @media (max-width: 820px) {
        .auth-page { grid-template-columns: 1fr; }
        .auth-left { display: none; }
        .auth-right { min-height: calc(100vh - 72px); }
    }
</style>
@endpush

@section('content')
<div class="auth-page">

    {{-- ── LEFT PANEL ── --}}
    <div class="auth-left">
        <div class="auth-left-grid"></div>
        <div class="auth-left-orb1"></div>
        <div class="auth-left-orb2"></div>

        <div class="auth-left-content">
            <div class="auth-left-badge">
                <div class="auth-left-badge-dot"></div>
                <span class="auth-left-badge-text">Secure Client Portal</span>
            </div>

            <h2 class="auth-left-heading">
                Your European<br>
                Journey <span class="accent">Awaits.</span>
            </h2>

            <p class="auth-left-sub">
                Sign in to track your visa application, upload documents, and communicate with your consultant — all in one secure place.
            </p>

            <div class="auth-trust-list">
                <div class="auth-trust-item">
                    <div class="auth-trust-icon">📋</div>
                    <div class="auth-trust-text"><strong>Real-time tracking</strong> — see your application status instantly</div>
                </div>
                <div class="auth-trust-item">
                    <div class="auth-trust-icon">📁</div>
                    <div class="auth-trust-text"><strong>Secure uploads</strong> — share documents safely with your expert</div>
                </div>
                <div class="auth-trust-item">
                    <div class="auth-trust-icon">💬</div>
                    <div class="auth-trust-text"><strong>Direct messaging</strong> — reach your consultant anytime</div>
                </div>
            </div>

            <div class="auth-stats">
                <div>
                    <div class="auth-stat-num">500+</div>
                    <div class="auth-stat-label">Visas Approved</div>
                </div>
                <div>
                    <div class="auth-stat-num">98%</div>
                    <div class="auth-stat-label">Success Rate</div>
                </div>
                <div>
                    <div class="auth-stat-num">15+</div>
                    <div class="auth-stat-label">Countries</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── RIGHT PANEL (Form) ── --}}
    <div class="auth-right">
        <div class="auth-form-wrap">

            <h1 class="auth-form-title">Welcome back</h1>
            <p class="auth-form-sub">
                Don't have an account?
                <a href="{{ route('register') }}">Create one free →</a>
            </p>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input
                        id="email"
                        class="form-input"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        id="password"
                        class="form-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="form-row">
                    <label class="form-checkbox-label">
                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                        <span class="form-checkbox-text">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-forgot">Forgot password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-auth-submit">
                    Sign In to Portal
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>

                <div class="auth-divider">
                    <div class="auth-divider-line"></div>
                    <span class="auth-divider-text">OR</span>
                    <div class="auth-divider-line"></div>
                </div>

                <div class="auth-register-link">
                    New to EuroVisa?
                    <a href="{{ route('register') }}">Create a free account</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection