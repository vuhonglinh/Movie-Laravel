<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:controller {name} {module} {--api}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->argument('name');
        $module = $this->argument('module');
        $option = $this->option('api');
        if (!File::exists(base_path('modules/' . $module))) {
            $this->error("Module '{$module}'not exists");
        }

        $srcForder = base_path('modules/' . $module . '/src');
        if (File::exists($srcForder)) {
            $httpForder = $srcForder . '/Http';
            if (File::exists($httpForder)) {
                $controllerForder = $httpForder . '/Controllers';
                if (!File::exists($controllerForder . ".php")) {
                    if ($option) {
                        $controllerFile = "app/Console/Commands/Templates/ControllerApi.txt";
                    } else {
                        $controllerFile = "app/Console/Commands/Templates/Controller.txt";
                    }
                    $controllerContent = File::get($controllerFile);
                    $controllerContent = str_replace("{module}", $module, $controllerContent);
                    $controllerContent = str_replace("{name}", $name, $controllerContent);
                    File::put($controllerForder . "/" . $name . ".php", $controllerContent);
                    return $this->info('Controller Successfully created');
                } else {
                    return $this->error('Controller Exists');
                }
            } else {
                return $this->error('Http Exists');
            }
        } else {
            return $this->error('src Exists');
        }
    }
}
