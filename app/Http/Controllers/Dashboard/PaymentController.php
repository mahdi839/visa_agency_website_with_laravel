<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with('customer')
            ->when($request->filled('search'), fn ($q) => $q->whereHas('customer', fn ($customer) => $customer
                ->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')))
            ->latest('payment_date')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin_dashboard.payments.index', [
            'payments' => $payments,
            'totalPaid' => Payment::sum('amount'),
            'totalDue' => Payment::sum('due'),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.payments.create', ['customers' => $this->customers()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayment($request);

        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('payments', 'public');
        }

        Payment::create($validated);

        return redirect()->route('dashboard.payments.index')->with('success', 'Payment entry has been created.');
    }

    public function edit(Payment $payment)
    {
        return view('admin_dashboard.payments.edit', ['payment' => $payment, 'customers' => $this->customers()]);
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $this->validatePayment($request);

        if ($request->hasFile('document')) {
            if ($payment->document) {
                Storage::disk('public')->delete($payment->document);
            }
            $validated['document'] = $request->file('document')->store('payments', 'public');
        }

        $payment->update($validated);

        return redirect()->route('dashboard.payments.index')->with('success', 'Payment entry has been updated.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->document) {
            Storage::disk('public')->delete($payment->document);
        }

        $payment->delete();

        return redirect()->route('dashboard.payments.index')->with('success', 'Payment entry has been deleted.');
    }

    private function customers()
    {
        return User::where('is_customer', true)->orderBy('name')->get(['id', 'name', 'email']);
    }

    private function validatePayment(Request $request): array
    {
        return $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string', 'max:120'],
            'payment_date' => ['required', 'date'],
            'document' => ['nullable', 'file', 'max:5120'],
            'note' => ['nullable', 'string', 'max:5000'],
            'due' => ['nullable', 'numeric', 'min:0'],
        ]);
    }
}
