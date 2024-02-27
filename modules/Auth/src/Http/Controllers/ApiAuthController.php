<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\Users\src\Models\User;
use Illuminate\Support\Facades\Http;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        //Validation
        $this->validateLogin($request);
        $email = $request->email;
        $password = $request->password;
        //End Validation

        //Login
        $checkLogin =  Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        //End login

        //Check Login
        if ($checkLogin) {
            $user = $request->user();
            // $token = $user->createToken('user_auth_token')->plainTextToken; //Tạo token cho đăng nhập
            $token = $user->createToken('auth_api');
            $accessToken = $token->accessToken;
            $token->expires_at = Carbon::now()->addMinutes(60);
            $expires = Carbon::parse($token->expires_at)->toDateTimeString();
            $response = [
                'status' => 200,
                'accessToken' => $accessToken,
                'expires' => $expires,
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'Unauthorized'
            ];
        }
        //End check login
        return $response;
    }

    public function refreshToken(Request $request)
    {
        //Validation
        $this->validateLogin($request);
        $email = $request->email;
        $password = $request->password;
        //End Validation

        $client = Client::find(3);
        if ($client) {
            $clientSecret = $client->secret;
            $clientId = $client->id;

            //Cấp refresh token
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]);
        }
        return $response;
    }

    public function getToken(Request $request)
    {
        // $user = $request->user();
        // return $user->currentAccessToken()->delete(); //Xóa token hiện tại
        // $user->tokens()->delete();//Xóa tất cả token bên admin

        $client = Client::find(3);
        if ($client) {
            $clientSecret = $client->secret;
            $clientId = $client->id;
            $refreshToken = $request->refresh;

            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);

            return $response->json();
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->revoke(); //Xóa token
        $response = [
            'status' => 200,
            'message' => 'Logout',
        ];
        return $response;
    }



    // public function refreshToken(Request $request)//Refresh Token Sanctum
    // {
    //     if ($request->header('authorization')) { //Tồn tại token
    //         $hashToken = $request->header('authorization');
    //         $hashToken = trim(str_replace('Bearer', '', $hashToken));
    //         $token = PersonalAccessToken::findToken($hashToken); //lấy token của người đăng nhập
    //         if ($token) {
    //             $expires_at  = Carbon::parse($token->created_at)->addMinutes(config('sanctum.expiration'));
    //             if (Carbon::now() >= $expires_at) { //Nếu hết hạn
    //                 $tokenId = $token->id; //Id token
    //                 $usersId = $token->tokenable_id; //Lấy id của người đăng nhập
    //                 $user = User::find($usersId);
    //                 $user->tokens()->delete(); //Xóa tất cả các token của user này đi
    //                 $newToken = $user->createToken('user_auth_token')->plainTextToken;

    //                 $response = [
    //                     'status' => 200,
    //                     'token' => $newToken
    //                 ];
    //             } else { //Ngược lại chưa hết hạn
    //                 $response = [
    //                     'status' => 400,
    //                     'message' => 'Expires'
    //                 ];
    //             }
    //         }
    //     } else { //Không tồn tại token
    //         $response = [
    //             'status' => 400,
    //             'message' => 'Unauthorized'
    //         ];
    //     }
    //     return $response;
    // }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => __('auth::validation.required'),
            'email' => __('auth::validation.email'),
        ], __('auth::validation.attributes'));
    }
}
