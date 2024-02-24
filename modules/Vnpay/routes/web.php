<?php

use Illuminate\Support\Facades\Route;
use Modules\Vnpay\src\Http\Controllers\VnpayController;

Route::prefix('admin/vnpay')->name('admin.vnpay.')->group(function () {
       Route::get('/', [VnpayController::class, 'index'])->name('index');
       Route::get('/data', [VnpayController::class, 'data'])->name('data');
});
