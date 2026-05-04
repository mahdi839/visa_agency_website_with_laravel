@extends('layouts.admin_layout', ['title' => 'Edit Service'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Service</h1>
        <p class="text-sm text-slate-500 mt-1">Update {{ $service->title }}.</p>
    </div>

    <form method="POST" action="{{ route('dashboard.services.update', $service) }}" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin_dashboard.services._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
