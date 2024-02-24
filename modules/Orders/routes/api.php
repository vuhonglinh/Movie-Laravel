<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\src\Http\Controllers\ApiOrderController;

Route::apiResource('api/admin/orders', ApiOrderController::class);
