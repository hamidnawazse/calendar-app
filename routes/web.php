<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

  // Route::get('/admin/select-dates',[AdminController::class,'showForm']);
  // Route::post('/admin/select-dates', [AdminController::class, 'store'])->name('store.blocked.dates');

Route::get('/admin/restrict-days', [AdminController::class, 'showWeekdayForm'])->name('admin.restrictDays');
Route::post('/admin/save-weekdays', [AdminController::class, 'saveWeekdays'])->name('admin.saveWeekdays');
Route::get('/user/show',[UserController::class,'showForm'])->name('user.showform');
Route::post('/user/select-date',[UserController::class,'store'])->name('store.blocked.date');