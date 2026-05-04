@extends('layouts.admin_layout', ['title' => 'Create Blog Post'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.blog-posts.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">Blog Posts</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">Create</span>
    </nav>

    <div>
        <h1 class="text-2xl font-bold text-slate-900">Create Blog Post</h1>
        <p class="text-sm text-slate-500 mt-1">Publish visa news and insights for the frontend blog.</p>
    </div>

    <form method="POST" action="{{ route('dashboard.blog-posts.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @include('admin_dashboard.blog_posts._form', ['blogPost' => null, 'submitLabel' => 'Create Blog Post'])
    </form>
</div>
@endsection
