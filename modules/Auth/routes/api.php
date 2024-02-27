<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\ApiAuthController;
use Modules\Users\src\Models\User;

Route::prefix('api/admin')->group(function () {
       Route::post('login', [ApiAuthController::class, 'login']);

       Route::post('logout', [ApiAuthController::class, 'logout'])->middleware('auth:api');

       Route::post('token', [ApiAuthController::class, 'getToken']);


       Route::post('refresh-token', [ApiAuthController::class, 'refreshToken']);


       Route::get('passport-token', function () {
              $user = User::find(2);
              $tokenResult = $user->createToken('auth_api'); //Tạo ra token
              $accessToken = $tokenResult->accessToken; //Lấy ra access token
              //Thiết lập expires
              $token = $tokenResult->token;
              $token->expires_at = Carbon::now()->addMinutes(60); //Lấy thời gian hết hạn + 60'

              //Trả về expires 
              $expires = Carbon::parse($token->expires_at)->toDateTimeString();

              $response = [
                     'accessToken' => $accessToken,
                     'expires' => $expires,
              ];
              return $response;
       });
});
