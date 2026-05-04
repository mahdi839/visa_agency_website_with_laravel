@extends('layouts.admin_layout', ['title' => 'Contact Submissions'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Contact Submissions</h1>
        <p class="text-sm text-slate-500 mt-1">Review messages submitted from the public Contact page.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5">
        <form method="GET" action="{{ route('dashboard.contact-submissions.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <input name="search" value="{{ request('search') }}" placeholder="Search name, email, subject..." class="md:col-span-2 px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
            <select name="status" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
                <option value="">All Status</option>
                @foreach(\App\Models\ContactSubmission::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
            <button class="md:col-start-5 px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Filter</button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if($submissions->count())
            <div class="divide-y divide-slate-100">
                @foreach($submissions as $submission)
                    <div class="px-5 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 hover:bg-slate-50/60">
                        <a href="{{ route('dashboard.contact-submissions.show', $submission) }}" class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-semibold text-slate-900">{{ $submission->subject }}</p>
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $submission->status === 'new' ? 'bg-blue-50 text-blue-700' : ($submission->status === 'archived' ? 'bg-slate-100 text-slate-600' : 'bg-emerald-50 text-emerald-700') }}">{{ \App\Models\ContactSubmission::STATUSES[$submission->status] ?? $submission->status }}</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">{{ $submission->name }} · {{ $submission->email }} · {{ $submission->created_at->format('M d, Y h:i A') }}</p>
                            <p class="text-sm text-slate-500 mt-2 line-clamp-1">{{ $submission->message }}</p>
                        </a>
                        <form method="POST" action="{{ route('dashboard.contact-submissions.destroy', $submission) }}" onsubmit="return confirm('Delete this contact submission?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm font-medium text-red-600 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
            @if($submissions->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $submissions->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center text-sm text-slate-500">No contact submissions found.</div>
        @endif
    </div>
</div>
@endsection
