<?php

namespace Modules\Movies\src\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Categories\src\Models\Category;
use Modules\Countries\src\Models\Country;
use Modules\Episodes\src\Models\Episode;
use Modules\Genres\src\Models\Genre;

class Movie extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'movies';

    protected $fillable = [
        "thumbnail",
        "name",
        "slug",
        "description",
        "release_date",
        "directors",
        "quality",
        "trailer_url",
        "movie_url",
        'is_series',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'movies_countries', 'movie_id', 'country_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movies_categories', 'movie_id', 'category_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movies_genres', 'movie_id', 'genre_id');
    }

    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'movies_episodes',  'movie_id','episode_id');
    }
}