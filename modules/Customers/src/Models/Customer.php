<?php

namespace Modules\Customers\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Comments\src\Models\Comment;
use Modules\Reviews\src\Models\Review;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'customer_id', 'id');
    }
}
