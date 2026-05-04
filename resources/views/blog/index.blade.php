@extends('layouts.app')

@section('title', 'Blog - ' . config('app.name', 'EuroVisa'))
@section('meta_description', 'Latest visa news and insights.')

@push('styles')
<style>
    .page-hero { background: #060C1A; padding: 150px 0 70px; border-bottom: 1px solid rgba(201,169,110,0.07); }
    .blog-page { background: #060C1A; padding: 70px 0 100px; }
    .blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .blog-card { background: rgba(255,255,255,0.025); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; overflow: hidden; transition: all 0.3s ease; }
    .blog-card:hover { border-color: rgba(201,169,110,0.18); transform: translateY(-4px); box-shadow: 0 18px 50px rgba(0,0,0,0.28); }
    .blog-thumb { height: 190px; display: flex; align-items: flex-end; padding: 14px; background-size: cover; background-position: center; background-image: linear-gradient(135deg, #0F1D3A 0%, #1a2f5a 100%); }
    .blog-tag { background: linear-gradient(135deg, #C9A96E, #A0784A); color: #fff; font-size: 10px; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 11px; border-radius: 5px; }
    .blog-body { padding: 1.2rem 1.4rem; }
    .blog-meta { color: rgba(255,255,255,0.25); font-size: 11px; margin-bottom: 10px; }
    .blog-title { font-family: 'Cormorant Garamond', serif; font-size: 20px; font-weight: 700; color: #fff; line-height: 1.35; margin-bottom: 12px; }
    .blog-excerpt { color: rgba(255,255,255,0.42); font-size: 14px; line-height: 1.65; margin-bottom: 16px; }
    .blog-read { color: #C9A96E; font-size: 12px; font-weight: 500; display: inline-flex; align-items: center; gap: 4px; }
    .empty-state { border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 48px; color: rgba(255,255,255,0.45); text-align: center; }
    .pagination-wrap { margin-top: 36px; color: #fff; }
    @media (max-width: 960px) { .blog-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 600px) { .blog-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<section class="page-hero">
    <div class="section-wrap">
        <span class="section-label">Latest Updates</span>
        <h1 class="section-title">Visa News &<br>Insights</h1>
        <p class="section-sub" style="max-width:560px">Read practical guidance, embassy updates, and travel documentation insights from our team.</p>
    </div>
</section>

<section class="blog-page">
    <div class="section-wrap">
        @if($posts->count())
            <div class="blog-grid">
                @foreach($posts as $post)
                    <article class="blog-card">
                        <div class="blog-thumb" @if($post->feature_image) style="background-image: linear-gradient(to top, rgba(6,12,26,0.7), rgba(6,12,26,0.05)), url('{{ asset('storage/'.$post->feature_image) }}')" @endif>
                            <span class="blog-tag">Visa News</span>
                        </div>
                        <div class="blog-body">
                            <div class="blog-meta">{{ ($post->published_at ?? $post->created_at)->format('M d, Y') }} &nbsp;·&nbsp; {{ max(1, ceil(str_word_count(strip_tags($post->description)) / 200)) }} min read</div>
                            <h2 class="blog-title">{{ $post->title }}</h2>
                            <p class="blog-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 130) }}</p>
                            <a href="{{ route('blog.show', $post) }}" class="blog-read">Read Article <span>→</span></a>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($posts->hasPages())
                <div class="pagination-wrap">{{ $posts->links() }}</div>
            @endif
        @else
            <div class="empty-state">No published blog posts yet.</div>
        @endif
    </div>
</section>
@endsection
