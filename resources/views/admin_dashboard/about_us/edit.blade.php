@extends('layouts.admin_layout', ['title' => 'Edit About Us'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.about-us.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">About Us</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <a href="{{ route('dashboard.about-us.show', $aboutUs) }}" class="text-slate-400 hover:text-slate-600 transition-colors">{{ $aboutUs->title }}</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">Edit</span>
    </nav>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Edit About Us Page</h1>
            <p class="text-sm text-slate-500 mt-1">Update content for {{ $aboutUs->title }}.</p>
        </div>
        <a href="{{ route('dashboard.about-us.show', $aboutUs) }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            View
        </a>
    </div>

    <form method="POST" action="{{ route('dashboard.about-us.update', $aboutUs) }}" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin_dashboard.about_us._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
