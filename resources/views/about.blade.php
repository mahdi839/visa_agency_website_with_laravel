@extends('layouts.app')

@section('title', 'About Us — EuroVisa Consultancy')
@section('meta_description', 'Learn about EuroVisa Consultancy, Barcelona-based visa experts serving clients from Bangladesh since 2019.')

@push('styles')
<style>
    .page-hero {
        padding: 10rem 2rem 6rem;
        text-align: center;
        background: linear-gradient(135deg, #060C1A 0%, #0A1225 100%);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .page-hero-title {
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-size: clamp(36px, 5vw, 60px);
        font-weight: 700;
        color: #fff;
        margin-bottom: 16px;
    }
    .page-hero-sub {
        color: rgba(255,255,255,0.45);
        font-size: 17px;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .about-body {
        max-width: 760px;
        margin: 0 auto;
        padding: 80px 2rem;
        color: rgba(255,255,255,0.6);
        font-size: 16px;
        line-height: 1.8;
    }
    .about-body h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px;
        font-weight: 700;
        color: #fff;
        margin: 40px 0 16px;
    }
</style>
@endpush

@section('content')

<section class="page-hero">
    <span class="section-label">Who We Are</span>
    <h1 class="page-hero-title">About EuroVisa</h1>
    <p class="page-hero-sub">A licensed consultancy in Barcelona, dedicated to making European dreams a reality for South Asian applicants.</p>
</section>

<div class="about-body">
    <h2>Our Story</h2>
    <p>Founded in 2019, EuroVisa Consultancy has helped over 500 clients navigate the complex European visa system. Based in Barcelona, Spain, we specialize in serving applicants from Bangladesh and across South Asia.</p>

    <h2>Our Mission</h2>
    <p>We believe everyone deserves access to clear, professional visa guidance — without confusion or exploitation. Our team handles every case with full legal compliance and genuine care for each client's future.</p>
</div>

@endsection