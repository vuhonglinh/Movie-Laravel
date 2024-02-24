<?php

namespace Modules\ThanhToan\src\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Packages\src\Models\Package;
use Modules\Vnpay\src\Repositories\VnpayRepositoryInterface;
use Nette\Utils\Random;

class ThanhToanController extends BaseController
{
    private $ordersRepo;
    private $vnpayRepo;
    public function __construct(
        OrdersRepositoryInterface $ordersRepo,
        VnpayRepositoryInterface $vnpayRepo
    ) {
        $this->ordersRepo = $ordersRepo;
        $this->vnpayRepo = $vnpayRepo;
    }

    public function cart(Package $package)
    {
        return view('thanhtoan::main', compact('package'));
    }

    public function checkout(Package $package)
    {
        $customer_id = auth('customer')->user()->id;
        //Lưu đơn hàng
        $this->ordersRepo->create([
            'customer_id' => $customer_id,
            'package_id' => $package->id,
            'total_amount' =>  $package->price,
            'expiry_date' => Carbon::now()->addDays($package->duration), //Ngày hết hạn
        ]);
        return redirect()->route('hoso.index')->with('status', 'Đăng ký gói thành công');
    }
    public function momopayPayment()
    {
    }
    public function vnpayPayment(Package $package)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('thanhtoan.vnpay.checkout', $package);
        $vnp_TmnCode = "IRCYPLAD"; //Mã website tại VNPAY 
        $vnp_HashSecret = "VNMLLBIHPEJBGHMHJVGZSJCFXHKKHACC"; //Chuỗi bí mật

        $vnp_TxnRef = 'HOTFIX ' . md5(date('d-m-Y H:i:s')); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $package->price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function checkOutVnpay(Request $request, Package $package)
    {
        if ($request->vnp_ResponseCode == 00) { //Khi thanh toán thành công
            $customer_id = auth('customer')->user()->id;
            //Lưu đơn hàng
            $order = $this->ordersRepo->create([
                'customer_id' => $customer_id,
                'package_id' => $package->id,
                'total_amount' =>  $package->price,
                'expiry_date' => Carbon::now()->addDays($package->duration), //Ngày hết hạn
            ]);

            //Lưu thanh toán vnpay
            $this->vnpayRepo->create([
                'code' => $request->vnp_BankTranNo,
                'amount' => $request->vnp_Amount,
                'bank_code' => $request->vnp_BankCode,
                'card_type' => $request->vnp_CardType,
                'order_info' => $request->vnp_OrderInfo,
                'tmn_code' => $request->vnp_TmnCode,
                'order_id' => $order->id,
            ]);

            return redirect()->route('hoso.index')->with('status', 'Thanh toán thành công');
        }
        return redirect()->route('hoso.index')->with('status', 'Thanh toán thất bại');
    }
}
