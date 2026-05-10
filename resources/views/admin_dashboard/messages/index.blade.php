@extends('layouts.admin_layout', ['title' => 'Messages'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Customer Messages</h1>
            <p class="text-sm text-slate-500 mt-1">Read customer portal messages and reply from the admin dashboard.</p>
        </div>
        <a href="{{ route('dashboard.messages.create') }}" class="px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700">Start Message</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4 sm:p-5">
        <form method="GET" action="{{ route('dashboard.messages.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <input name="search" value="{{ request('search') }}" placeholder="Search customer or subject..." class="md:col-span-2 px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
            <select name="status" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
                <option value="">All Status</option>
                @foreach(\App\Models\MessageThread::STATUSES as $value => $label)
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
        @if($threads->count())
            <div class="divide-y divide-slate-100">
                @foreach($threads as $thread)
                    <a href="{{ route('dashboard.messages.show', $thread) }}" class="block px-5 py-4 hover:bg-slate-50/70">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-sm font-semibold text-slate-900">{{ $thread->subject }}</p>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $thread->status === 'open' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ \App\Models\MessageThread::STATUSES[$thread->status] ?? $thread->status }}</span>
                                    @if($thread->customer_unread_count)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-600">{{ $thread->customer_unread_count }} unread</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mt-1">{{ $thread->customer?->name }} · {{ $thread->customer?->email }} · {{ ($thread->last_message_at ?? $thread->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($threads->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $threads->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center text-sm text-slate-500">No customer messages found.</div>
        @endif
    </div>
</div>
@endsection
