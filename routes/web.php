<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk halaman depan (Dashboard Utama)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk registrasi
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Route untuk login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Route untuk reset password
Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// Route untuk kontak
Route::get('/contact', function () {
    return view('user.contact');
})->name('user.contact');

// Route untuk logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Rute untuk mengelola events
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/admin/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/admin/events', [ReportController::class, 'index'])->name('admin.events.index');
    Route::get('/admin/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/admin/events/{id}', [EventController::class, 'update'])->name('admin.events.update');
    Route::get('/admin/events/{id}/participants', [EventController::class, 'participants'])->name('admin.events.participants');
    Route::delete('/admin/events/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');

    Route::get('admin/events/{id}/attendees', [EventController::class, 'viewAttendees'])->name('admin.events.attendees');
    Route::delete('/admin/events/attendees/{id}', [EventController::class, 'destroyAttendee'])->name('admin.events.attendees.destroy');




    // Rute untuk laporan events
    Route::get('/admin/events/report', [ReportController::class, 'report'])->name('admin.events.report');
    Route::get('/admin/events/report/pdf', [ReportController::class, 'generatePdf'])->name('admin.events.report.pdf');
    Route::get('/admin/events/report/{id}', [ReportController::class, 'eventReport'])->name('admin.events.report.event');
    Route::get('/admin/events/report/{id}/pdf', [ReportController::class, 'eventReportPdf'])->name('admin.events.report.event.pdf');
});

// Rute untuk pengguna
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/events/search', [DashboardController::class, 'search'])->name('events.search');


    Route::get('/events/{id}', [EventController::class, 'showDetailEvent'])->name('events.show');

    Route::post('/events/register', [EventController::class, 'register'])->name('events.register');
    Route::post('/events/cancel-registration', [EventController::class, 'cancelRegistration'])->name('events.cancelRegistration');

    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.myEvents');
    Route::get('/my-events/{id}/', [EventController::class, 'detailMyEvent'])->name('events.detail_myevents');
});
