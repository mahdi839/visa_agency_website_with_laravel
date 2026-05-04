@extends('layouts.admin_layout', ['title' => 'Blog Post Details'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $blogPost->title }}</h1>
            <p class="text-sm text-slate-500 mt-1">Last updated {{ $blogPost->updated_at->format('M d, Y') }}.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.blog-posts.edit', $blogPost) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">Edit</a>
            @if($blogPost->is_published)
                <a href="{{ route('blog.show', $blogPost) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">Public Page</a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 overflow-hidden">
            @if($blogPost->feature_image)
                <img src="{{ asset('storage/'.$blogPost->feature_image) }}" alt="{{ $blogPost->title }}" class="w-full h-72 object-cover">
            @endif
            <div class="p-6">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $blogPost->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-amber-50 text-amber-700 border border-amber-200/50' }}">{{ $blogPost->is_published ? 'Published' : 'Draft' }}</span>
                <div class="prose max-w-none mt-5">{!! $blogPost->description !!}</div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100"><h2 class="text-base font-semibold text-slate-800">Details</h2></div>
                <div class="p-5 space-y-4 text-sm">
                    <div class="flex items-center justify-between gap-4"><span class="text-slate-500">Created</span><span class="font-medium text-slate-800">{{ $blogPost->created_at->format('M d, Y') }}</span></div>
                    <div class="flex items-center justify-between gap-4"><span class="text-slate-500">Published</span><span class="font-medium text-slate-800">{{ $blogPost->published_at?->format('M d, Y') ?? 'Draft' }}</span></div>
                    <div class="flex items-center justify-between gap-4"><span class="text-slate-500">Slug</span><span class="font-medium text-slate-800">{{ $blogPost->slug }}</span></div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-red-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-red-100 bg-red-50/50"><h2 class="text-base font-semibold text-red-800">Danger Zone</h2></div>
                <div class="p-5">
                    <form method="POST" action="{{ route('dashboard.blog-posts.destroy', $blogPost) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors shadow-sm" onclick="return confirm('Delete this blog post?')">Delete Blog Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
