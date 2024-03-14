<?php

namespace Modules\XacThuc\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Exceptions\AuthenticationException;
use Modules\Customers\src\Models\Customer;

class ApiXacThucController extends Controller
{
    public function login(Request $request)
    {
      
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => __('xacthuc::validation.required'),
            'email' => __('xacthuc::validation.email'),
        ], __('xacthuc::validation.attributes'));
    }

    public function register(Request $request)
    {
        $this->validateRegister($request);
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($customer) {
            return response()->json(['status' => 200, 'message' => 'Register successfully', 'data' => $customer]);
        }
        return response()->json(['status' => 401, 'message' => 'Unauthorized']);
    }

    protected function validateRegister(Request $request)
    {
        $request->validate([
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
    public function profile()
    {
        try {
            $customer = Auth::guard('api:customer')->user();
            return response()->json([
                'status' => 200,
                'data' => $customer
            ]);
        } catch (Exception $exception) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized']);
        }
    }
    public function logout(Request $request)
    {

    }
}
