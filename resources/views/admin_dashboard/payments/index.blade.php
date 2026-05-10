@extends('layouts.admin_layout', ['title' => 'Payments'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Payments</h1>
            <p class="text-sm text-slate-500 mt-1">Track customer payment entries and dues.</p>
        </div>
        <a href="{{ route('dashboard.payments.create') }}" class="px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700">Add Payment</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-emerald-700">{{ number_format($totalPaid, 2) }}</p><p class="text-xs text-slate-500">Total Paid</p></div>
        <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-amber-700">{{ number_format($totalDue, 2) }}</p><p class="text-xs text-slate-500">Total Due</p></div>
    </div>

    <form method="GET" class="bg-white rounded-xl border border-slate-200 p-4 flex gap-3">
        <input name="search" value="{{ request('search') }}" placeholder="Search customer..." class="flex-1 px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg">
        <button class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg">Filter</button>
    </form>

    @if(session('success'))<div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>@endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead><tr class="bg-slate-50 border-b border-slate-100">
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Customer</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Amount</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Due</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Method / Date</th>
                <th class="text-right text-xs font-semibold text-slate-500 uppercase px-5 py-3">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-slate-50">
            @forelse($payments as $payment)
                <tr>
                    <td class="px-5 py-3.5 text-sm"><div class="font-medium text-slate-800">{{ $payment->customer?->name }}</div><div class="text-xs text-slate-400">{{ $payment->customer?->email }}</div></td>
                    <td class="px-5 py-3.5 text-sm text-emerald-700 font-semibold">{{ number_format($payment->amount, 2) }}</td>
                    <td class="px-5 py-3.5 text-sm text-amber-700 font-semibold">{{ number_format($payment->due, 2) }}</td>
                    <td class="px-5 py-3.5 text-sm text-slate-600">{{ $payment->payment_method }}<div class="text-xs text-slate-400">{{ $payment->payment_date->format('M d, Y') }}</div></td>
                    <td class="px-5 py-3.5"><div class="flex justify-end gap-2 text-xs font-medium">
                        @if($payment->document)<a class="text-blue-600" target="_blank" href="{{ asset('storage/'.$payment->document) }}">Document</a>@endif
                        <a class="text-emerald-600" href="{{ route('dashboard.payments.edit', $payment) }}">Edit</a>
                        <form method="POST" action="{{ route('dashboard.payments.destroy', $payment) }}" onsubmit="return confirm('Delete this payment?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form>
                    </div></td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-12 text-center text-sm text-slate-500">No payment entries found.</td></tr>
            @endforelse
            </tbody>
        </table>
        @if($payments->hasPages())<div class="px-5 py-4 border-t border-slate-100">{{ $payments->links() }}</div>@endif
    </div>
</div>
@endsection
