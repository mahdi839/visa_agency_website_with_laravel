<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| Admin Routes (is_admin = true)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('admin_dashboard.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management (CRUD)
    Route::resource('dashboard/users', UserController::class)->names([
        'index'   => 'dashboard.users.index',
        'create'  => 'dashboard.users.create',
        'store'   => 'dashboard.users.store',
        'show'    => 'dashboard.users.show',
        'edit'    => 'dashboard.users.edit',
        'update'  => 'dashboard.users.update',
        'destroy' => 'dashboard.users.destroy',
    ])->parameters(['users' => 'user']);

    // User Quick Actions
    Route::patch('dashboard/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('dashboard.users.toggle-admin');
    Route::patch('dashboard/users/{user}/toggle-customer', [UserController::class, 'toggleCustomer'])->name('dashboard.users.toggle-customer');
    Route::patch('dashboard/users/{user}/toggle-verify', [UserController::class, 'toggleVerify'])->name('dashboard.users.toggle-verify');
});

/*
|--------------------------------------------------------------------------
| Customer Routes (is_customer = true)
|--------------------------------------------------------------------------
*/

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth', 'verified', 'customer'])->name('customer.dashboard');

Route::middleware(['auth', 'customer'])->group(function () {
    // Client Portal - Visa Application Tracking
    Route::get('/portal', function () {
        return view('portal.index');
    })->name('portal.index');

    Route::get('/portal/application/{id}', function ($id) {
        return view('portal.application', compact('id'));
    })->name('portal.application');

    Route::get('/portal/documents', function () {
        return view('portal.documents');
    })->name('portal.documents');
});

require __DIR__.'/auth.php';
