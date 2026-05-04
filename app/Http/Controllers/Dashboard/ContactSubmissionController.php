<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $submissions = $query->latest()->paginate(12)->withQueryString();

        return view('admin_dashboard.contact_submissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $contactSubmission)
    {
        if ($contactSubmission->status === 'new') {
            $contactSubmission->update(['status' => 'read']);
        }

        return view('admin_dashboard.contact_submissions.show', compact('contactSubmission'));
    }

    public function update(Request $request, ContactSubmission $contactSubmission)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(ContactSubmission::STATUSES))],
        ]);

        $contactSubmission->update($validated);

        return back()->with('success', 'Contact submission status has been updated.');
    }

    public function destroy(ContactSubmission $contactSubmission)
    {
        $contactSubmission->delete();

        return redirect()->route('dashboard.contact-submissions.index')
            ->with('success', 'Contact submission has been deleted.');
    }
}
