<?php

namespace Modules\Orders\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Customers\src\Models\Customer;
use Modules\Packages\src\Models\Package;

class Order extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'orders';
    protected $fillable = [
        'customer_id', //Id khách hàng
        'package_id', //Id gói
        'total_amount', //Tổng tiền thanh toán
        'expiry_date' //Ngày hết hạn
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function packages()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
