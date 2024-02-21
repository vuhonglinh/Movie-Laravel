<?php

namespace Modules\Reviews\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Customers\src\Models\Customer;

class Review extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'reviews';

    protected $fillable = [
        'content',
        'star',
        'movie_id',
        'customer_id',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
