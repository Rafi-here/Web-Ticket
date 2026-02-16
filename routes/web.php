<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\User\ProfileController; // GANTI: dari DashboardController ke ProfileController
use App\Http\Controllers\User\TicketController as UserTicketController; // TAMBAHKAN

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Semua orang bisa akses)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/film/{slug}', [HomeController::class, 'film'])->name('film.detail');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (Hanya user login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {
    // Wishlist - fitur user
    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/add/{film}', [HomeController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{film}', [HomeController::class, 'removeFromWishlist'])->name('wishlist.remove');

    // Payment routes
    Route::get('/payment/{showtime}', [PaymentController::class, 'showPayment'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/pending/{code}', [PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('/ticket/{code}', [PaymentController::class, 'showTicket'])->name('ticket.show');

    // Download ticket
    Route::get('/ticket/{code}/download', [PaymentController::class, 'downloadTicket'])->name('ticket.download');

    // ===== USER PANEL - AKSES LANGSUNG KE FITUR =====
    // Tiket saya
    Route::get('/my-tickets', [UserTicketController::class, 'index'])->name('user.tickets');
    Route::get('/my-tickets/{code}', [UserTicketController::class, 'show'])->name('user.ticket.show');

    // Profile saya
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

    // Film CRUD
    Route::resource('films', FilmController::class);
    Route::post('films/bulk-action', [FilmController::class, 'bulkAction'])->name('films.bulk');
    Route::post('films/{film}/toggle-status', [FilmController::class, 'toggleStatus'])->name('films.toggle');

    // Category CRUD
    Route::resource('categories', CategoryController::class);

    // Cinema CRUD
    Route::resource('cinemas', CinemaController::class);

    // Showtime CRUD
    Route::resource('showtimes', ShowtimeController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Tickets management
    Route::resource('tickets', TicketController::class)->only(['index', 'show', 'destroy']);
    Route::get('tickets/stats', [TicketController::class, 'stats'])->name('tickets.stats');

    // Payments management
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'show', 'update']);
});

/*
|--------------------------------------------------------------------------
| SCAN ROUTES (Public - untuk validasi tiket)
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

// Check ticket status API (public)
Route::get('/api/ticket/{code}/status', [PaymentController::class, 'checkStatus'])
    ->name('api.ticket.status');

require __DIR__ . '/auth.php';
