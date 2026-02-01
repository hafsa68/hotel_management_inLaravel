<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmenitieController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacilitieController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomNoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('facilitie', FacilitieController::class);
    Route::resource('bed', BedController::class);
    Route::resource('amenitie', AmenitieController::class);
    Route::resource('room', RoomController::class);
    Route::resource('request', BookingController::class);
    Route::resource('room_no', RoomNoController::class);
});

// Admin login and logout, registration
Route::middleware('guest:admin')->prefix('admin')->group(function () {
    Route::get('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'store']);
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::post('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'destroy'])->name('admin.logout');
    Route::view('/dashboard', 'backend.admin_dashboard');
});

// Manager login, logout, registration
Route::middleware('guest:manager')->prefix('manager')->group(function () {
    Route::get('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'create'])->name('manager.login');
    Route::post('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'store']);
});

Route::middleware('auth:manager')->prefix('manager')->group(function () {
    Route::post('logout', [App\Http\Controllers\Auth\Manager\LoginController::class, 'destroy'])->name('manager.logout');
    Route::view('/dashboard', 'backend.manager_dashboard');
});

// Status Toggles
Route::post('/amenitie/status-toggle', [AmenitieController::class, 'statusToggle'])->name('amenitie.status.toggle');
Route::post('/bed/status-toggle', [BedController::class, 'statusToggle'])->name('bed.status.toggle');
Route::post('/room/status-toggle', [RoomController::class, 'statusToggle'])->name('room.status.toggle');

// Room Number Management
Route::delete('/room-no/delete/{id}', [RoomNoController::class, 'destroy'])->name('room_no.destroy');
Route::put('/room-no/update/{id}', [RoomNoController::class, 'update'])->name('room_no.update');
Route::post('/room-no/store', [RoomNoController::class, 'store'])->name('room_no.store');
Route::get('/room-details/{room_id}', [RoomNoController::class, 'index'])->name('room_no.index');

// Frontend
Route::get('/about', function () { return view('frontend.about'); });
Route::get('/pages/home', function () { return view('frontend.pages.home'); });

/* * ==========================================
 * BOOKING SYSTEM ROUTES (Updated)
 * ==========================================
 */

// 1. Search Logic (Uses BookController)
Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/search', [BookController::class, 'search'])->name('book.search');

// 2. Storage Logic (Uses BookingController) - Matches blade form action="{{ route('bookings.store') }}"
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// 3. AJAX Logic
Route::get('/admin/get-room-count/{id}', [BookController::class, 'getRoomCount']);

// Dashboards
Route::get('/admin/dashboard', [AdminController::class, 'Admindashboard'])->name('admin.dashboard');
Route::get('/manager/dashboard', [ManagerController::class, 'ManagerDashboard'])->name('manager.dashboard');


//booking controller er route
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking-success/{id}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
// routes/web.php
Route::resource('booking', BookingController::class)->except(['create', 'store']);
// create এবং store ইতিমধ্যে আছে




// User Dashboard রাউট
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/my-bookings', [UserController::class, 'myBookings'])->name('user.bookings');
// ... ইত্যাদি
require __DIR__ . '/auth.php';

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/rooms', [FrontendController::class, 'rooms'])->name('frontend.rooms');
Route::get('/room/{id}', [FrontendController::class, 'roomDetails'])->name('frontend.room.details');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/check-availability', [FrontendController::class, 'checkAvailability'])->name('frontend.check.availability'); // এই লাইন

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

});


// Payment রাউটগুলো
// routes/web.php
Route::prefix('payment')->group(function () {
    // বুকিং ফর্ম
    Route::get('/book', [PaymentController::class, 'bookForm'])->name('payment.book.form');
    
    // বুকিং প্রসেস
    Route::post('/process', [PaymentController::class, 'processBooking'])->name('payment.process');
    
    // SSL Commerz কলব্যাক
    Route::post('/ssl/success', [PaymentController::class, 'sslSuccess'])->name('payment.ssl.success');
    Route::post('/ssl/fail', [PaymentController::class, 'sslFail'])->name('payment.ssl.fail');
    Route::post('/ssl/cancel', [PaymentController::class, 'sslCancel'])->name('payment.ssl.cancel');
    Route::post('/ssl/ipn', [PaymentController::class, 'sslIPN'])->name('payment.ssl.ipn');
    
    // স্ট্যাটাস পেজ
    Route::get('/success/{id}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/fail', [PaymentController::class, 'fail'])->name('payment.fail');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('/bank/{id}', [PaymentController::class, 'bankTransfer'])->name('payment.bank');
});

// routes/web.php
Route::post('/payment/upload-receipt', [PaymentController::class, 'uploadReceipt'])->name('payment.upload.receipt');
Route::get('/payment/retry/{id}', [PaymentController::class, 'retryPayment'])->name('payment.retry');