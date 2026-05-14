<footer class="footer">
    <div class="section-wrap">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-row">
                    <img class="footer-logo" src="{{ asset('durdesh_logo.jpeg') }}" alt="Durdesh Travel Agency logo">
                    <div class="footer-brand-name">Durdesh Travel Agency</div>
                </div>
                <p class="footer-brand-desc">Licensed visa consultancy based in Barcelona, Spain. Serving clients from Bangladesh and across South Asia since 2019.</p>
                <div class="footer-socials">
                    <a href="#" class="social-btn" aria-label="Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 8.5V6.75c0-.5.35-.75.85-.75H17V2.25A27 27 0 0013.87 2C10.77 2 8.7 3.9 8.7 7.34V8.5H5.25v4.2H8.7V22H13v-9.3h3.35l.65-4.2H14z"/></svg>
                    </a>
                    <a href="#" class="social-btn" aria-label="WhatsApp">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2a9.85 9.85 0 00-8.36 15.05L2.5 22l5.08-1.15A9.84 9.84 0 1012.04 2zm0 2a7.84 7.84 0 016.66 11.98 7.84 7.84 0 01-9.97 2.84l-.35-.18-3.05.69.7-2.92-.22-.37A7.85 7.85 0 0112.04 4zm-3.1 3.9c-.17 0-.45.06-.68.32-.23.25-.89.87-.89 2.12 0 1.25.91 2.46 1.04 2.63.13.17 1.78 2.84 4.42 3.87 2.2.87 2.65.7 3.13.66.48-.04 1.55-.63 1.77-1.24.22-.61.22-1.13.15-1.24-.06-.11-.24-.17-.5-.3-.26-.13-1.55-.76-1.79-.85-.24-.09-.41-.13-.59.13-.17.26-.68.85-.83 1.02-.15.17-.31.2-.57.07-.26-.13-1.1-.41-2.1-1.29-.78-.69-1.3-1.55-1.45-1.81-.15-.26-.02-.4.11-.53.12-.12.26-.31.39-.46.13-.15.17-.26.26-.44.09-.17.04-.33-.02-.46-.06-.13-.59-1.42-.81-1.94-.21-.5-.43-.43-.59-.44h-.46z"/></svg>
                    </a>
                    <a href="#" class="social-btn" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/></svg>
                    </a>
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
                    <span class="footer-contact-text">+880 1511 672172</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">© {{ date('Y') }} Durdesh Travel Agency. All rights reserved.</span>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
