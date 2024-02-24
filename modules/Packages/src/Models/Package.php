<?php

namespace Modules\Packages\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Package extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'packages';

    protected $fillable = [
        'name',
        'price',
        'duration',
        'powers',
    ];
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function orders()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
