<?php

namespace Modules\XacThuc\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Customers\src\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/dang-nhap';

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('xacthuc::register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:customers'],
            'password' => ['required', 'min:5'],
        ], [
            'required' => ':attribute không được để trống',
            'min' => ':attribute tối thiểu :min ký tự',
            'email' => ':attribute không đúng định dạng Email',
            'unique' => ':attribute đã tồn tại',
        ], [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        $sql = $this->resend($user);
        dd($sql);
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath())->with('status', 'Đăng ký thành công. Vui lòng kiểm tra Email để kích hoạt tài khoản');
    }


    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }
}
