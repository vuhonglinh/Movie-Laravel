<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Comments\src\Repositories\CommentsRepository;
use Modules\Comments\src\Repositories\CommentsRepositoryInterface;
use Modules\Countries\src\Repositories\CountriesRepository;
use Modules\Countries\src\Repositories\CountriesRepositoryInterface;
use Modules\Customers\src\Repositories\CustomersRepository;
use Modules\Customers\src\Repositories\CustomersRepositoryInterface;
use Modules\Episodes\src\Repositories\EpisodesRepository;
use Modules\Episodes\src\Repositories\EpisodesRepositoryInterface;
use Modules\Genres\src\Repositories\GenresRepository;
use Modules\Genres\src\Repositories\GenresRepositoryInterface;
use Modules\Movies\src\Repositories\MoviesRepository;
use Modules\Movies\src\Repositories\MoviesRepositoryInterface;
use Modules\Orders\src\Repositories\OrdersRepository;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Packages\src\Repositories\PackagesRepository;
use Modules\Packages\src\Repositories\PackagesRepositoryInterface;
use Modules\Profile\src\Repositories\ProfileRepository;
use Modules\Profile\src\Repositories\ProfileRepositoryInterface;
use Modules\Reviews\src\Repositories\ReviewsRepository;
use Modules\Reviews\src\Repositories\ReviewsRepositoryInterface;
use Modules\Roles\src\Repositories\RolesRepository;
use Modules\Roles\src\Repositories\RolesRepositoryInterface;
use Modules\ThanhToan\src\Repositories\ThanhToanRepository;
use Modules\ThanhToan\src\Repositories\ThanhToanRepositoryInterface;
use Modules\TimKiem\src\Repositories\TimKiemRepository;
use Modules\TimKiem\src\Repositories\TimKiemRepositoryInterface;
use Modules\TrangChu\src\Repositories\TrangChuRepository;
use Modules\TrangChu\src\Repositories\TrangChuRepositoryInterface;
use Modules\Users\src\Repositories\UsersRepository;
use Modules\Users\src\Repositories\UsersRepositoryInterface;
use Modules\Vnpay\src\Repositories\VnpayRepository;
use Modules\Vnpay\src\Repositories\VnpayRepositoryInterface;
use Modules\XemPhim\src\Repositories\XemPhimRepository;
use Modules\XemPhim\src\Repositories\XemPhimRepositoryInterface;

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

        //Profile Repositories
        $this->app->singleton(
            ProfileRepositoryInterface::class,
            ProfileRepository::class,
        );

        //Roles Repositories
        $this->app->singleton(
            RolesRepositoryInterface::class,
            RolesRepository::class,
        );

        //Customers Repositories
        $this->app->singleton(
            CustomersRepositoryInterface::class,
            CustomersRepository::class,
        );

        //Customers Repositories
        $this->app->singleton(
            CommentsRepositoryInterface::class,
            CommentsRepository::class,
        );

        //Reviews Repositories
        $this->app->singleton(
            ReviewsRepositoryInterface::class,
            ReviewsRepository::class,
        );

        //Packages Repositories
        $this->app->singleton(
            PackagesRepositoryInterface::class,
            PackagesRepository::class,
        );

        //Orders Repositories
        $this->app->singleton(
            OrdersRepositoryInterface::class,
            OrdersRepository::class,
        );

        //Vnpay Repositories
        $this->app->singleton(
            VnpayRepositoryInterface::class,
            VnpayRepository::class,
        );

        ///////Client///////////
        //TrangChu Repositories
        $this->app->singleton(
            TrangChuRepositoryInterface::class,
            TrangChuRepository::class,
        );

        //XemPhim Repositories
        $this->app->singleton(
            XemPhimRepositoryInterface::class,
            XemPhimRepository::class,
        );

        //TimKiem Repositories
        $this->app->singleton(
            TimKiemRepositoryInterface::class,
            TimKiemRepository::class,
        );

        //ThanhToan Repositories
        $this->app->singleton(
            ThanhToanRepositoryInterface::class,
            ThanhToanRepository::class,
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

        Route::middleware('api')->group(function () use ($modulePath) {
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
