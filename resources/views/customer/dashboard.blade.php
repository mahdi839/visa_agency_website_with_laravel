@extends('layouts.customer_dashboard_layout', ['title' => 'Dashboard'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700 rounded-2xl p-6 sm:p-8 overflow-hidden">
        <!-- Decorative -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-white/5 rounded-full translate-y-1/2"></div>

        <div class="relative">
            <p class="text-emerald-100 text-sm font-medium mb-1">Welcome back,</p>
            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">{{ auth()->user()->name }}</h1>
            <p class="text-emerald-100/80 text-sm sm:text-base max-w-lg">Track your visa applications, manage documents, and stay updated on your immigration journey — all in one place.</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Active Applications -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-100 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">2</p>
            <p class="text-xs text-slate-500 mt-0.5">Active Applications</p>
        </div>

        <!-- Pending Documents -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-100 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" /></svg>
                </div>
                <span class="text-[10px] font-bold text-amber-600 bg-amber-100 px-1.5 py-0.5 rounded">Action</span>
            </div>
            <p class="text-2xl font-bold text-slate-900">3</p>
            <p class="text-xs text-slate-500 mt-0.5">Pending Documents</p>
        </div>

        <!-- Total Paid -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-100 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">€1,700</p>
            <p class="text-xs text-slate-500 mt-0.5">Total Paid</p>
        </div>

        <!-- Messages -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-100 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-violet-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                </div>
                <span class="text-[10px] font-bold text-red-600 bg-red-100 px-1.5 py-0.5 rounded">New</span>
            </div>
            <p class="text-2xl font-bold text-slate-900">2</p>
            <p class="text-xs text-slate-500 mt-0.5">Unread Messages</p>
        </div>

    </div>

    <!-- Two Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Application Progress -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Primary Application -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-base font-semibold text-slate-800">Schengen Tourist Visa</h2>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200/50">Processing</span>
                    </div>
                    <a href="{{ route('portal.application', 1) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">View Details</a>
                </div>

                <!-- Progress Tracker -->
                <div class="p-5">
                    <div class="flex items-center justify-between mb-8 relative">
                        <!-- Background Line -->
                        <div class="absolute top-4 left-8 right-8 h-0.5 bg-slate-100"></div>
                        <div class="absolute top-4 left-8 h-0.5 bg-emerald-500" style="width: 50%;"></div>

                        <!-- Step 1: Submitted -->
                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center ring-4 ring-emerald-50">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                            <p class="text-xs font-medium text-emerald-700 mt-2.5">Submitted</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Jan 5</p>
                        </div>

                        <!-- Step 2: Under Review -->
                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center ring-4 ring-emerald-50">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                            <p class="text-xs font-medium text-emerald-700 mt-2.5">Under Review</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Jan 12</p>
                        </div>

                        <!-- Step 3: Processing (Current) -->
                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center ring-4 ring-emerald-100 animate-pulse">
                                <div class="w-2.5 h-2.5 bg-white rounded-full"></div>
                            </div>
                            <p class="text-xs font-semibold text-emerald-700 mt-2.5">Processing</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Jan 18</p>
                        </div>

                        <!-- Step 4: Approved -->
                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center ring-4 ring-white">
                                <span class="text-xs font-bold text-slate-400">4</span>
                            </div>
                            <p class="text-xs font-medium text-slate-400 mt-2.5">Approved</p>
                            <p class="text-[10px] text-slate-300 mt-0.5">—</p>
                        </div>

                        <!-- Step 5: Delivered -->
                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center ring-4 ring-white">
                                <span class="text-xs font-bold text-slate-400">5</span>
                            </div>
                            <p class="text-xs font-medium text-slate-400 mt-2.5">Delivered</p>
                            <p class="text-[10px] text-slate-300 mt-0.5">—</p>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="bg-slate-50 rounded-lg p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                        <div>
                            <p class="text-sm font-medium text-slate-700">Your application is currently being processed</p>
                            <p class="text-xs text-slate-500 mt-1">Estimated completion: <span class="font-medium text-slate-700">Feb 5 - Feb 12, 2025</span>. We'll notify you as soon as there's an update.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Application -->
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-base font-semibold text-slate-800">Work Permit Visa</h2>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/50">Documents Required</span>
                    </div>
                    <a href="{{ route('portal.application', 2) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">View Details</a>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-6 relative">
                        <div class="absolute top-4 left-8 right-8 h-0.5 bg-slate-100"></div>
                        <div class="absolute top-4 left-8 h-0.5 bg-amber-400" style="width: 25%;"></div>

                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-amber-400 rounded-full flex items-center justify-center ring-4 ring-amber-50">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                            <p class="text-xs font-medium text-amber-700 mt-2.5">Submitted</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Jan 20</p>
                        </div>

                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-amber-400 rounded-full flex items-center justify-center ring-4 ring-amber-100 animate-pulse">
                                <div class="w-2.5 h-2.5 bg-white rounded-full"></div>
                            </div>
                            <p class="text-xs font-semibold text-amber-700 mt-2.5">Documents</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Now</p>
                        </div>

                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center ring-4 ring-white">
                                <span class="text-xs font-bold text-slate-400">3</span>
                            </div>
                            <p class="text-xs font-medium text-slate-400 mt-2.5">Review</p>
                            <p class="text-[10px] text-slate-300 mt-0.5">—</p>
                        </div>

                        <div class="relative flex flex-col items-center z-10">
                            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center ring-4 ring-white">
                                <span class="text-xs font-bold text-slate-400">4</span>
                            </div>
                            <p class="text-xs font-medium text-slate-400 mt-2.5">Approved</p>
                            <p class="text-[10px] text-slate-300 mt-0.5">—</p>
                        </div>
                    </div>

                    <!-- Missing Documents Alert -->
                    <div class="bg-amber-50 border border-amber-200/50 rounded-lg p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                        <div>
                            <p class="text-sm font-medium text-amber-800">3 documents are required to proceed</p>
                            <p class="text-xs text-amber-600 mt-1">Passport copy, bank statement, and employment letter need to be uploaded.</p>
                            <a href="{{ route('portal.documents') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-700 hover:text-amber-800 mt-2 transition-colors">
                                Upload Now
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <h2 class="text-base font-semibold text-slate-800 mb-4">Quick Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('portal.documents') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-amber-50 hover:text-amber-700 transition-colors group">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" /></svg>
                        </div>
                        Upload Documents
                    </a>
                    <a href="{{ route('portal.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-colors group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        View All Applications
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-colors group">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                        </div>
                        Payment History
                    </a>
                    <a href="{{ route('portal.messages.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-violet-50 hover:text-violet-700 transition-colors group">
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                            <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                        </div>
                        Send Message
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <h2 class="text-base font-semibold text-slate-800 mb-4">Activity Log</h2>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mt-1.5"></div>
                            <div class="w-px flex-1 bg-slate-100 mt-1"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-sm text-slate-700 leading-snug">Application status changed to <span class="font-semibold text-emerald-600">Processing</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">Jan 18, 2025 · 10:30 AM</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5"></div>
                            <div class="w-px flex-1 bg-slate-100 mt-1"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-sm text-slate-700 leading-snug">Payment of <span class="font-semibold">€850</span> confirmed</p>
                            <p class="text-xs text-slate-400 mt-0.5">Jan 15, 2025 · 2:15 PM</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-2 h-2 bg-slate-300 rounded-full mt-1.5"></div>
                            <div class="w-px flex-1 bg-slate-100 mt-1"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-sm text-slate-700 leading-snug">Application moved to <span class="font-semibold">Under Review</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">Jan 12, 2025 · 9:00 AM</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-2 h-2 bg-slate-300 rounded-full mt-1.5"></div>
                        </div>
                        <div>
                            <p class="text-sm text-slate-700 leading-snug">Application <span class="font-semibold">submitted</span> successfully</p>
                            <p class="text-xs text-slate-400 mt-0.5">Jan 5, 2025 · 11:45 AM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Need Help? -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-5 text-white">
                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>
                </div>
                <h3 class="text-sm font-semibold mb-1">Need Help?</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-3">Have questions about your application? Our support team is here to assist you.</p>
                <a href="{{ route('portal.messages.create') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">
                    Contact Support
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
