<?php

namespace Modules\Movies\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MoviesCategories extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'categories';


    public function categories()
    {
        return $this->belongsToMany(Movie::class, 'movies_categories', 'movie_id', 'category_id');
    }
}
