@extends('layouts.admin_layout', ['title' => 'Edit User'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.users.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">Users</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <a href="{{ route('dashboard.users.show', $user) }}" class="text-slate-400 hover:text-slate-600 transition-colors">{{ $user->name }}</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">Edit</span>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Edit User</h1>
            <p class="text-sm text-slate-500 mt-1">Update details for {{ $user->name }}.</p>
        </div>
        <a href="{{ route('dashboard.users.show', $user) }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            View Profile
        </a>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('dashboard.users.update', $user) }}" class="space-y-6">
        @csrf
        @method('PUT')

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
                                   value="{{ old('name', $user->name) }}"
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
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="Enter email address"
                                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500/20 focus:border-red-400' : '' }}">
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password (Optional on Edit) -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-base font-semibold text-slate-800">Change Password</h2>
                        <span class="text-xs text-slate-400">Leave blank to keep current</span>
                    </div>
                    <div class="p-5 space-y-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">New Password</label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   placeholder="Enter new password (min. 8 characters)"
                                   class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('password') ? 'border-red-300 focus:ring-red-500/20 focus:border-red-400' : '' }}">
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirm New Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   placeholder="Re-enter new password"
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
                                <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                                       class="sr-only peer"
                                       id="is_admin"
                                       @if($user->id === auth()->id()) disabled @endif>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600 {{ $user->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : '' }}"></div>
                            </div>
                        </label>

                        @if($user->id === auth()->id())
                            <p class="text-xs text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg">You cannot change your own admin role.</p>
                        @endif

                        <!-- Divider -->
                        <hr class="border-slate-100">

                        <!-- Customer Toggle -->
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div>
                                <p class="text-sm font-medium text-slate-700">Customer</p>
                                <p class="text-xs text-slate-400 mt-0.5">Access to customer portal</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="is_customer" value="1" {{ old('is_customer', $user->is_customer) ? 'checked' : '' }}
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
                                <p class="text-sm font-medium text-slate-700">Email Verified</p>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    @if($user->hasVerifiedEmail())
                                        Verified on {{ $user->email_verified_at->format('M d, Y') }}
                                    @else
                                        Not yet verified
                                    @endif
                                </p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="email_verified" value="1" {{ old('email_verified', $user->hasVerifiedEmail()) ? 'checked' : '' }}
                                       class="sr-only peer"
                                       id="email_verified">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Danger Zone -->
                @if($user->id !== auth()->id())
                <div class="bg-white rounded-xl border border-red-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-red-100 bg-red-50/50">
                        <h2 class="text-base font-semibold text-red-800">Danger Zone</h2>
                    </div>
                    <div class="p-5">
                        <p class="text-sm text-slate-600 mb-3">Permanently delete this user and all associated data. This action cannot be undone.</p>
                        <form method="POST" action="{{ route('dashboard.users.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors shadow-sm"
                                    onclick="return confirm('Are you sure you want to delete {{ $user->name }}? This cannot be undone.')">
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
                    <button type="submit"
                            class="w-full px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors shadow-sm">
                        Save Changes
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
