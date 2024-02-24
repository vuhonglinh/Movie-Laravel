<?php

namespace Modules\Vnpay\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vnpay extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'vnpay';

    protected $fillable = [
        'code',
        'amount',
        'bank_code',
        'card_type',
        'order_info',
        'tmn_code',
        'order_id',
    ];
}
