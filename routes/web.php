<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TicketController as UserTicketController;
use App\Models\Payment;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Event routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('events.show');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::view('/faq', 'faq')->name('faq');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {
    // Event Order
    Route::get('/event/{event}/order', [EventController::class, 'order'])->name('event.order');
    Route::post('/event/order/process', [EventController::class, 'processOrder'])->name('event.order.process');
    Route::post('/event/order/whatsapp', [EventController::class, 'processWhatsAppOrder'])
        ->name('event.order.whatsapp')
        ->middleware(['auth', 'user']);

    // Payment routes
    Route::get('/payment/pending/{code}', [PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('/ticket/{code}', [PaymentController::class, 'showTicket'])->name('ticket.show');
    Route::get('/ticket/{code}/download', [PaymentController::class, 'downloadTicket'])->name('ticket.download');

    // User Panel
    Route::get('/my-tickets', [UserTicketController::class, 'index'])->name('user.tickets');
    Route::get('/my-tickets/{code}', [UserTicketController::class, 'show'])->name('user.ticket.show');
    Route::get('/my-profile', [ProfileController::class, 'edit'])->name('user.profile');
    Route::post('/my-profile', [ProfileController::class, 'update'])->name('user.profile.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/quick-actions', [DashboardController::class, 'quickActions'])->name('dashboard.quick-actions');

    // Banner CRUD
    Route::resource('banners', BannerController::class);
    Route::post('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');

    // Event CRUD
    Route::resource('events', AdminEventController::class);
    Route::post('events/{event}/toggle-status', [AdminEventController::class, 'toggleStatus'])->name('events.toggle');

    // Ticket Categories (nested under events)
    Route::resource('events.ticket-categories', TicketCategoryController::class)->except(['show']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // whatsapp
    Route::get('/settings/whatsapp', [SettingController::class, 'whatsapp'])->name('settings.whatsapp');
    Route::post('/settings/whatsapp', [SettingController::class, 'updateWhatsapp'])->name('settings.whatsapp.update');

    // Tickets management
    Route::resource('tickets', AdminTicketController::class)->only(['index', 'show', 'destroy']);
    Route::get('tickets/stats', [AdminTicketController::class, 'stats'])->name('tickets.stats');

    // Payments management
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'show', 'update']);
});

/*
|--------------------------------------------------------------------------
| SCAN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('scan')->name('scan.')->group(function () {
    Route::get('/', [ScanController::class, 'scanPage'])->name('page');
    Route::post('/validate', [ScanController::class, 'validateScan'])->name('validate');
    Route::get('/result/{code}', [ScanController::class, 'scanResult'])->name('result');
    Route::get('/api/{code}', [ScanController::class, 'scan'])->name('api');
});

/*
|--------------------------------------------------------------------------
| PAYMENT & API ROUTES
|--------------------------------------------------------------------------
*/

// Payment simulation (admin only)
Route::post('/payment/simulate/{ticket}', [PaymentController::class, 'simulatePayment'])
    ->name('payment.simulate')
    ->middleware(['auth', 'admin']);

// Check ticket status API
Route::get('/api/ticket/{code}/status', [PaymentController::class, 'checkStatus'])
    ->name('api.ticket.status');

require __DIR__ . '/auth.php';
