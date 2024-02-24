<?php

namespace Modules\Episodes\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Movies\src\Models\Movie;

class Episode extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table = 'episodes';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'number',
        'movie_url',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movies_episodes', 'episode_id', 'movie_id');
    }
}
