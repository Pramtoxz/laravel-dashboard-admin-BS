<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\PelangganController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\CustomerController;

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'FormLogin'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'Login'])->name('login.proses');
    
});


Route::middleware('auth')->group(function(){
    Route::get('/', function () {
    return view('admin.dashboard'); 
    })->name('dashboard');
    
    Route::post('/logout', [AuthController::class , 'Logout'])->name('logout');
    Route::resource('customer', CustomerController::class)->only(['index', 'show']);
    Route::post('/customer/{id}/verify', [CustomerController::class, 'verify'])->name('customer.verify');
    Route::resource('mobil', \App\Http\Controllers\web\MobilController::class);
    
    // Booking routes
    Route::resource('booking', \App\Http\Controllers\web\BookingController::class)->only(['index', 'show']);
    Route::post('/booking/{id}/verify-payment', [\App\Http\Controllers\web\BookingController::class, 'verifyPayment'])->name('booking.verify-payment');
    Route::post('/booking/{id}/check-in', [\App\Http\Controllers\web\BookingController::class, 'checkIn'])->name('booking.check-in');
    Route::post('/booking/{id}/complete', [\App\Http\Controllers\web\BookingController::class, 'complete'])->name('booking.complete');
});
