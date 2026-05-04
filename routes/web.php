<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Dashboard\AboutUsController;
use App\Http\Controllers\Dashboard\VisaApplicationController as DashboardVisaApplicationController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Portal\VisaApplicationController as PortalVisaApplicationController;
use App\Http\Controllers\VisaApplicationController;
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

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/visa-applications', [VisaApplicationController::class, 'store'])->name('visa-applications.store');

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

    // About Us Management (CRUD)
    Route::resource('dashboard/about-us', AboutUsController::class)->names([
        'index'   => 'dashboard.about-us.index',
        'create'  => 'dashboard.about-us.create',
        'store'   => 'dashboard.about-us.store',
        'show'    => 'dashboard.about-us.show',
        'edit'    => 'dashboard.about-us.edit',
        'update'  => 'dashboard.about-us.update',
        'destroy' => 'dashboard.about-us.destroy',
    ])->parameters(['about-us' => 'aboutUs']);

    Route::get('dashboard/visa-applications', [DashboardVisaApplicationController::class, 'index'])
        ->name('dashboard.visa-applications.index');
    Route::patch('dashboard/visa-applications/{visaApplication}/status', [DashboardVisaApplicationController::class, 'updateStatus'])
        ->name('dashboard.visa-applications.update-status');

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
    Route::get('/portal', [PortalVisaApplicationController::class, 'index'])->name('portal.index');
    Route::get('/portal/application/{visaApplication}', [PortalVisaApplicationController::class, 'show'])->name('portal.application');

    Route::get('/portal/documents', function () {
        return view('portal.documents');
    })->name('portal.documents');
});

require __DIR__.'/auth.php';
