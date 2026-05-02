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
                    <li><a href="{{ route('services') }}">Schengen Visa</a></li>
                    <li><a href="{{ route('services') }}">Work Permit</a></li>
                    <li><a href="{{ route('services') }}">Student Visa</a></li>
                    <li><a href="{{ route('services') }}">Family Reunification</a></li>
                    <li><a href="{{ route('services') }}">Business Visa</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-col-title">Company</div>
                <ul class="footer-col-list">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}">Client Portal</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Client Portal</a></li>
                    @endauth
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