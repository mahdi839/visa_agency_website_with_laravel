@extends('layouts.admin_layout', ['title' => 'Dashboard'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- Page Title -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-sm text-slate-500 mt-1">Welcome back, {{ auth()->user()->name }}. Here's what's happening today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">

        <!-- Total Applications -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-200/50 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    +12%
                </span>
            </div>
            <p class="text-2xl font-bold text-slate-900">248</p>
            <p class="text-sm text-slate-500 mt-1">Total Applications</p>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-200/50 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" /></svg>
                    +3
                </span>
            </div>
            <p class="text-2xl font-bold text-slate-900">34</p>
            <p class="text-sm text-slate-500 mt-1">Pending Review</p>
        </div>

        <!-- Approved -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-200/50 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    +8%
                </span>
            </div>
            <p class="text-2xl font-bold text-slate-900">189</p>
            <p class="text-sm text-slate-500 mt-1">Approved Visas</p>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:shadow-slate-200/50 transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-violet-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    +22%
                </span>
            </div>
            <p class="text-2xl font-bold text-slate-900">€48,250</p>
            <p class="text-sm text-slate-500 mt-1">Total Revenue</p>
        </div>

    </div>

    <!-- Two Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Applications Table -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-800">Recent Applications</h2>
                <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Applicant</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Visa Type</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Status</th>
                            <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-5 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Rahim+Uddin&background=e2e8f0&color=475569&size=64&bold=true&font-size=0.4" class="w-8 h-8 rounded-lg" alt="">
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Rahim Uddin</p>
                                        <p class="text-xs text-slate-400">BD-2025-0042</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">Schengen</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200/50">Pending</span>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-500">Jan 15, 2025</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Fatima+Begum&background=e2e8f0&color=475569&size=64&bold=true&font-size=0.4" class="w-8 h-8 rounded-lg" alt="">
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Fatima Begum</p>
                                        <p class="text-xs text-slate-400">BD-2025-0041</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">Work Permit</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">Approved</span>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-500">Jan 14, 2025</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Karim+Hossain&background=e2e8f0&color=475569&size=64&bold=true&font-size=0.4" class="w-8 h-8 rounded-lg" alt="">
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Karim Hossain</p>
                                        <p class="text-xs text-slate-400">BD-2025-0040</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">Student</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200/50">Processing</span>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-500">Jan 13, 2025</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Nasir+Ahmed&background=e2e8f0&color=475569&size=64&bold=true&font-size=0.4" class="w-8 h-8 rounded-lg" alt="">
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Nasir Ahmed</p>
                                        <p class="text-xs text-slate-400">BD-2025-0039</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">Family</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200/50">Rejected</span>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-500">Jan 12, 2025</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Sumaiya+Islam&background=e2e8f0&color=475569&size=64&bold=true&font-size=0.4" class="w-8 h-8 rounded-lg" alt="">
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Sumaiya Islam</p>
                                        <p class="text-xs text-slate-400">BD-2025-0038</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">Schengen</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/50">Approved</span>
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-500">Jan 11, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <h2 class="text-base font-semibold text-slate-800 mb-4">Quick Actions</h2>
                <div class="space-y-2">
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        </div>
                        New Application
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        </div>
                        View All Applications
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-violet-50 hover:text-violet-700 transition-colors">
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                        </div>
                        Write Blog Post
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <h2 class="text-base font-semibold text-slate-800 mb-4">Recent Activity</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-sm text-slate-700 leading-snug">Visa approved for <span class="font-medium">Fatima Begum</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-sm text-slate-700 leading-snug">Payment received from <span class="font-medium">Karim Hossain</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-sm text-slate-700 leading-snug">New application from <span class="font-medium">Rahim Uddin</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">5 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-slate-300 rounded-full mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-sm text-slate-700 leading-snug">Blog post <span class="font-medium">"Spain Work Visa Guide"</span> published</p>
                            <p class="text-xs text-slate-400 mt-0.5">Yesterday</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-red-400 rounded-full mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-sm text-slate-700 leading-snug">Visa rejected for <span class="font-medium">Nasir Ahmed</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">Yesterday</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection