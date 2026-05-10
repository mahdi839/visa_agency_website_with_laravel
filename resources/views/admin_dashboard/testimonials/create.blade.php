@extends('layouts.admin_layout', ['title' => 'Create Testimonial'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <h1 class="text-2xl font-bold text-slate-900">Create Testimonial</h1>
    <form method="POST" action="{{ route('dashboard.testimonials.store') }}" class="space-y-6">@csrf @include('admin_dashboard.testimonials._form', ['testimonial' => null, 'submitLabel' => 'Create Testimonial'])</form>
</div>
@endsection
