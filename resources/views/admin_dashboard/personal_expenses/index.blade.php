@extends('layouts.admin_layout', ['title' => 'Personal Expenses'])

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Personal Expenses</h1>
            <p class="text-sm text-slate-500 mt-1">Manage internal expense records.</p>
        </div>
        <a href="{{ route('dashboard.personal-expenses.create') }}" class="px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700">Add Expense</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4"><p class="text-xl font-bold text-slate-900">{{ number_format($totalAmount, 2) }}</p><p class="text-xs text-slate-500">Total Expenses</p></div>
    @if(session('success'))<div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm font-medium text-emerald-800">{{ session('success') }}</div>@endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead><tr class="bg-slate-50 border-b border-slate-100">
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Purpose</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Amount</th>
                <th class="text-left text-xs font-semibold text-slate-500 uppercase px-5 py-3">Note</th>
                <th class="text-right text-xs font-semibold text-slate-500 uppercase px-5 py-3">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-slate-50">
            @forelse($expenses as $expense)
                <tr>
                    <td class="px-5 py-3.5 text-sm font-medium text-slate-800">{{ $expense->purpose }}<div class="text-xs text-slate-400">{{ $expense->created_at->format('M d, Y') }}</div></td>
                    <td class="px-5 py-3.5 text-sm text-red-700 font-semibold">{{ number_format($expense->amount, 2) }}</td>
                    <td class="px-5 py-3.5 text-sm text-slate-500">{{ \Illuminate\Support\Str::limit($expense->note, 70) }}</td>
                    <td class="px-5 py-3.5"><div class="flex justify-end gap-2 text-xs font-medium">
                        @if($expense->document)<a class="text-blue-600" target="_blank" href="{{ asset('storage/'.$expense->document) }}">Document</a>@endif
                        <a class="text-emerald-600" href="{{ route('dashboard.personal-expenses.edit', $expense) }}">Edit</a>
                        <form method="POST" action="{{ route('dashboard.personal-expenses.destroy', $expense) }}" onsubmit="return confirm('Delete this expense?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form>
                    </div></td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-12 text-center text-sm text-slate-500">No personal expenses found.</td></tr>
            @endforelse
            </tbody>
        </table>
        @if($expenses->hasPages())<div class="px-5 py-4 border-t border-slate-100">{{ $expenses->links() }}</div>@endif
    </div>
</div>
@endsection
