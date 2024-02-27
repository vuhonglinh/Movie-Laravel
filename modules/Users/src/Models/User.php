<?php

namespace Modules\Users\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Modules\Roles\src\Models\Role;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    public function roles() //Liên kết role_id với roles
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
