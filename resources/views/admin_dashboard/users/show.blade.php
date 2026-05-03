@extends('layouts.admin_layout', ['title' => $user->name])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6" x-data="{ showDeleteModal: false }">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard.users.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">Users</a>
        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        <span class="text-slate-700 font-medium">{{ $user->name }}</span>
    </nav>

    <!-- Success / Error Messages -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
            </div>
            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- User Profile Header -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="h-28 bg-gradient-to-r from-emerald-600 to-emerald-500 relative">
            <!-- Decorative pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 400 120" preserveAspectRatio="none">
                    <circle cx="50" cy="60" r="40" fill="white"/>
                    <circle cx="200" cy="20" r="30" fill="white"/>
                    <circle cx="350" cy="80" r="35" fill="white"/>
                </svg>
            </div>
        </div>
        <div class="px-5 sm:px-8 pb-6 -mt-12 relative">
            <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                <!-- Avatar -->
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=059669&color=fff&size=160&bold=true&font-size=0.35"
                     class="w-24 h-24 rounded-2xl border-4 border-white shadow-lg" alt="{{ $user->name }}">

                <!-- Name & Info -->
                <div class="flex-1 sm:pb-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="text-xl font-bold text-slate-900">{{ $user->name }}</h1>
                        @if($user->is_admin)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">Admin</span>
                        @endif
                        @if($user->is_customer)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200/50">Customer</span>
                        @endif
                        @if($user->hasVerifiedEmail())
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Verified
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/50">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Unverified
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-500 mt-1">{{ $user->email }}</p>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-2 sm:pb-1">
                    <a href="{{ route('dashboard.users.edit', $user) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                        Edit
                    </a>
                    @if($user->id !== auth()->id())
                    <button type="button" @click="showDeleteModal = true"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        Delete
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left Column - Details -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Account Details -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h2 class="text-base font-semibold text-slate-800">Account Details</h2>
                </div>
                <div class="divide-y divide-slate-50">
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">User ID</p>
                            <p class="text-sm text-slate-800 mt-0.5">#{{ $user->id }}</p>
                        </div>
                    </div>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">Full Name</p>
                            <p class="text-sm text-slate-800 mt-0.5">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">Email Address</p>
                            <p class="text-sm text-slate-800 mt-0.5">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">Roles</p>
                            <div class="flex items-center gap-1.5 mt-1">
                                @if($user->is_admin)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">Admin</span>
                                @endif
                                @if($user->is_customer)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200/50">Customer</span>
                                @endif
                                @if(!$user->is_admin && !$user->is_customer)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-50 text-slate-500 border border-slate-200/50">No Role Assigned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">Email Verification</p>
                            <p class="text-sm text-slate-800 mt-0.5">
                                @if($user->hasVerifiedEmail())
                                    Verified on {{ $user->email_verified_at->format('F d, Y \a\t h:i A') }}
                                @else
                                    Not verified
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">Registered On</p>
                            <p class="text-sm text-slate-800 mt-0.5">{{ $user->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-medium">Last Updated</p>
                            <p class="text-sm text-slate-800 mt-0.5">{{ $user->updated_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Quick Actions -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h2 class="text-base font-semibold text-slate-800">Quick Actions</h2>
                </div>
                <div class="p-5 space-y-2">
                    <!-- Toggle Admin -->
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('dashboard.users.toggle-admin', $user) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ $user->is_admin ? 'text-red-600 hover:bg-red-50' : 'text-emerald-600 hover:bg-emerald-50' }}">
                            <div class="w-8 h-8 {{ $user->is_admin ? 'bg-red-100' : 'bg-emerald-100' }} rounded-lg flex items-center justify-center">
                                @if($user->is_admin)
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                @else
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                                @endif
                            </div>
                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                        </button>
                    </form>
                    @endif

                    <!-- Toggle Customer -->
                    <form method="POST" action="{{ route('dashboard.users.toggle-customer', $user) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ $user->is_customer ? 'text-red-600 hover:bg-red-50' : 'text-blue-600 hover:bg-blue-50' }}">
                            <div class="w-8 h-8 {{ $user->is_customer ? 'bg-red-100' : 'bg-blue-100' }} rounded-lg flex items-center justify-center">
                                @if($user->is_customer)
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                @else
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.375 3.375 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                @endif
                            </div>
                            {{ $user->is_customer ? 'Remove Customer' : 'Make Customer' }}
                        </button>
                    </form>

                    <!-- Toggle Email Verification -->
                    <form method="POST" action="{{ route('dashboard.users.toggle-verify', $user) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ $user->hasVerifiedEmail() ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50' }}">
                            <div class="w-8 h-8 {{ $user->hasVerifiedEmail() ? 'bg-amber-100' : 'bg-emerald-100' }} rounded-lg flex items-center justify-center">
                                @if($user->hasVerifiedEmail())
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                @else
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                @endif
                            </div>
                            {{ $user->hasVerifiedEmail() ? 'Unverify Email' : 'Verify Email' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Session Info -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h2 class="text-base font-semibold text-slate-800">Activity</h2>
                </div>
                <div class="p-5 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700">Account Created</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182M2.985 19.644l3.181-3.182" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700">Last Updated</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @if($user->hasVerifiedEmail())
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700">Email Verified</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $user->email_verified_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
         @click.self="showDeleteModal = false">
        <div x-show="showDeleteModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete User</h3>
            <p class="text-sm text-slate-500 text-center mb-6">
                Are you sure you want to delete <span class="font-semibold text-slate-700">{{ $user->name }}</span>? This action cannot be undone.
            </p>
            <div class="flex items-center gap-3">
                <button type="button" @click="showDeleteModal = false"
                        class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                    Cancel
                </button>
                <form method="POST" action="{{ route('dashboard.users.destroy', $user) }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
