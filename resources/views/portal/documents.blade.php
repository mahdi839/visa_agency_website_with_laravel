@extends('layouts.customer_dashboard_layout', ['title' => 'My Documents'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">My Documents</h1>
        <p class="text-sm text-slate-500 mt-1">Uploaded application images are available from each application detail page.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-8 text-center">
        <h2 class="text-base font-semibold text-slate-800 mb-1">Document center</h2>
        <p class="text-sm text-slate-500 mb-4">Open an application to view the document image submitted with that request.</p>
        <a href="{{ route('portal.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700">View Applications</a>
    </div>
</div>
@endsection
