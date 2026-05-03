@extends('layouts.admin_layout', ['title' => 'Create About Us'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.about-us.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">About Us</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">Create</span>
    </nav>

    <div>
        <h1 class="text-2xl font-bold text-slate-900">Create About Us Page</h1>
        <p class="text-sm text-slate-500 mt-1">Add content for the public About page.</p>
    </div>

    <form method="POST" action="{{ route('dashboard.about-us.store') }}" class="space-y-6">
        @csrf
        @include('admin_dashboard.about_us._form', ['aboutUs' => null, 'submitLabel' => 'Create About Page'])
    </form>
</div>
@endsection
