@extends('layouts.admin_layout', ['title' => 'Edit Payment'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Edit Payment</h1>
    <form method="POST" action="{{ route('dashboard.payments.update', $payment) }}" enctype="multipart/form-data" class="space-y-6">@csrf @method('PUT') @include('admin_dashboard.payments._form', ['submitLabel' => 'Save Changes'])</form>
</div>
@endsection
