<?php

use Illuminate\Support\Facades\Route;
use Modules\HoSo\src\Http\Controllers\HoSoController;

Route::middleware('auth:customer')->prefix('ho-so')->name('hoso.')->group(function () {
       Route::get('/', [HoSoController::class, 'index'])->name('index');

       Route::post('/savs', [HoSoController::class, 'saveInfo'])->name('saveInfo');
       Route::post('/change', [HoSoController::class, 'changePassword'])->name('changePassword');
});
