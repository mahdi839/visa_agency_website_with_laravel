@extends('layouts.app')

@section('title', 'Contact Us - ' . config('app.name', 'EuroVisa'))
@section('meta_description', 'Contact Durdesh Travel Agency for visa consultation, support, and application guidance.')

@push('styles')
<style>
    .contact-hero { background: #060C1A; padding: 150px 0 70px; border-bottom: 1px solid rgba(201,169,110,0.07); }
    .contact-page { background: #060C1A; padding: 70px 0 100px; }
    .contact-grid { display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 28px; align-items: start; }
    .contact-panel, .contact-info { background: rgba(255,255,255,0.028); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 28px; }
    .contact-fields { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .contact-field.full { grid-column: 1 / -1; }
    .contact-field label { display: block; color: rgba(255,255,255,0.72); font-size: 13px; font-weight: 600; margin-bottom: 7px; }
    .contact-field input, .contact-field textarea { width: 100%; border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; background: rgba(255,255,255,0.04); color: #fff; font: inherit; font-size: 14px; padding: 12px 13px; outline: none; }
    .contact-field textarea { min-height: 150px; resize: vertical; }
    .contact-field input:focus, .contact-field textarea:focus { border-color: rgba(201,169,110,0.6); box-shadow: 0 0 0 3px rgba(201,169,110,0.14); }
    .contact-success { background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.3); color: #a7f3d0; border-radius: 12px; padding: 13px 15px; margin-bottom: 18px; font-size: 14px; }
    .contact-errors { background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3); color: #fecaca; border-radius: 12px; padding: 13px 15px; margin-bottom: 18px; font-size: 14px; }
    .info-list { display: grid; gap: 18px; }
    .info-item { display: flex; gap: 13px; align-items: flex-start; }
    .info-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: rgba(201,169,110,0.13); color: #C9A96E; font-size: 14px; font-weight: 700; flex-shrink: 0; }
    .info-title { color: #fff; font-size: 14px; font-weight: 700; margin-bottom: 4px; }
    .info-text { color: rgba(255,255,255,0.42); font-size: 14px; line-height: 1.65; }
    @media (max-width: 900px) { .contact-grid, .contact-fields { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<section class="contact-hero">
    <div class="section-wrap">
        <span class="section-label">Contact Us</span>
        <h1 class="section-title">Speak With Our<br>Visa Team</h1>
        <p class="section-sub" style="max-width:560px">Send your question, document concern, or consultation request. Our team will review it and get back to you.</p>
    </div>
</section>

<section class="contact-page">
    <div class="section-wrap">
        <div class="contact-grid">
            <div class="contact-panel">
                @if(session('success'))
                    <div class="contact-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="contact-errors">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="contact-fields">
                    @csrf
                    <div class="contact-field">
                        <label for="name">Full Name</label>
                        <input id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="contact-field">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="contact-field">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                    <div class="contact-field">
                        <label for="subject">Subject</label>
                        <input id="subject" name="subject" value="{{ old('subject') }}" required>
                    </div>
                    <div class="contact-field full">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="contact-field full">
                        <button type="submit" class="btn-gold-lg" style="border:0;cursor:pointer">Send Message</button>
                    </div>
                </form>
            </div>

            <aside class="contact-info">
                <div class="info-list">
                    <div class="info-item">
                        <div class="info-icon">AD</div>
                        <div>
                            <div class="info-title">Office Address</div>
                            <div class="info-text">Barcelona, Spain<br>Serving clients in Bangladesh and Europe.</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">EM</div>
                        <div>
                            <div class="info-title">Email</div>
                            <div class="info-text">info@durdeshtravel.com<br>support@durdeshtravel.com</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">PH</div>
                        <div>
                            <div class="info-title">Phone & WhatsApp</div>
                            <div class="info-text">+880 1511 672172<br>Response within business hours.</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">HR</div>
                        <div>
                            <div class="info-title">Office Hours</div>
                            <div class="info-text">Monday to Friday: 9:00 - 18:00<br>Saturday: 10:00 - 14:00</div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
