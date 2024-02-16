<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Modules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        if (File::exists(base_path('modules/' . $name))) {
            $this->error('Modules already exists');
            return false;
        } else {
            File::makeDirectory(base_path('modules/' . $name), 755, true, true);
            //Tạo Configs
            $configForder = base_path('modules/' . $name . '/configs');
            if (!File::exists($configForder)) {
                File::makeDirectory($configForder, 755, true, true);
            }

            //Tạo Helpers
            $helperForder = base_path('modules/' . $name . '/helpers');
            if (!File::exists($helperForder)) {
                File::makeDirectory($helperForder, 755, true, true);
            }

            //Tạo Migration
            $migrationForder = base_path('modules/' . $name . '/migrations');
            if (!File::exists($migrationForder)) {
                File::makeDirectory($migrationForder, 755, true, true);
            }

            //Tạo Resources
            $resourceForder = base_path('modules/' . $name . '/resources');
            if (!File::exists($resourceForder)) {
                File::makeDirectory($resourceForder, 755, true, true);

                //Tạo Language
                $langForder = $resourceForder . '/lang';
                if (!File::exists($langForder)) {
                    File::makeDirectory($langForder, 755, true, true);
                }

                //Tạo Views
                $viewForder = $resourceForder . '/views';
                if (!File::exists($viewForder)) {
                    File::makeDirectory($viewForder, 755, true, true);
                }
            }

            //Tạo Route
            $routeForder = base_path('modules/' . $name . '/routes');
            if (!File::exists($routeForder)) {
                File::makeDirectory($routeForder, 755, true, true);

                //Tạo file web.php
                $routeWebFile = $routeForder . '/web.php';

                //Tạo file api.php
                $routeApiFile = $routeForder . '/api.php';

                $routeContent = File::get("app/Console/Commands/Templates/Route.txt");
                $routeContent = str_replace("{module}", strtolower($name), $routeContent);

                if (!File::exists($routeWebFile)) {
                    File::put($routeWebFile,  $routeContent);
                }

                if (!File::exists($routeApiFile)) {
                    File::put($routeApiFile,  $routeContent);
                }
            }

            //Tạo Src
            $srcForder = base_path('modules/' . $name . '/src');
            if (!File::exists($srcForder)) {
                File::makeDirectory($srcForder, 755, true, true);

                //Tạo file Commands
                $commandForder = $srcForder . '/Commands';
                if (!File::exists($commandForder)) {
                    File::makeDirectory($commandForder, 755, true, true);
                }


                //Tạo Http
                $httpForder = $srcForder . '/Http';
                if (!File::exists($httpForder)) {
                    File::makeDirectory($httpForder, 755, true, true);

                    //Tạo Controller
                    $controllerForder = $httpForder . '/Controllers';
                    if (!File::exists($controllerForder)) {
                        File::makeDirectory($controllerForder, 755, true, true);
                    }

                    //Tạo Middleware
                    $middlewareForder = $httpForder . '/Middlewares';
                    if (!File::exists($middlewareForder)) {
                        File::makeDirectory($middlewareForder, 755, true, true);
                    }
                }

                //Tạo Models
                $modelForder = $srcForder . '/Models';
                if (!File::exists($modelForder)) {
                    File::makeDirectory($modelForder, 755, true, true);
                }
            }

            //Tạo Repositories
            $repositoriesForder = base_path('modules/' . $name . '/src/Repositories');
            if (!File::exists($repositoriesForder)) {
                File::makeDirectory($repositoriesForder, 755, true, true);

                //Tạo Repositories
                $repositoryFile = base_path('modules/' . $name . '/src/Repositories/' . $name . 'Repository.php');
                if (!File::exists($repositoryFile)) {
                    $repositoryFileContent = file_get_contents("app/Console/Commands/Templates/ModuleRepository.txt");
                    $repositoryFileContent = str_replace("{module}", $name, $repositoryFileContent);
                    File::put($repositoryFile, $repositoryFileContent);
                }
                //Tạo RepositoriesInterface
                $repositoryInterfaceFile = base_path('modules/' . $name . '/src/Repositories/' . $name . 'RepositoryInterface.php');
                if (!File::exists($repositoryInterfaceFile)) {
                    $repositoryInterfaceFileContent = file_get_contents("app/Console/Commands/Templates/ModuleRepositoryInterface.txt");
                    $repositoryInterfaceFileContent = str_replace("{module}", $name, $repositoryInterfaceFileContent);
                    File::put($repositoryInterfaceFile, $repositoryInterfaceFileContent);
                }
            }


            $this->info('Modules Created Successfully');
        }
    }
}
