<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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