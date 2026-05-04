@extends('layouts.admin_layout', ['title' => 'Blog Posts'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Blog Posts</h1>
            <p class="text-sm text-slate-500 mt-1">Manage posts shown in Blog and Latest Updates.</p>
        </div>
        <a href="{{ route('dashboard.blog-posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Add Blog Post
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-slate-900">{{ $totalPosts }}</p><p class="text-xs text-slate-500 mt-0.5">Total Posts</p></div>
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-emerald-700">{{ $publishedPosts }}</p><p class="text-xs text-slate-500 mt-0.5">Published</p></div>
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-amber-600">{{ $draftPosts }}</p><p class="text-xs text-slate-500 mt-0.5">Drafts</p></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5">
        <form method="GET" action="{{ route('dashboard.blog-posts.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blog posts..."
                   class="flex-1 px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
            <select name="status" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                <option value="">All Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">Filter</button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-800">All Blog Posts</h2>
            <span class="text-xs text-slate-400">{{ $posts->total() }} result{{ $posts->total() !== 1 ? 's' : '' }}</span>
        </div>

        @if($posts->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Post</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Status</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Updated</th>
                            <th class="text-right text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($posts as $post)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                                            @if($post->feature_image)
                                                <img src="{{ asset('storage/'.$post->feature_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-slate-800">{{ $post->title }}</p>
                                            <p class="text-xs text-slate-400">{{ $post->published_at?->format('M d, Y') ?? 'Not published' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $post->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-amber-50 text-amber-700 border border-amber-200/50' }}">{{ $post->is_published ? 'Published' : 'Draft' }}</span>
                                </td>
                                <td class="px-5 py-3.5 text-sm text-slate-500">{{ $post->updated_at->format('M d, Y') }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($post->is_published)
                                            <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-xs font-medium text-blue-600 hover:text-blue-700">Public</a>
                                        @endif
                                        <a href="{{ route('dashboard.blog-posts.show', $post) }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">View</a>
                                        <a href="{{ route('dashboard.blog-posts.edit', $post) }}" class="text-xs font-medium text-emerald-600 hover:text-emerald-700">Edit</a>
                                        <form method="POST" action="{{ route('dashboard.blog-posts.destroy', $post) }}" onsubmit="return confirm('Delete this blog post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-700">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($posts->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $posts->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center">
                <h3 class="text-base font-semibold text-slate-800 mb-1">No blog posts found</h3>
                <p class="text-sm text-slate-500 mb-4">Create your first blog post.</p>
                <a href="{{ route('dashboard.blog-posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">Create Blog Post</a>
            </div>
        @endif
    </div>
</div>
@endsection
