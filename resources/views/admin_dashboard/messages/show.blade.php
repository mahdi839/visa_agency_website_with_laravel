@extends('layouts.admin_layout', ['title' => 'Message Thread'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $messageThread->subject }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $messageThread->customer?->name }} · {{ $messageThread->customer?->email }}</p>
        </div>
        <a href="{{ route('dashboard.messages.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Back to messages</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-4">
                @foreach($messageThread->messages as $message)
                    <div class="flex {{ $message->is_admin ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[82%] rounded-2xl px-4 py-3 {{ $message->is_admin ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                            <p class="text-sm whitespace-pre-line leading-6">{{ $message->body }}</p>
                            <p class="text-[11px] mt-2 {{ $message->is_admin ? 'text-emerald-100' : 'text-slate-400' }}">{{ $message->sender?->name }} · {{ $message->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('dashboard.messages.reply', $messageThread) }}" class="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
                @csrf
                <label for="body" class="block text-sm font-medium text-slate-700">Reply to customer</label>
                <textarea id="body" name="body" rows="5" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">{{ old('body') }}</textarea>
                @error('body')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                <button class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Send Reply</button>
            </form>
        </div>

        <aside class="bg-white rounded-xl border border-slate-200 p-5 h-fit space-y-4">
            <form method="POST" action="{{ route('dashboard.messages.update', $messageThread) }}" class="space-y-2">
                @csrf
                @method('PUT')
                <label class="block text-xs text-slate-500">Thread Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
                    @foreach(\App\Models\MessageThread::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected($messageThread->status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="w-full px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Update</button>
            </form>
            <form method="POST" action="{{ route('dashboard.messages.destroy', $messageThread) }}" onsubmit="return confirm('Delete this message thread?')">
                @csrf
                @method('DELETE')
                <button class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Delete Thread</button>
            </form>
        </aside>
    </div>
</div>
@endsection
