@extends('layouts.admin_layout', ['title' => 'Visa Applications'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Visa Applications</h1>
            <p class="text-sm text-slate-500 mt-1">Review customer requests and update application status.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-slate-900">{{ $totalApplications }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Total</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-amber-600">{{ $pendingApplications }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Pending</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-blue-600">{{ $progressApplications }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Progress</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-xl font-bold text-emerald-700">{{ $completedApplications }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Completed</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5">
        <form method="GET" action="{{ route('dashboard.visa-applications.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer, email, note, update..."
                   class="md:col-span-2 px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400">
            <select name="status" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400">
                <option value="">All Status</option>
                @foreach(\App\Models\VisaApplication::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <select name="subject" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400">
                <option value="">All Subjects</option>
                @foreach(\App\Models\VisaApplication::SUBJECTS as $value => $label)
                    <option value="{{ $value }}" @selected(request('subject') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <select name="country" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400">
                <option value="">All Countries</option>
                @foreach($countries as $country)
                    <option value="{{ $country }}" @selected(request('country') === $country)>{{ $country }}</option>
                @endforeach
            </select>
            <div class="md:col-span-5 flex gap-3">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Filter</button>
                @if(request()->hasAny(['search', 'status', 'subject', 'country']))
                    <a href="{{ route('dashboard.visa-applications.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200">Clear</a>
                @endif
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-800">All Applications</h2>
            <span class="text-xs text-slate-400">{{ $applications->total() }} result{{ $applications->total() !== 1 ? 's' : '' }}</span>
        </div>

        @if($applications->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Customer</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Request</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Document</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Admin Update</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($applications as $application)
                            <tr class="hover:bg-slate-50/50 transition-colors align-top">
                                <td class="px-5 py-4">
                                    <p class="text-sm font-medium text-slate-800">{{ $application->user?->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $application->user?->email }}</p>
                                </td>
                                <td class="px-5 py-4 max-w-md">
                                    <p class="text-sm font-semibold text-slate-800">{{ \App\Models\VisaApplication::SUBJECTS[$application->subject] ?? $application->subject }} - {{ $application->country }}</p>
                                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $application->description ?: 'No description given.' }}</p>
                                    @if($application->note)
                                        <p class="text-xs text-slate-400 mt-1">Note: {{ $application->note }}</p>
                                    @endif
                                    <p class="text-xs text-amber-600 mt-1">{{ \App\Models\VisaApplication::URGENCIES[$application->urgency] ?? $application->urgency }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    @if($application->document_path)
                                        <a href="{{ asset('storage/'.$application->document_path) }}" target="_blank" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">View Image</a>
                                    @else
                                        <span class="text-sm text-slate-400">None</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 min-w-72">
                                    <form method="POST" action="{{ route('dashboard.visa-applications.update-status', $application) }}">
                                        @csrf
                                        @method('PATCH')
                                        <label for="status-{{ $application->id }}" class="block text-xs font-semibold text-slate-500 mb-1">Status</label>
                                        <select id="status-{{ $application->id }}" name="status" class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400">
                                            @foreach(\App\Models\VisaApplication::STATUSES as $value => $label)
                                                <option value="{{ $value }}" @selected($application->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <label for="update-message-{{ $application->id }}" class="block text-xs font-semibold text-slate-500 mt-3 mb-1">Application Update Message</label>
                                        <textarea id="update-message-{{ $application->id }}" name="update_message" rows="3" placeholder="Write an update for the customer..."
                                                  class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400">{{ old('update_message', $application->update_message) }}</textarea>
                                        @if($application->update_message_at)
                                            <p class="text-[11px] text-slate-400 mt-1">Last updated {{ $application->update_message_at->format('M d, Y h:i A') }}</p>
                                        @endif
                                        <button type="submit" class="mt-2 px-3 py-2 text-xs font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Save Update</button>
                                    </form>
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-500">{{ $application->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($applications->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $applications->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center">
                <h3 class="text-base font-semibold text-slate-800 mb-1">No applications found</h3>
                <p class="text-sm text-slate-500">New customer requests will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection
