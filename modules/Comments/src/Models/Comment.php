<?php

namespace Modules\Comments\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Customers\src\Models\Customer;
use Modules\Movies\src\Models\Movie;

class Comment extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'comments';
    protected $fillable = [
        'content',
        'customer_id',
        'movie_id',
        'parent_id'
    ];

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
