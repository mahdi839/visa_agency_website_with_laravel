@extends('layouts.customer_dashboard_layout', ['title' => 'Application Details'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Application Details</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $visaApplication->created_at->format('M d, Y') }}</p>
        </div>
        <a href="{{ route('portal.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">Back</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Request</p>
                <h2 class="text-lg font-semibold text-slate-900 mt-1">{{ \App\Models\VisaApplication::SUBJECTS[$visaApplication->subject] ?? $visaApplication->subject }} - {{ $visaApplication->country }}</h2>
            </div>
            <span class="inline-flex w-fit items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                {{ \App\Models\VisaApplication::STATUSES[$visaApplication->status] ?? $visaApplication->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-slate-50 rounded-lg p-4">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Urgency</p>
                <p class="text-sm font-medium text-slate-800 mt-1">{{ \App\Models\VisaApplication::URGENCIES[$visaApplication->urgency] ?? $visaApplication->urgency }}</p>
            </div>
            <div class="bg-slate-50 rounded-lg p-4">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Document</p>
                @if($visaApplication->document_path)
                    <a href="{{ asset('storage/'.$visaApplication->document_path) }}" target="_blank" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 mt-1 inline-block">View uploaded image</a>
                @else
                    <p class="text-sm text-slate-500 mt-1">No document uploaded</p>
                @endif
            </div>
        </div>

        <div class="bg-emerald-50 border border-emerald-200/70 rounded-lg p-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                <p class="text-xs font-semibold text-emerald-700 uppercase tracking-wider">Application Update Message</p>
                @if($visaApplication->update_message_at)
                    <p class="text-xs text-emerald-600">{{ $visaApplication->update_message_at->format('M d, Y h:i A') }}</p>
                @endif
            </div>
            <p class="text-sm text-emerald-900 mt-2 leading-relaxed">{{ $visaApplication->update_message ?: 'No update message has been sent yet.' }}</p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Application Details</p>
            <p class="text-sm text-slate-700 mt-2 leading-relaxed">{{ $visaApplication->description ?: 'No details provided.' }}</p>
        </div>

        @if($visaApplication->note)
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Note</p>
                <p class="text-sm text-slate-700 mt-2 leading-relaxed">{{ $visaApplication->note }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
