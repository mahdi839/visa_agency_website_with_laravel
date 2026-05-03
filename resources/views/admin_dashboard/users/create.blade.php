@extends('layouts.admin_layout', ['title' => 'Create User'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.users.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">Users</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">Create User</span>
    </nav>

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Create New User</h1>
        <p class="text-sm text-slate-500 mt-1">Add a new user to the system and assign their role.</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('dashboard.users.store') }}" class="space-y-6">
        @csrf

        <!-- Error Messages -->
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-red-800">Please fix the following errors:</h4>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Personal Information -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="text-base font-semibold text-slate-800">Personal Information</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name') }}"
                                   placeholder="Enter full name"
                                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500/20 focus:border-red-400' : '' }}">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter email address"
                                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500/20 focus:border-red-400' : '' }}">
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="text-base font-semibold text-slate-800">Password</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   placeholder="Enter password (min. 8 characters)"
                                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('password') ? 'border-red-300 focus:ring-red-500/20 focus:border-red-400' : '' }}">
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirm Password <span class="text-red-500">*</span></label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   placeholder="Re-enter password"
                                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Role & Settings -->
            <div class="space-y-6">

                <!-- Role Assignment -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="text-base font-semibold text-slate-800">Role Assignment</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <!-- Admin Toggle -->
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div>
                                <p class="text-sm font-medium text-slate-700">Administrator</p>
                                <p class="text-xs text-slate-400 mt-0.5">Full access to admin dashboard</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}
                                       class="sr-only peer"
                                       id="is_admin">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </div>
                        </label>

                        <!-- Divider -->
                        <hr class="border-slate-100">

                        <!-- Customer Toggle -->
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div>
                                <p class="text-sm font-medium text-slate-700">Customer</p>
                                <p class="text-xs text-slate-400 mt-0.5">Access to customer portal</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="is_customer" value="1" {{ old('is_customer', true) ? 'checked' : '' }}
                                       class="sr-only peer"
                                       id="is_customer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Email Verification -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="text-base font-semibold text-slate-800">Email Verification</h2>
                    </div>
                    <div class="p-5">
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div>
                                <p class="text-sm font-medium text-slate-700">Mark as Verified</p>
                                <p class="text-xs text-slate-400 mt-0.5">Skip email verification process</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="email_verified" value="1" {{ old('email_verified') ? 'checked' : '' }}
                                       class="sr-only peer"
                                       id="email_verified">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
                    <button type="submit"
                            class="w-full px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors shadow-sm">
                        Create User
                    </button>
                    <a href="{{ route('dashboard.users.index') }}"
                       class="block w-full text-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
