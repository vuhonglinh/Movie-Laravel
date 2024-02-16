<?php


use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\ForgotPasswordController;
use Modules\Auth\src\Http\Controllers\LoginController;
use Modules\Auth\src\Http\Controllers\ResetPasswordController;

Route::prefix('admin')->name('admin.')->group(function () {
       // Auth::routes();
       Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
       Route::post('/login', [LoginController::class, 'login']);
       Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
       Route::get('/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot');
       Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
       Route::get('/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset');
       Route::post('/reset', [ResetPasswordController::class, 'reset'])->name("update.password");
});
