<?php

namespace Modules\HoSo\src\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Modules\Customers\src\Repositories\CustomersRepositoryInterface;
use Modules\HoSo\src\Http\Requests\ChangePasswordRequest;
use Modules\HoSo\src\Http\Requests\HoSoRequest;

class HoSoController extends BaseController
{
    private $customersRepo;
    public function __construct(CustomersRepositoryInterface $customersRepo)
    {
        $this->customersRepo = $customersRepo;
    }

    public function index()
    {
        $customer = auth()->user();
        $orders = $customer->orders;
        return view('hoso::main', compact('orders'));
    }

    public function saveInfo(HoSoRequest $request)
    {
        $id = auth()->user()->id;
        $this->customersRepo->update($id, $request->except('_token'));
        return back()->with('status', __('hoso::messages.update.success'));
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $id = auth()->user()->id;
        $this->customersRepo->update($id, [
            'password' => Hash::make($request->confirmpass),
        ]);
        return back()->with('status', __('hoso::messages.change.password'));
    }
}
