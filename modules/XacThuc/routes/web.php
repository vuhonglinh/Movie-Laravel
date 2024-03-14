<?php

use Illuminate\Support\Facades\Route;

use Modules\XacThuc\src\Http\Controllers\ForgotPasswordController;
use Modules\XacThuc\src\Http\Controllers\LoginController;
use Modules\XacThuc\src\Http\Controllers\RegisterController;
use Modules\XacThuc\src\Http\Controllers\ResetPasswordController;
use Modules\XacThuc\src\Http\Controllers\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Modules\Customers\src\Models\Customer;

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



Route::get('/kich-hoat-tai-khoan/{id}/{hash}', function (EmailVerificationRequest $request) {
       $request->fulfill();
       return redirect('/trang-chu');
})->middleware(['auth:customer', 'signed'])->name('verification.verify');


Route::get('/dang-nhap-facebook', function () {
       return Socialite::driver('facebook')->redirect();
})->name('facebook');

Route::get('/facebook/callback', function () {
       $user = Socialite::driver('github')->user();
       // Customer::create($user);
});


Route::get('/dang-nhap-google', function () {
       return Socialite::driver('google')->redirect();
})->name('google');

Route::get('/google/callback', function () {
       $user = Socialite::driver('google')->user();
       // Customer::create($user);
});
