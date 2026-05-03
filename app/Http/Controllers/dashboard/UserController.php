<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the users with search and filtering.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $role = $request->input('role');
            if ($role === 'admin') {
                $query->where('is_admin', true);
            } elseif ($role === 'customer') {
                $query->where('is_customer', true);
            }
        }

        // Filter by email verification status
        if ($request->filled('verified')) {
            if ($request->input('verified') === 'yes') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->input('verified') === 'no') {
                $query->whereNull('email_verified_at');
            }
        }

        // Sort
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $allowedSorts = ['name', 'email', 'created_at', 'email_verified_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'created_at';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(15)->withQueryString();

        // Stats for the page header
        $totalUsers = User::count();
        $totalAdmins = User::where('is_admin', true)->count();
        $totalCustomers = User::where('is_customer', true)->count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();

        return view('admin_dashboard.users.index', compact(
            'users', 'totalUsers', 'totalAdmins', 'totalCustomers', 'verifiedUsers'
        ));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin_dashboard.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', Password::defaults()],
            'is_admin'              => ['sometimes', 'boolean'],
            'is_customer'           => ['sometimes', 'boolean'],
            'email_verified'        => ['sometimes', 'boolean'],
        ]);

        $user = User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'password'          => Hash::make($validated['password']),
            'is_admin'          => $request->has('is_admin'),
            'is_customer'       => $request->has('is_customer') || !$request->has('is_admin'),
            'email_verified_at' => $request->has('email_verified') ? now() : null,
        ]);

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', "User \"{$user->name}\" has been created successfully.");
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin_dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin_dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'              => ['nullable', 'confirmed', Password::defaults()],
            'is_admin'              => ['sometimes', 'boolean'],
            'is_customer'           => ['sometimes', 'boolean'],
            'email_verified'        => ['sometimes', 'boolean'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->is_admin = $request->has('is_admin');
        $user->is_customer = $request->has('is_customer') || !$request->has('is_admin');

        // Only update password if a new one is provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle email verification
        if ($request->has('email_verified')) {
            if (is_null($user->email_verified_at)) {
                $user->email_verified_at = now();
            }
        } else {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', "User \"{$user->name}\" has been updated successfully.");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', "User \"{$name}\" has been deleted successfully.");
    }

    /**
     * Toggle the admin status of a user.
     */
    public function toggleAdmin(User $user)
    {
        // Prevent admin from removing their own admin status
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot remove your own admin privileges.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        $status = $user->is_admin ? 'granted admin' : 'removed admin';
        return back()->with('success', "User \"{$user->name}\" has been {$status} privileges.");
    }

    /**
     * Toggle the customer status of a user.
     */
    public function toggleCustomer(User $user)
    {
        $user->is_customer = !$user->is_customer;
        $user->save();

        $status = $user->is_customer ? 'granted customer' : 'removed customer';
        return back()->with('success', "User \"{$user->name}\" has been {$status} privileges.");
    }

    /**
     * Verify or unverify a user's email.
     */
    public function toggleVerify(User $user)
    {
        if ($user->hasVerifiedEmail()) {
            $user->email_verified_at = null;
            $user->save();
            return back()->with('success', "Email verification removed for \"{$user->name}\".");
        }

        $user->markEmailAsVerified();
        return back()->with('success', "Email verified for \"{$user->name}\".");
    }
}
