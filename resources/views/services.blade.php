@extends('layouts.app')

@section('title', 'Services - ' . config('app.name', 'EuroVisa'))
@section('meta_description', 'Visa services tailored for your journey.')

@push('styles')
<style>
    .services-hero { background: #060C1A; padding: 150px 0 70px; border-bottom: 1px solid rgba(201,169,110,0.07); }
    .services-page { background: #060C1A; padding: 70px 0 100px; }
    .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .service-card { background: rgba(255,255,255,0.028); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 2rem; transition: all 0.3s ease; }
    .service-card:hover { background: rgba(255,255,255,0.055); border-color: rgba(201,169,110,0.22); transform: translateY(-5px); box-shadow: 0 24px 60px rgba(0,0,0,0.3); }
    .service-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 20px; background: rgba(201,169,110,0.13); }
    .service-title { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 10px; }
    .service-desc { color: rgba(255,255,255,0.42); font-size: 14px; line-height: 1.7; }
    .empty-state { border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 48px; color: rgba(255,255,255,0.45); text-align: center; }
    @media (max-width: 960px) { .services-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 600px) { .services-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<section class="services-hero">
    <div class="section-wrap">
        <span class="section-label">What We Offer</span>
        <h1 class="section-title">Visa Services Tailored<br>for Your Journey</h1>
        <p class="section-sub" style="max-width:560px">From document collection to embassy submission, we manage every step with precision.</p>
    </div>
</section>

<section class="services-page">
    <div class="section-wrap">
        @if($services->count())
            <div class="services-grid">
                @foreach($services as $service)
                    <article class="service-card">
                        <div class="service-icon">{{ $service->icon ?: '*' }}</div>
                        <h2 class="service-title">{{ $service->title }}</h2>
                        <p class="service-desc">{{ $service->description }}</p>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">No published services yet.</div>
        @endif
    </div>
</section>
@endsection
