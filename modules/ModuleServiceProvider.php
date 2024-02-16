<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Countries\src\Repositories\CountriesRepository;
use Modules\Countries\src\Repositories\CountriesRepositoryInterface;
use Modules\Episodes\src\Repositories\EpisodesRepository;
use Modules\Episodes\src\Repositories\EpisodesRepositoryInterface;
use Modules\Genres\src\Repositories\GenresRepository;
use Modules\Genres\src\Repositories\GenresRepositoryInterface;
use Modules\Movies\src\Repositories\MoviesRepository;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Modules\Users\src\Repositories\UsersRepository;
use Modules\Users\src\Repositories\UsersRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    private $middlewares = [];
    private $commands = [];


    public function boot()
    {
        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerModule($module);
            }
        }
    }

    public function bindingRepository()
    {
        //Categories Repositories
        $this->app->singleton(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class,
        );

        //Countries Repositories
        $this->app->singleton(
            CountriesRepositoryInterface::class,
            CountriesRepository::class,
        );

        //Movies Repositories
        $this->app->singleton(
            MoviesRepositoryInterface::class,
            MoviesRepository::class,
        );

        //Genres Repositories
        $this->app->singleton(
            GenresRepositoryInterface::class,
            GenresRepository::class,
        );

        //Episodes Repositories
        $this->app->singleton(
            EpisodesRepositoryInterface::class,
            EpisodesRepository::class,
        );

        //Users Repositories
        $this->app->singleton(
            UsersRepositoryInterface::class,
            UsersRepository::class,
        );
    }

    public function register()
    {
        //Configs 
        $directories = $this->getModules();
        if (!empty($directories)) {
            foreach ($directories as $config) {
                $this->registerConfig($config);
            }
        }

        //Middleware
        $this->registerMiddleware();

        // Khai báo commands
        $this->commands($this->commands);

        //Khai báo repositories
        $this->bindingRepository();
    }

    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }
    public function registerConfig($module) //RegisterConfig
    {
        $configPath = __DIR__ . "/" . $module . "/configs";
        if (File::exists($configPath)) {
            $configFiles = array_map('basename', File::files($configPath));
            foreach ($configFiles as $configFile) {
                $alias = basename($configFile, '.php');
                $this->mergeConfigFrom($configPath . "/" . $configFile, $alias);
            }
        }
    }
    private function registerMiddleware() //RegisterMiddleware
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
    private function registerModule($module) //Register Modules
    {
        $modulePath = __DIR__ . "/" . $module;


        Route::middleware('web')->group(function () use ($modulePath) {
            if (File::exists($modulePath . "/routes/web.php")) { //Khai báo Routes
                $this->loadRoutesFrom($modulePath . "/routes/web.php");
            }
        });

        Route::middleware('web')->group(function () use ($modulePath) {
            if (File::exists($modulePath . "/routes/api.php")) { //Khai báo Api
                $this->loadRoutesFrom($modulePath . "/routes/api.php");
            }
        });

        if (File::exists($modulePath . "/migrations")) { //Khai báo Migrations
            $this->loadMigrationsFrom($modulePath . "/migrations");
        }

        if (File::exists($modulePath . "/resources/lang")) {
            $this->loadTranslationsFrom($modulePath . "/resources/lang", strtolower($module)); //Khai báo Language
            $this->loadJsonTranslationsFrom($modulePath . "/resources/lang"); //Khai báo LanguageJsons
        }

        if (File::exists($modulePath . "/resources/views")) { //Khai báo Views
            $this->loadViewsFrom($modulePath . "/resources/views/", strtolower($module));
        }



        if (File::exists($modulePath . "/helpers")) { //Khai báo Views
            $helpers = File::allFiles($modulePath . "/helpers");
            if (!empty($helpers)) {
                foreach ($helpers as $helper) {
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }
    }
}
