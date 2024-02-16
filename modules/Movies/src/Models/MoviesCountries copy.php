<?php

namespace Modules\Movies\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MoviesCountries extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'movies_countries';

    protected $fillable = [
        'movie_id',
        'country_id',
    ];
}