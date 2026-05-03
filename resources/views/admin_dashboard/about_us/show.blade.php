@extends('layouts.admin_layout', ['title' => 'About Us Details'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.about-us.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">About Us</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">{{ $aboutUs->title }}</span>
    </nav>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $aboutUs->title }}</h1>
            <p class="text-sm text-slate-500 mt-1">Last updated {{ $aboutUs->updated_at->format('M d, Y') }}.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard.about-us.edit', $aboutUs) }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /></svg>
                Edit
            </a>
            <a href="{{ route('about') }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                Public Page
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-800">Content Preview</h2>
                @if($aboutUs->is_published)
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">Published</span>
                @else
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/50">Draft</span>
                @endif
            </div>
            <div class="p-6 space-y-8">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">{{ $aboutUs->hero_label }}</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-900">{{ $aboutUs->title }}</h3>
                    @if($aboutUs->subtitle)
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $aboutUs->subtitle }}</p>
                    @endif
                </div>

                <div>
                    <h4 class="text-xl font-semibold text-slate-900">{{ $aboutUs->story_title }}</h4>
                    <p class="mt-3 text-sm leading-7 text-slate-600 whitespace-pre-line">{{ $aboutUs->story_body }}</p>
                </div>

                <div>
                    <h4 class="text-xl font-semibold text-slate-900">{{ $aboutUs->mission_title }}</h4>
                    <p class="mt-3 text-sm leading-7 text-slate-600 whitespace-pre-line">{{ $aboutUs->mission_body }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h2 class="text-base font-semibold text-slate-800">Details</h2>
                </div>
                <div class="p-5 space-y-4 text-sm">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-slate-500">Created</span>
                        <span class="font-medium text-slate-800">{{ $aboutUs->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-slate-500">Updated</span>
                        <span class="font-medium text-slate-800">{{ $aboutUs->updated_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-slate-500">Status</span>
                        <span class="font-medium text-slate-800">{{ $aboutUs->is_published ? 'Published' : 'Draft' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-red-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-red-100 bg-red-50/50">
                    <h2 class="text-base font-semibold text-red-800">Danger Zone</h2>
                </div>
                <div class="p-5">
                    <form method="POST" action="{{ route('dashboard.about-us.destroy', $aboutUs) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors shadow-sm"
                                onclick="return confirm('Delete this About page?')">
                            Delete About Page
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
