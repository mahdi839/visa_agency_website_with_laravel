<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\VisaApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VisaApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = VisaApplication::query()->with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('country', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%")
                    ->orWhere('update_message', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('subject')) {
            $query->where('subject', $request->input('subject'));
        }

        if ($request->filled('country')) {
            $query->where('country', $request->input('country'));
        }

        $applications = $query->latest()->paginate(15)->withQueryString();
        $countries = VisaApplication::query()->select('country')->distinct()->orderBy('country')->pluck('country');
        $totalApplications = VisaApplication::count();
        $pendingApplications = VisaApplication::where('status', 'pending')->count();
        $progressApplications = VisaApplication::where('status', 'progress')->count();
        $completedApplications = VisaApplication::where('status', 'completed')->count();

        return view('admin_dashboard.visa_applications.index', compact(
            'applications',
            'countries',
            'totalApplications',
            'pendingApplications',
            'progressApplications',
            'completedApplications'
        ));
    }

    public function updateStatus(Request $request, VisaApplication $visaApplication): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(VisaApplication::STATUSES))],
            'update_message' => ['nullable', 'string', 'max:5000'],
        ]);

        $message = $validated['update_message'] ?? null;

        $visaApplication->update([
            'status' => $validated['status'],
            'update_message' => $message,
            'update_message_at' => filled($message) ? now() : null,
        ]);

        return back()->with('success', 'Application update saved successfully.');
    }
}
