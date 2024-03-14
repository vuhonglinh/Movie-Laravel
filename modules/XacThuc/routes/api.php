<?php

use Illuminate\Support\Facades\Route;
use Modules\XacThuc\src\Http\Controllers\ApiXacThucController;

Route::post('/api/login', [ApiXacThucController::class, 'login']);
Route::get('/api/profile', [ApiXacThucController::class, 'profile'])->middleware('auth:api:customer');


Route::post('/api/register', [ApiXacThucController::class, 'register']);

Route::post('/api/logout', [ApiXacThucController::class, 'logout'])->middleware('auth:api:customer');
