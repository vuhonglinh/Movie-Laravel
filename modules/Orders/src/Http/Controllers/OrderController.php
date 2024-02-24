<?php

namespace Modules\Orders\src\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Yajra\DataTables\DataTables;

class OrderController extends BaseController
{
    private $ordersRepo;
    public function __construct(OrdersRepositoryInterface $ordersRepo)
    {
        $this->ordersRepo = $ordersRepo;
    }

    public function index()
    {
        return view('orders::list');
    }


    public function data()
    {
        $orders = $this->ordersRepo->getAll();
        return DataTables::of($orders)
            ->addColumn('view', function ($order) {
                return '<a href="' . route('admin.orders.detail', $order->id) . '" class="main__table-btn main__table-btn--view open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path></svg>
            </a>';
            })
            ->editColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('total_amount', function ($order) {
                return number_format($order->total_amount, 0, '', '.') . ' VNĐ';
            })
            ->editColumn('customer_id', function ($order) {
                return  '<a href="' . route('admin.customers.edit', $order->customers->id) . '">' . $order->customers->name . '</a>';
            })
            ->rawColumns(['customer_id', 'view', 'created_at', 'total_amount'])
            ->toJson();
    }

    public function detail($id)
    {
        $order = $this->ordersRepo->find($id);
        return view('orders::detail', compact('order'));
    }
}
