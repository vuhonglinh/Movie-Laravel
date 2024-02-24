<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Modules\Orders\src\Models\Order;

class ApiOrderController extends Controller
{
    /**
     * Hiển thị danh sách
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->with('customers')->paginate();

        if ($orders->count() > 0) {
            $status = 200;
        } else {
            $status = 404;
        }

        return new OrderCollection($orders, $status);
    }


    /**
     * Thêm mới
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Hiển thị chi tiết 
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        if ($order) {
            $status = 200;
        } else {
            $status = 404;
        }
        return new OrderCollection($order, $status);
    }

    /**
     * Cập nhật 
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Xóa
     */
    public function destroy(string $id)
    {
        //
    }
}
