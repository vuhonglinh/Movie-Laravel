<?php

namespace Modules\Roles\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Users\src\Models\User;

class Role extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'roles';
    protected $fillable = [
        'name',
        'description',
        'permissions',
        'user_id',
    ];

    public function users()//Liên kết user_id với users
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
