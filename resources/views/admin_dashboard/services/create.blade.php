@extends('layouts.admin_layout', ['title' => 'Create Service'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Create Service</h1>
        <p class="text-sm text-slate-500 mt-1">Add a visa service for the frontend Services page and home section.</p>
    </div>

    <form method="POST" action="{{ route('dashboard.services.store') }}" class="space-y-6">
        @csrf
        @include('admin_dashboard.services._form', ['service' => null, 'submitLabel' => 'Create Service'])
    </form>
</div>
@endsection
