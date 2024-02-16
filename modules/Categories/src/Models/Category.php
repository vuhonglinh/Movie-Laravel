<?php

namespace Modules\Categories\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
}
