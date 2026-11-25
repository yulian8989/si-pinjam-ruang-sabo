<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Staff\StaffBookingController;
use App\Http\Controllers\Staff\RoomController;
use App\Http\Controllers\Staff\FacilityController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffReviewController;

use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\UserDashboardController;

// use App\Http\Controllers\User\RoomController as UserRoomController;
// Route::get('/', function () {
//     return view('layouts.master');
// });

Route::get('/', [LandingPageController::class, 'landing'])->name('landing');
Route::get('/room/{id}', [LandingPageController::class, 'show'])->name('room.detail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   

// --- GRUP ADMIN ---
// Fokus: User Management, Verifikasi Berkas/Booking, dan Reporting
Route::middleware(['auth', 'role:admin', 'is_active'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // 1. Fitur Reporting (Wajib ditaruh sebelum resource bookings)
    Route::get('/bookings/report/download', [AdminBookingController::class, 'downloadReport'])->name('bookings.report');

    // 2. Fitur Verifikasi Berkas & Booking
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'edit', 'update']);
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');

    // 3. Fitur User Management (Rute statis di atas rute {id})
    Route::get('/users/print', [UserController::class, 'print'])->name('users.print');
    Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle');
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

    // 4. Manajemen Ulasan
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

});

// --- GRUP STAFF ---
// Fokus: Manajemen Data Operasional (Ruangan & Fasilitas)
Route::middleware(['auth', 'role:staff', 'is_active'])->prefix('staff')->name('staff.')->group(function () {
    
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('rooms', RoomController::class)->except(['show']);
    Route::resource('facilities', FacilityController::class)->except(['show']);


    Route::get('/bookings', [StaffBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{id}/approve', [StaffBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [StaffBookingController::class, 'reject'])->name('bookings.reject');

    Route::get('/reviews', [StaffReviewController::class, 'index'])->name('reviews.index');
    
});

Route::middleware(['auth', 'role:user', 'is_active'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/rooms', [BookingController::class, 'index'])->name('rooms.index');

    Route::get('/bookings', [BookingController::class, 'myBookings'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');


    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}/review', [HistoryController::class, 'createReview'])->name('history.review');
    Route::post('/history/review/store', [HistoryController::class, 'storeReview'])->name('history.review.store');
    Route::get('/history/{id}/show', [HistoryController::class, 'show'])->name('history.show');

    
});


Route::middleware(['auth', 'is_active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
});