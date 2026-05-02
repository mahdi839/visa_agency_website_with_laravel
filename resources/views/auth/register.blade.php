@extends('layouts.app')

@section('title', 'Create Account — EuroVisa Consultancy')

@push('styles')
<style>
    body { background: #060C1A; }

    .auth-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding-top: 72px;
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
        position: absolute; top: 10%; right: 10%;
        width: 320px; height: 320px;
        background: radial-gradient(circle, rgba(201,169,110,0.07), transparent 65%);
        border-radius: 50%;
    }
    .auth-left-orb2 {
        position: absolute; bottom: 15%; left: 0%;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(56,100,220,0.06), transparent 65%);
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
        font-size: clamp(32px, 3.2vw, 50px);
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

    /* Steps */
    .auth-steps {
        display: flex; flex-direction: column; gap: 0;
        animation: fadeUp 0.6s 0.3s ease both;
    }
    .auth-step {
        display: flex; gap: 16px; align-items: flex-start;
        position: relative; padding-bottom: 24px;
    }
    .auth-step:last-child { padding-bottom: 0; }
    .auth-step-line {
        position: absolute; left: 16px; top: 34px; bottom: 0;
        width: 1px;
        background: linear-gradient(to bottom, rgba(201,169,110,0.2), transparent);
    }
    .auth-step:last-child .auth-step-line { display: none; }
    .auth-step-num {
        width: 33px; height: 33px; border-radius: 50%; flex-shrink: 0;
        background: rgba(201,169,110,0.1);
        border: 1px solid rgba(201,169,110,0.25);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 15px; font-weight: 700; color: #C9A96E;
    }
    .auth-step-title { color: rgba(255,255,255,0.8); font-size: 13px; font-weight: 600; margin-bottom: 3px; }
    .auth-step-desc { color: rgba(255,255,255,0.35); font-size: 12px; line-height: 1.55; }

    /* Flags */
    .auth-flags {
        display: flex; gap: 10px; margin-top: 2.5rem; flex-wrap: wrap;
        animation: fadeUp 0.6s 0.4s ease both;
    }
    .auth-flag {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 20px; padding: 6px 14px;
        font-size: 12px; color: rgba(255,255,255,0.55);
    }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }

    /* ── RIGHT PANEL ── */
    .auth-right {
        background: #080E1E;
        border-left: 1px solid rgba(255,255,255,0.06);
        display: flex; align-items: center; justify-content: center;
        padding: 3rem 2rem;
    }
    .auth-form-wrap {
        width: 100%; max-width: 420px;
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
    .auth-form-sub a { color: #C9A96E; transition: color 0.2s; }
    .auth-form-sub a:hover { color: #E8C98A; }

    /* Fields */
    .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-group { margin-bottom: 1.1rem; }
    .form-label {
        display: block; color: rgba(255,255,255,0.5);
        font-size: 11px; font-weight: 600; letter-spacing: 0.08em;
        text-transform: uppercase; margin-bottom: 7px;
    }
    .form-input-wrap { position: relative; }
    .form-input-icon {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        font-size: 14px; pointer-events: none; opacity: 0.5;
    }
    .form-input {
        width: 100%;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 9px; padding: 11px 14px 11px 38px;
        color: #fff; font-size: 14px; font-family: 'DM Sans', sans-serif;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .form-input.no-icon { padding-left: 14px; }
    .form-input::placeholder { color: rgba(255,255,255,0.18); }
    .form-input:focus {
        border-color: rgba(201,169,110,0.45);
        background: rgba(201,169,110,0.04);
        box-shadow: 0 0 0 3px rgba(201,169,110,0.08);
    }
    .form-input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 40px #0F1728 inset !important;
        -webkit-text-fill-color: #fff !important;
    }

    /* Password strength */
    .pw-strength { margin-top: 8px; display: flex; gap: 4px; }
    .pw-bar {
        height: 3px; flex: 1; border-radius: 99px;
        background: rgba(255,255,255,0.07);
        transition: background 0.3s;
    }
    .pw-bar.weak   { background: #ef4444; }
    .pw-bar.fair   { background: #f97316; }
    .pw-bar.good   { background: #eab308; }
    .pw-bar.strong { background: #22c55e; }
    .pw-hint { color: rgba(255,255,255,0.25); font-size: 11px; margin-top: 5px; }

    /* Error */
    .form-error {
        color: #f87171; font-size: 12px; margin-top: 5px;
        display: flex; align-items: center; gap: 5px;
    }
    .form-error::before {
        content: '!'; font-weight: 700; font-size: 9px;
        width: 15px; height: 15px; border-radius: 50%;
        background: rgba(248,113,113,0.15);
        display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
    }

    /* Terms */
    .form-terms {
        display: flex; align-items: flex-start; gap: 10px;
        margin-bottom: 1.4rem; margin-top: 0.25rem;
    }
    .form-checkbox {
        width: 16px; height: 16px; border-radius: 4px; flex-shrink: 0;
        border: 1px solid rgba(255,255,255,0.15);
        background: rgba(255,255,255,0.04);
        accent-color: #C9A96E; cursor: pointer; margin-top: 1px;
    }
    .form-terms-text { color: rgba(255,255,255,0.35); font-size: 12px; line-height: 1.6; }
    .form-terms-text a { color: #C9A96E; transition: color 0.2s; }
    .form-terms-text a:hover { color: #E8C98A; }

    /* Submit */
    .btn-auth-submit {
        width: 100%; padding: 13px 24px;
        background: linear-gradient(135deg, #C9A96E 0%, #A0784A 100%);
        border: none; border-radius: 9px; cursor: pointer;
        color: #fff; font-size: 15px; font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        box-shadow: 0 4px 24px rgba(201,169,110,0.28);
        transition: all 0.22s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-auth-submit:hover { transform: translateY(-1px); box-shadow: 0 8px 36px rgba(201,169,110,0.4); }
    .btn-auth-submit:active { transform: translateY(0); }

    .auth-login-link {
        text-align: center; color: rgba(255,255,255,0.28);
        font-size: 13px; margin-top: 1.25rem;
    }
    .auth-login-link a { color: #C9A96E; font-weight: 500; transition: color 0.2s; }
    .auth-login-link a:hover { color: #E8C98A; }

    /* Secure badge */
    .auth-secure {
        display: flex; align-items: center; justify-content: center;
        gap: 6px; margin-top: 1.5rem;
        color: rgba(255,255,255,0.18); font-size: 11px;
    }
    .auth-secure-icon { font-size: 13px; }

    /* ── RESPONSIVE ── */
    @media (max-width: 820px) {
        .auth-page { grid-template-columns: 1fr; }
        .auth-left { display: none; }
        .auth-right { min-height: calc(100vh - 72px); }
    }
    @media (max-width: 400px) {
        .form-row-2 { grid-template-columns: 1fr; }
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
                <span class="auth-left-badge-text">Free to Get Started</span>
            </div>

            <h2 class="auth-left-heading">
                Begin Your Path<br>
                to <span class="accent">Europe</span><br>
                Today.
            </h2>

            <p class="auth-left-sub">
                Create your free account in seconds and get access to our full visa portal — document upload, real-time tracking, and expert support.
            </p>

            <div class="auth-steps">
                <div class="auth-step">
                    <div class="auth-step-num">1</div>
                    <div class="auth-step-line"></div>
                    <div>
                        <div class="auth-step-title">Create your free account</div>
                        <div class="auth-step-desc">Takes less than a minute. No credit card required.</div>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="auth-step-num">2</div>
                    <div class="auth-step-line"></div>
                    <div>
                        <div class="auth-step-title">Book a free consultation</div>
                        <div class="auth-step-desc">Talk to a visa expert about your specific situation.</div>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="auth-step-num">3</div>
                    <div class="auth-step-line"></div>
                    <div>
                        <div class="auth-step-title">Submit & track your visa</div>
                        <div class="auth-step-desc">Upload documents and follow every step in real-time.</div>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="auth-step-num">4</div>
                    <div>
                        <div class="auth-step-title">Travel to Europe</div>
                        <div class="auth-step-desc">Join 500+ clients who've already made it across.</div>
                    </div>
                </div>
            </div>

            <div class="auth-flags">
                <span class="auth-flag">🇪🇸 Spain</span>
                <span class="auth-flag">🇩🇪 Germany</span>
                <span class="auth-flag">🇫🇷 France</span>
                <span class="auth-flag">🇮🇹 Italy</span>
                <span class="auth-flag">🇳🇱 Netherlands</span>
            </div>
        </div>
    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="auth-right">
        <div class="auth-form-wrap">

            <h1 class="auth-form-title">Create account</h1>
            <p class="auth-form-sub">
                Already have one?
                <a href="{{ route('login') }}">Sign in instead →</a>
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">👤</span>
                        <input id="name" class="form-input" type="text" name="name"
                            value="{{ old('name') }}" required autofocus autocomplete="name"
                            placeholder="e.g. Rahim Uddin">
                    </div>
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">✉️</span>
                        <input id="email" class="form-input" type="email" name="email"
                            value="{{ old('email') }}" required autocomplete="username"
                            placeholder="you@example.com">
                    </div>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Passwords side by side --}}
                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-input-wrap">
                            <span class="form-input-icon">🔒</span>
                            <input id="password" class="form-input" type="password" name="password"
                                required autocomplete="new-password"
                                placeholder="••••••••"
                                oninput="checkStrength(this.value)">
                        </div>
                        <div class="pw-strength">
                            <div class="pw-bar" id="bar1"></div>
                            <div class="pw-bar" id="bar2"></div>
                            <div class="pw-bar" id="bar3"></div>
                            <div class="pw-bar" id="bar4"></div>
                        </div>
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm</label>
                        <div class="form-input-wrap">
                            <span class="form-input-icon">🔒</span>
                            <input id="password_confirmation" class="form-input" type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••">
                        </div>
                        @error('password_confirmation')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Terms --}}
                <div class="form-terms">
                    <input type="checkbox" class="form-checkbox" id="terms" required>
                    <label class="form-terms-text" for="terms">
                        I agree to EuroVisa's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I understand my data will be used for visa processing purposes.
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-auth-submit">
                    Create Free Account
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <div class="auth-login-link">
                Already registered?
                <a href="{{ route('login') }}">Sign in to your portal</a>
            </div>

            <div class="auth-secure">
                <span class="auth-secure-icon">🔐</span>
                256-bit SSL encrypted · Your data is safe with us
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function checkStrength(val) {
        const bars = [
            document.getElementById('bar1'),
            document.getElementById('bar2'),
            document.getElementById('bar3'),
            document.getElementById('bar4'),
        ];
        // Reset
        bars.forEach(b => b.className = 'pw-bar');

        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = ['weak', 'fair', 'good', 'strong'];
        const colors = ['weak', 'fair', 'good', 'strong'];
        for (let i = 0; i < score; i++) {
            bars[i].classList.add(colors[score - 1]);
        }
    }
</script>
@endpush