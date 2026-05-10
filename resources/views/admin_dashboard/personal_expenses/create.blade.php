@extends('layouts.admin_layout', ['title' => 'Create Expense'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Create Personal Expense</h1>
    <form method="POST" action="{{ route('dashboard.personal-expenses.store') }}" enctype="multipart/form-data" class="space-y-6">@csrf @include('admin_dashboard.personal_expenses._form', ['personalExpense' => null, 'submitLabel' => 'Create Expense'])</form>
</div>
@endsection
