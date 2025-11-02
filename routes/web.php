<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;


Route::get('/patient/booking', [BookingController::class, 'create'])->name('patient.booking');
Route::post('/patient/booking', [BookingController::class, 'store'])->name('bookings.store');

// Fixed: Use the BookingController to provide $bookings data to the view
Route::get('/doctor/appointment', [BookingController::class, 'index'])->name('doctor.appointment');
Route::post('/doctor/accept/{id}', [BookingController::class, 'accept'])->name('bookings.accept');
Route::post('/doctor/decline/{id}', [BookingController::class, 'decline'])->name('bookings.decline');

Route::get('/admin/edit', [AdminController::class, 'index'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

//fn
Route::get('/fn/doctor/appointment', function () {
    return view('fn.doctor.appointment');
})->name('fn.doctor.appointment');

Route::get('/fn/admin/booking', function () {
    return view('fn.admin.booking');
})->name('fn.admin.booking');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/trial', function () {
    return view('trial');
})->name('trial');

Route::get('/dashboard2', function () {
    return view('dashboard2');
})->name('dashboard2');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

//The three views
Route::get('/user/information', function () {
    return view('user.information');
})->name('user.information');

Route::get('/user/introduction', function () {
    return view('user.introduction');
})->name('user.introduction');

Route::get('/user/login', function () {
    return view('user.login');
})->name('user.login');

Route::get('/user/booking', function () {
    return view('user.booking');
})->name('user.booking');

Route::get('/admin/booking', function () {
    return view('admin.booking');
})->name('admin.booking');

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');

//admin
Route::get('/admin', [AppointmentController::class, 'adminIndex'])->name('admin.index');
Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::patch('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');    

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});