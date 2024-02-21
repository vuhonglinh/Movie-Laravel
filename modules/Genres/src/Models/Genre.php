<?php

namespace Modules\Genres\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Movies\src\Models\Movie;

class Genre extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public $table = 'genres';

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movies_genres', 'genre_id', 'movie_id');
    }
}
