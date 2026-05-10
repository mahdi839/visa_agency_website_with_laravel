@extends('layouts.admin_layout', ['title' => 'Start Message'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Start Message</h1>
        <p class="text-sm text-slate-500 mt-1">Send the first message to a customer.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 text-sm text-red-700">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('dashboard.messages.store') }}" class="bg-white rounded-xl border border-slate-200 p-5 space-y-4 max-w-3xl">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Customer</label>
            <select name="user_id" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">
                <option value="">Select customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(old('user_id') == $customer->id)>{{ $customer->name }} - {{ $customer->email }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Subject</label>
            <input name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Message</label>
            <textarea name="body" rows="7" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">{{ old('body') }}</textarea>
        </div>
        <div class="flex gap-3">
            <button class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Send Message</button>
            <a href="{{ route('dashboard.messages.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200">Cancel</a>
        </div>
    </form>
</div>
@endsection
