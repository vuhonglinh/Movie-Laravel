<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Categories\src\Models\Category;
use Modules\Countries\src\Models\Country;
use Modules\Genres\src\Models\Genre;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->share('categories', Category::all());
        view()->share('countries', Country::all());
        view()->share('genres', Genre::all());
    }
}
