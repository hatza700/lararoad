<?php

use App\Http\Controllers\Backend\DashboardController;

/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('phan-tich-moi/{folder?}', [DashboardController::class, 'phanTichMoi'])->name('phan-tich-moi');
Route::get('ds-phan-tich', [DashboardController::class, 'dsPhanTich'])->name('ds-phan-tich');
