<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PersonalExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalExpenseController extends Controller
{
    public function index()
    {
        $expenses = PersonalExpense::latest()->paginate(12);

        return view('admin_dashboard.personal_expenses.index', [
            'expenses' => $expenses,
            'totalAmount' => PersonalExpense::sum('amount'),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.personal_expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateExpense($request);

        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('personal-expenses', 'public');
        }

        PersonalExpense::create($validated);

        return redirect()->route('dashboard.personal-expenses.index')->with('success', 'Personal expense has been created.');
    }

    public function edit(PersonalExpense $personalExpense)
    {
        return view('admin_dashboard.personal_expenses.edit', compact('personalExpense'));
    }

    public function update(Request $request, PersonalExpense $personalExpense)
    {
        $validated = $this->validateExpense($request);

        if ($request->hasFile('document')) {
            if ($personalExpense->document) {
                Storage::disk('public')->delete($personalExpense->document);
            }
            $validated['document'] = $request->file('document')->store('personal-expenses', 'public');
        }

        $personalExpense->update($validated);

        return redirect()->route('dashboard.personal-expenses.index')->with('success', 'Personal expense has been updated.');
    }

    public function destroy(PersonalExpense $personalExpense)
    {
        if ($personalExpense->document) {
            Storage::disk('public')->delete($personalExpense->document);
        }

        $personalExpense->delete();

        return redirect()->route('dashboard.personal-expenses.index')->with('success', 'Personal expense has been deleted.');
    }

    private function validateExpense(Request $request): array
    {
        return $request->validate([
            'purpose' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'document' => ['nullable', 'file', 'max:5120'],
            'note' => ['nullable', 'string', 'max:5000'],
        ]);
    }
}
