@extends('layouts.admin_layout', ['title' => 'Service Details'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $service->icon }} {{ $service->title }}</h1>
            <p class="text-sm text-slate-500 mt-1">Last updated {{ $service->updated_at->format('M d, Y') }}.</p>
        </div>
        <a href="{{ route('dashboard.services.edit', $service) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">Edit</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="p-6">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $service->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-amber-50 text-amber-700 border border-amber-200/50' }}">{{ $service->is_published ? 'Published' : 'Draft' }}</span>
                <p class="mt-5 text-sm leading-7 text-slate-600 whitespace-pre-line">{{ $service->description }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden h-fit">
            <div class="px-5 py-4 border-b border-slate-100"><h2 class="text-base font-semibold text-slate-800">Details</h2></div>
            <div class="p-5 space-y-4 text-sm">
                <div class="flex items-center justify-between gap-4"><span class="text-slate-500">Order</span><span class="font-medium text-slate-800">{{ $service->sort_order }}</span></div>
                <div class="flex items-center justify-between gap-4"><span class="text-slate-500">Slug</span><span class="font-medium text-slate-800">{{ $service->slug }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
