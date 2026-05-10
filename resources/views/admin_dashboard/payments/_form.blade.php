@if($errors->any())<div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 text-sm text-red-700">{{ $errors->first() }}</div>@endif

<div class="bg-white rounded-xl border border-slate-200 p-5 space-y-4 max-w-3xl">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Customer</label>
        <select name="user_id" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">
            <option value="">Select customer</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('user_id', $payment->user_id ?? '') == $customer->id)>{{ $customer->name }} - {{ $customer->email }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Amount</label><input type="number" step="0.01" min="0" name="amount" value="{{ old('amount', $payment->amount ?? '') }}" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Due</label><input type="number" step="0.01" min="0" name="due" value="{{ old('due', $payment->due ?? 0) }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Payment Method</label><input name="payment_method" value="{{ old('payment_method', $payment->payment_method ?? '') }}" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Date</label><input type="date" name="payment_date" value="{{ old('payment_date', isset($payment) ? $payment->payment_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
    </div>
    <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Document</label><input type="file" name="document" class="block w-full text-sm text-slate-600"></div>
    <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Note</label><textarea name="note" rows="5" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">{{ old('note', $payment->note ?? '') }}</textarea></div>
    <div class="flex gap-3"><button class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg">{{ $submitLabel }}</button><a href="{{ route('dashboard.payments.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg">Cancel</a></div>
</div>
