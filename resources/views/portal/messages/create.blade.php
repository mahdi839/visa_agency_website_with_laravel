@extends('layouts.customer_dashboard_layout', ['title' => 'New Message'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">New Message</h1>
        <p class="text-sm text-slate-500 mt-1">Ask the admin team about your application, documents, or next steps.</p>
    </div>

    <form method="POST" action="{{ route('portal.messages.store') }}" class="bg-white rounded-xl border border-slate-200 p-5 space-y-4 max-w-3xl">
        @csrf
        <div>
            <label for="subject" class="block text-sm font-medium text-slate-700 mb-1.5">Subject</label>
            <input id="subject" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">
            @error('subject')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="body" class="block text-sm font-medium text-slate-700 mb-1.5">Message</label>
            <textarea id="body" name="body" rows="7" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">{{ old('body') }}</textarea>
            @error('body')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-3">
            <button class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Send Message</button>
            <a href="{{ route('portal.messages.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200">Cancel</a>
        </div>
    </form>
</div>
@endsection
