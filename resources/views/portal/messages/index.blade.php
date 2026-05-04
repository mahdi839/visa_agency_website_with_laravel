@extends('layouts.customer_dashboard_layout', ['title' => 'Messages'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Messages</h1>
            <p class="text-sm text-slate-500 mt-1">Send non-realtime messages to the admin team and read their replies.</p>
        </div>
        <a href="{{ route('portal.messages.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700">New Message</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if($threads->count())
            <div class="divide-y divide-slate-100">
                @foreach($threads as $thread)
                    <a href="{{ route('portal.messages.show', $thread) }}" class="block px-5 py-4 hover:bg-slate-50">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-sm font-semibold text-slate-900">{{ $thread->subject }}</p>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $thread->status === 'open' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ \App\Models\MessageThread::STATUSES[$thread->status] ?? $thread->status }}</span>
                                    @if($thread->admin_unread_count)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-600">{{ $thread->admin_unread_count }} new</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mt-1">Last message {{ ($thread->last_message_at ?? $thread->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($threads->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $threads->links() }}</div>
            @endif
        @else
            <div class="px-5 py-16 text-center">
                <h3 class="text-base font-semibold text-slate-800 mb-1">No messages yet</h3>
                <p class="text-sm text-slate-500 mb-4">Start a new conversation with the admin team.</p>
                <a href="{{ route('portal.messages.create') }}" class="inline-flex px-4 py-2 text-sm font-medium text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100">Send Message</a>
            </div>
        @endif
    </div>
</div>
@endsection
