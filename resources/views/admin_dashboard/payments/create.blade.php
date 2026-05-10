@extends('layouts.admin_layout', ['title' => 'Create Payment'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Create Payment</h1>
    <form method="POST" action="{{ route('dashboard.payments.store') }}" enctype="multipart/form-data" class="space-y-6">@csrf @include('admin_dashboard.payments._form', ['payment' => null, 'submitLabel' => 'Create Payment'])</form>
</div>
@endsection
