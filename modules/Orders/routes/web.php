<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\src\Http\Controllers\OrderController;
use Modules\Orders\src\Models\Order;

Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
       Route::get('/', [OrderController::class, 'index'])->name('index');
       Route::get('/data', [OrderController::class, 'data'])->name('data');

       Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
});
