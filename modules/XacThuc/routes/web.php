<?php

use Illuminate\Support\Facades\Route;

use Modules\XacThuc\src\Http\Controllers\ForgotPasswordController;
use Modules\XacThuc\src\Http\Controllers\LoginController;
use Modules\XacThuc\src\Http\Controllers\RegisterController;
use Modules\XacThuc\src\Http\Controllers\ResetPasswordController;

Route::name('xacthuc.')->group(function () {
       Route::get('dang-nhap', [LoginController::class, 'showLoginForm'])->name('login');
       Route::post('dang-nhap', [LoginController::class, 'login']);
       Route::get('dang-xuat', [LoginController::class, 'logout'])->name('logout');

       Route::get('dang-ky', [RegisterController::class, 'showRegistrationForm'])->name('register');
       Route::post('dang-ky', [RegisterController::class, 'register']);


       Route::get('/lay-lai-mat-khau', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot');
       Route::post('/lay-lai-mat-khau', [ForgotPasswordController::class, 'sendResetLinkEmail']);

       Route::get('/doi-mat-khau/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset');
       Route::post('/doi-mat-khau', [ResetPasswordController::class, 'reset'])->name('reset.password');
});
