<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestrictedWeekdayController;
use App\Http\Controllers\DateSelectionController;
use App\Http\Controllers\OrderRecordController;

Route::get('/', function () {
    return view('welcome');
});

  // Route::get('/admin/select-dates',[AdminController::class,'showForm']);
  // Route::post('/admin/select-dates', [AdminController::class, 'store'])->name('store.blocked.dates');

Route::get('/admin/show', [RestrictedWeekdayController::class, 'show'])->name('admin.show');
Route::post('/admin/store', [RestrictedWeekdayController::class, 'store'])->name('admin.store');
Route::get('/user/show',[DateSelectionController::class,'show'])->name('user.show');
Route::post('/user/select-date',[DateSelectionController::class,'store'])->name('store.blocked.date');

// To Show number of orders 
Route::get('/admin/order/show',[OrderRecordController::class,'show'])->name('admin.order.show');
// To store the number of orders
Route::post('admin/order/store',[OrderRecordController::class,'store'])->name('amdin.order.store');
