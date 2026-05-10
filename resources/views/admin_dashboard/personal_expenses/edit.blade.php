@extends('layouts.admin_layout', ['title' => 'Edit Expense'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Edit Personal Expense</h1>
    <form method="POST" action="{{ route('dashboard.personal-expenses.update', $personalExpense) }}" enctype="multipart/form-data" class="space-y-6">@csrf @method('PUT') @include('admin_dashboard.personal_expenses._form', ['submitLabel' => 'Save Changes'])</form>
</div>
@endsection
