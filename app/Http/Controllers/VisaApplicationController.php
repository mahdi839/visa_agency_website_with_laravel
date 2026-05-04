<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VisaApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class VisaApplicationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => ['required', Rule::in(array_keys(VisaApplication::SUBJECTS))],
            'country' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:5000'],
            'document' => ['nullable', 'image', 'max:5120'],
            'note' => ['nullable', 'string', 'max:3000'],
            'urgency' => ['required', Rule::in(array_keys(VisaApplication::URGENCIES))],
        ]);

        $user = $request->user();

        if (! $user) {
            $user = $this->authenticateFromApplicationForm($request);
        }

        $documentPath = $request->file('document')?->store('visa-applications', 'public');

        VisaApplication::create([
            'user_id' => $user->id,
            'subject' => $validated['subject'],
            'country' => $validated['country'],
            'description' => $validated['description'] ?? null,
            'document_path' => $documentPath,
            'note' => $validated['note'] ?? null,
            'urgency' => $validated['urgency'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route($user->is_admin ? 'dashboard.visa-applications.index' : 'portal.index')
            ->with('success', 'Your application has been submitted successfully.');
    }

    private function authenticateFromApplicationForm(Request $request): User
    {
        $mode = $request->input('auth_mode', 'login');

        if ($mode === 'register') {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_admin' => false,
                'is_customer' => true,
            ]);

            Auth::login($user);

            return $user;
        }

        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            $authenticated = Auth::attempt($credentials, $request->boolean('remember'));
        } catch (RuntimeException) {
            $authenticated = false;
        }

        if (! $authenticated) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return $request->user();
    }
}
