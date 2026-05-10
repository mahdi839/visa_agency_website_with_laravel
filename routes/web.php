<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\AboutUsController;
use App\Http\Controllers\Dashboard\BlogPostController as DashboardBlogPostController;
use App\Http\Controllers\Dashboard\ContactSubmissionController as DashboardContactSubmissionController;
use App\Http\Controllers\Dashboard\MessageThreadController as DashboardMessageThreadController;
use App\Http\Controllers\Dashboard\PaymentController as DashboardPaymentController;
use App\Http\Controllers\Dashboard\PersonalExpenseController as DashboardPersonalExpenseController;
use App\Http\Controllers\Dashboard\ServiceController as DashboardServiceController;
use App\Http\Controllers\Dashboard\TestimonialController as DashboardTestimonialController;
use App\Http\Controllers\Dashboard\VisaApplicationController as DashboardVisaApplicationController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Portal\MessageThreadController as PortalMessageThreadController;
use App\Http\Controllers\Portal\VisaApplicationController as PortalVisaApplicationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisaApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

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

    Route::resource('dashboard/blog-posts', DashboardBlogPostController::class)->names([
        'index'   => 'dashboard.blog-posts.index',
        'create'  => 'dashboard.blog-posts.create',
        'store'   => 'dashboard.blog-posts.store',
        'show'    => 'dashboard.blog-posts.show',
        'edit'    => 'dashboard.blog-posts.edit',
        'update'  => 'dashboard.blog-posts.update',
        'destroy' => 'dashboard.blog-posts.destroy',
    ])->parameters(['blog-posts' => 'blogPost']);

    Route::resource('dashboard/services', DashboardServiceController::class)->names([
        'index'   => 'dashboard.services.index',
        'create'  => 'dashboard.services.create',
        'store'   => 'dashboard.services.store',
        'show'    => 'dashboard.services.show',
        'edit'    => 'dashboard.services.edit',
        'update'  => 'dashboard.services.update',
        'destroy' => 'dashboard.services.destroy',
    ])->parameters(['services' => 'service']);

    Route::resource('dashboard/contact-submissions', DashboardContactSubmissionController::class)
        ->only(['index', 'show', 'update', 'destroy'])
        ->names([
            'index' => 'dashboard.contact-submissions.index',
            'show' => 'dashboard.contact-submissions.show',
            'update' => 'dashboard.contact-submissions.update',
            'destroy' => 'dashboard.contact-submissions.destroy',
        ])
        ->parameters(['contact-submissions' => 'contactSubmission']);

    Route::resource('dashboard/messages', DashboardMessageThreadController::class)
        ->only(['index', 'create', 'store', 'show', 'update', 'destroy'])
        ->names([
            'index' => 'dashboard.messages.index',
            'create' => 'dashboard.messages.create',
            'store' => 'dashboard.messages.store',
            'show' => 'dashboard.messages.show',
            'update' => 'dashboard.messages.update',
            'destroy' => 'dashboard.messages.destroy',
        ])
        ->parameters(['messages' => 'messageThread']);
    Route::post('dashboard/messages/{messageThread}/reply', [DashboardMessageThreadController::class, 'reply'])
        ->name('dashboard.messages.reply');

    Route::get('dashboard/visa-applications', [DashboardVisaApplicationController::class, 'index'])
        ->name('dashboard.visa-applications.index');
    Route::patch('dashboard/visa-applications/{visaApplication}/status', [DashboardVisaApplicationController::class, 'updateStatus'])
        ->name('dashboard.visa-applications.update-status');

    Route::resource('dashboard/payments', DashboardPaymentController::class)
        ->except(['show'])
        ->names('dashboard.payments')
        ->parameters(['payments' => 'payment']);

    Route::resource('dashboard/personal-expenses', DashboardPersonalExpenseController::class)
        ->except(['show'])
        ->names('dashboard.personal-expenses')
        ->parameters(['personal-expenses' => 'personalExpense']);

    Route::resource('dashboard/testimonials', DashboardTestimonialController::class)
        ->except(['show'])
        ->names('dashboard.testimonials')
        ->parameters(['testimonials' => 'testimonial']);

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

    Route::get('/portal/messages', [PortalMessageThreadController::class, 'index'])->name('portal.messages.index');
    Route::get('/portal/messages/create', [PortalMessageThreadController::class, 'create'])->name('portal.messages.create');
    Route::post('/portal/messages', [PortalMessageThreadController::class, 'store'])->name('portal.messages.store');
    Route::get('/portal/messages/{messageThread}', [PortalMessageThreadController::class, 'show'])->name('portal.messages.show');
    Route::post('/portal/messages/{messageThread}/reply', [PortalMessageThreadController::class, 'reply'])->name('portal.messages.reply');
});

require __DIR__.'/auth.php';
