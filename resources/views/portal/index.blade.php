@extends('layouts.customer_dashboard_layout', ['title' => 'My Applications'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">My Applications</h1>
        <p class="text-sm text-slate-500 mt-1">Track the requests you submitted from the website.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if($applications->count())
            <div class="divide-y divide-slate-100">
                @foreach($applications as $application)
                    <a href="{{ route('portal.application', $application) }}" class="block px-5 py-4 hover:bg-slate-50 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ \App\Models\VisaApplication::SUBJECTS[$application->subject] ?? $application->subject }} - {{ $application->country }}</p>
                                <p class="text-xs text-slate-500 mt-1">Submitted {{ $application->created_at->format('M d, Y') }}</p>
                                @if($application->update_message)
                                    <p class="text-xs text-emerald-700 mt-2 line-clamp-2">Update: {{ $application->update_message }}</p>
                                @endif
                            </div>
                            <span class="inline-flex w-fit items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                {{ \App\Models\VisaApplication::STATUSES[$application->status] ?? $application->status }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($applications->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $applications->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center">
                <h3 class="text-base font-semibold text-slate-800 mb-1">No applications yet</h3>
                <p class="text-sm text-slate-500">Use the Start Your Application button on the homepage to submit your first request.</p>
            </div>
        @endif
    </div>
</div>
@endsection
