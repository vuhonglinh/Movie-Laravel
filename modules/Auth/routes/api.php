<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\ApiAuthController;
use Modules\Users\src\Models\User;

Route::prefix('api/admin')->group(function () {
       Route::post('login', [ApiAuthController::class, 'login']);

       Route::post('logout', [ApiAuthController::class, 'logout'])->middleware('auth:api');

       Route::get('profile', [ApiAuthController::class, 'profile'])->middleware('auth:api');

       Route::post('token', [ApiAuthController::class, 'getToken']);

       Route::post('refresh-token', [ApiAuthController::class, 'refreshToken']);
});
