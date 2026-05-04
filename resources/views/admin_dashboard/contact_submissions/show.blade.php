@extends('layouts.admin_layout', ['title' => 'Contact Submission'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $contactSubmission->subject }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $contactSubmission->name }} submitted this on {{ $contactSubmission->created_at->format('M d, Y h:i A') }}.</p>
        </div>
        <a href="{{ route('dashboard.contact-submissions.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Back to list</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-6">
            <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">{{ $contactSubmission->message }}</p>
        </div>
        <aside class="bg-white rounded-xl border border-slate-200 p-5 space-y-4 h-fit">
            <div><p class="text-xs text-slate-500">Name</p><p class="text-sm font-medium text-slate-900">{{ $contactSubmission->name }}</p></div>
            <div><p class="text-xs text-slate-500">Email</p><p class="text-sm font-medium text-slate-900">{{ $contactSubmission->email }}</p></div>
            <div><p class="text-xs text-slate-500">Phone</p><p class="text-sm font-medium text-slate-900">{{ $contactSubmission->phone ?: 'Not provided' }}</p></div>
            <form method="POST" action="{{ route('dashboard.contact-submissions.update', $contactSubmission) }}" class="space-y-2">
                @csrf
                @method('PUT')
                <label class="block text-xs text-slate-500">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
                    @foreach(\App\Models\ContactSubmission::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected($contactSubmission->status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="w-full px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">Update Status</button>
            </form>
        </aside>
    </div>
</div>
@endsection
