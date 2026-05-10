@extends('layouts.admin_layout', ['title' => 'Testimonials'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Testimonials</h1>
            <p class="text-sm text-slate-500 mt-1">Manage testimonials shown on the frontend.</p>
        </div>
        <a href="{{ route('dashboard.testimonials.create') }}" class="px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700">Add Testimonial</a>
    </div>
    @if(session('success'))<div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>@endif
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead><tr class="bg-slate-50 border-b border-slate-100">
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Client</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Message</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Status</th>
                <th class="text-right text-xs font-semibold text-slate-500 uppercase px-5 py-3">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-slate-50">
            @forelse($testimonials as $testimonial)
                <tr>
                    <td class="px-5 py-3.5 text-sm"><div class="font-medium text-slate-800">{{ $testimonial->name }}</div><div class="text-xs text-slate-400">{{ $testimonial->location }} {{ $testimonial->visa_type ? '- '.$testimonial->visa_type : '' }}</div></td>
                    <td class="px-5 py-3.5 text-sm text-slate-500">{{ \Illuminate\Support\Str::limit($testimonial->message, 90) }}</td>
                    <td class="px-5 py-3.5"><span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $testimonial->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $testimonial->is_published ? 'Published' : 'Draft' }}</span></td>
                    <td class="px-5 py-3.5"><div class="flex justify-end gap-2 text-xs font-medium"><a class="text-emerald-600" href="{{ route('dashboard.testimonials.edit', $testimonial) }}">Edit</a><form method="POST" action="{{ route('dashboard.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Delete this testimonial?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></div></td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-12 text-center text-sm text-slate-500">No testimonials found.</td></tr>
            @endforelse
            </tbody>
        </table>
        @if($testimonials->hasPages())<div class="px-5 py-4 border-t border-slate-100">{{ $testimonials->links() }}</div>@endif
    </div>
</div>
@endsection
