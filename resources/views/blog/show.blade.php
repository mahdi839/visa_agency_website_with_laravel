@extends('layouts.app')

@section('title', $post->title . ' - ' . config('app.name', 'EuroVisa'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($post->description), 155))

@push('styles')
<style>
    .post-hero { background: #060C1A; padding: 150px 0 70px; border-bottom: 1px solid rgba(201,169,110,0.07); }
    .post-meta { color: rgba(255,255,255,0.35); font-size: 13px; margin-top: 18px; }
    .post-image { width: 100%; max-height: 480px; object-fit: cover; border-radius: 14px; border: 1px solid rgba(255,255,255,0.08); margin-top: 36px; }
    .post-body-wrap { background: #060C1A; padding: 70px 0 100px; }
    .post-body { max-width: 820px; color: rgba(255,255,255,0.72); font-size: 17px; line-height: 1.85; }
    .post-body h1, .post-body h2, .post-body h3, .post-body h4 { font-family: 'Cormorant Garamond', serif; color: #fff; line-height: 1.2; margin: 1.5em 0 0.5em; }
    .post-body p, .post-body ul, .post-body ol { margin-bottom: 1.1em; }
    .post-body a { color: #C9A96E; }
    .post-body strong { color: #fff; }
</style>
@endpush

@section('content')
<section class="post-hero">
    <div class="section-wrap">
        <span class="section-label">Visa News</span>
        <h1 class="section-title" style="max-width:850px">{{ $post->title }}</h1>
        <div class="post-meta">{{ ($post->published_at ?? $post->created_at)->format('M d, Y') }} &nbsp;·&nbsp; {{ max(1, ceil(str_word_count(strip_tags($post->description)) / 200)) }} min read</div>
        @if($post->feature_image)
            <img src="{{ asset('storage/'.$post->feature_image) }}" alt="{{ $post->title }}" class="post-image">
        @endif
    </div>
</section>

<section class="post-body-wrap">
    <div class="section-wrap">
        <article class="post-body">
            {!! $post->description !!}
        </article>
    </div>
</section>
@endsection
