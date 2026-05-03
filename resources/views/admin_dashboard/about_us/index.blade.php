@extends('layouts.admin_layout', ['title' => 'About Us'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6" x-data="{ showDeleteModal: false, aboutToDelete: null }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">About Us</h1>
            <p class="text-sm text-slate-500 mt-1">Manage the content shown on the public About page.</p>
        </div>
        <a href="{{ route('dashboard.about-us.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Add About Page
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-slate-900">{{ $totalPages }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Total Pages</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-emerald-700">{{ $publishedPages }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Published</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-amber-600">{{ $draftPages }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Drafts</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5">
        <form method="GET" action="{{ route('dashboard.about-us.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search about content..."
                       class="w-full pl-10 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
            </div>
            <select name="status"
                    class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                <option value="">All Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">Filter</button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('dashboard.about-us.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors text-center">Clear</a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-800">All About Pages</h2>
            <span class="text-xs text-slate-400">{{ $aboutPages->total() }} result{{ $aboutPages->total() !== 1 ? 's' : '' }}</span>
        </div>

        @if($aboutPages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Title</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Status</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Updated</th>
                            <th class="text-right text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($aboutPages as $about)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <p class="text-sm font-medium text-slate-800">{{ $about->title }}</p>
                                    <p class="text-xs text-slate-400 line-clamp-1">{{ $about->subtitle }}</p>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($about->is_published)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">Published</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/50">Draft</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-sm text-slate-500">{{ $about->updated_at->format('M d, Y') }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('dashboard.about-us.show', $about) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        </a>
                                        <a href="{{ route('dashboard.about-us.edit', $about) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                        </a>
                                        <button type="button" @click="showDeleteModal = true; aboutToDelete = { title: @js($about->title), url: '{{ route('dashboard.about-us.destroy', $about) }}' }" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($aboutPages->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $aboutPages->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="px-5 py-16 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800 mb-1">No about pages found</h3>
                <p class="text-sm text-slate-500 mb-4">Create your first About Us content page.</p>
                <a href="{{ route('dashboard.about-us.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">Create About Page</a>
            </div>
        @endif
    </div>

    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" @click.self="showDeleteModal = false">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete About Page</h3>
            <p class="text-sm text-slate-500 text-center mb-6">Are you sure you want to delete <span class="font-semibold text-slate-700" x-text="aboutToDelete?.title"></span>?</p>
            <div class="flex items-center gap-3">
                <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Cancel</button>
                <form :action="aboutToDelete?.url" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
