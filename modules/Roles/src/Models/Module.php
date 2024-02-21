<?php

namespace Modules\Roles\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Users\src\Models\User;

class Module extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'module';
    protected $fillable = [
        'title',
        'name',
    ];
}