@extends('layouts.admin_layout', ['title' => 'Services'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Services</h1>
            <p class="text-sm text-slate-500 mt-1">Manage services shown on the frontend.</p>
        </div>
        <a href="{{ route('dashboard.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">Add Service</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-slate-900">{{ $totalServices }}</p><p class="text-xs text-slate-500 mt-0.5">Total Services</p></div>
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-emerald-700">{{ $publishedServices }}</p><p class="text-xs text-slate-500 mt-0.5">Published</p></div>
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-amber-600">{{ $draftServices }}</p><p class="text-xs text-slate-500 mt-0.5">Drafts</p></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5">
        <form method="GET" action="{{ route('dashboard.services.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..."
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
        @if($services->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Service</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Status</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Order</th>
                            <th class="text-right text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($services as $service)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <p class="text-sm font-medium text-slate-800">{{ $service->icon }} {{ $service->title }}</p>
                                    <p class="text-xs text-slate-400 line-clamp-1">{{ $service->description }}</p>
                                </td>
                                <td class="px-5 py-3.5"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $service->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/50' : 'bg-amber-50 text-amber-700 border border-amber-200/50' }}">{{ $service->is_published ? 'Published' : 'Draft' }}</span></td>
                                <td class="px-5 py-3.5 text-sm text-slate-500">{{ $service->sort_order }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('dashboard.services.show', $service) }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">View</a>
                                        <a href="{{ route('dashboard.services.edit', $service) }}" class="text-xs font-medium text-emerald-600 hover:text-emerald-700">Edit</a>
                                        <form method="POST" action="{{ route('dashboard.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
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
            @if($services->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $services->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center">
                <h3 class="text-base font-semibold text-slate-800 mb-1">No services found</h3>
                <p class="text-sm text-slate-500 mb-4">Create your first service.</p>
                <a href="{{ route('dashboard.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">Create Service</a>
            </div>
        @endif
    </div>
</div>
@endsection
