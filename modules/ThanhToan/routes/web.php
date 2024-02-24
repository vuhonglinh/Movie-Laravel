<?php

use Illuminate\Support\Facades\Route;
use Modules\ThanhToan\src\Http\Controllers\ThanhToanController;

Route::middleware('auth:customer')->prefix('thanh-toan')->name('thanhtoan.')->group(function () {
       Route::post('/vnpay/{package}', [ThanhToanController::class, 'vnpayPayment'])->name('vnpay.payment');
       Route::get('/checkOutVnpay/{package}', [ThanhToanController::class, 'checkOutVnpay'])->name('vnpay.checkout');

       Route::post('/momopay', [ThanhToanController::class, 'momopayPayment'])->name('momopay.payment');
       Route::get('/{package}', [ThanhToanController::class, 'cart'])->name('cart');



       Route::get('/checkout/{package}', [ThanhToanController::class, 'checkout'])->name('checkout');
});
