<?php

namespace Modules\XacThuc\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailRegister;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Customers\src\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            'email' => ['required', 'email', 'unique:customers,email'],
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

        event(new Registered($customer = $this->create($request->all())));
        if ($response = $this->registered($request, $customer)) {
            return $response;
        }

        $this->resend($customer);

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath())->with('status', 'Đăng ký thành công. Vui lòng kiểm tra Email để kích hoạt tài khoản');
    }


    protected function create(array $data)
    {
        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $customer;
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }


    public function resend(Customer $customer)
    {
        $customer->sendEmailVerificationNotification();
    }
}
