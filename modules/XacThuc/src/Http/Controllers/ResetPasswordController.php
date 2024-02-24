<?php

namespace Modules\XacThuc\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/trang-chu';

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('xacthuc::reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
            'password_confirmation' => 'same:password',
        ], [
            'required' => ':attribute không được để trống',
            'email' => ':attribute không đúng định dạng',
            'same' => ':attribute không chính xác',
            'min' => ':attribute tối thiểu :min ký tự',
        ], [
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Xác nhận lại mật khẩu'
        ]);

        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return new JsonResponse(['message' => trans($response)], 200);
        }

        return redirect($this->redirectTo)
            ->with('status', 'Thay đổi mật khẩu thành công');
    }

    public function broker()
    {
        return Password::broker('customers');
    }


    protected function guard()
    {
        return Auth::guard('customer');
    }
}
