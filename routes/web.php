<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminUserManagement;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/users', [AdminUserManagement::class, 'index'])->name('admin.users.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index1'])->name('home');
