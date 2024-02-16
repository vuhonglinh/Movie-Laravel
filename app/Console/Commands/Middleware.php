<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Middleware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:middleware {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Middleware';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');
        if (!File::exists(base_path('modules/' . $module))) {
            $this->error("Module '{$module}'not exists");
        }

        $srcForder = base_path('modules/' . $module . '/src');
        if (File::exists($srcForder)) {
            $httpForder = $srcForder . '/Http';
            if (File::exists($httpForder)) {
                $middlewareForder = $httpForder . '/Middlewares';
                if (!File::exists($middlewareForder)) {
                    File::makeDirectory($middlewareForder, 755, true, true);
                }
                if (!File::exists($middlewareForder . "/" . $name . ".php")) {
                    $middlewareFile = "app/Console/Commands/Templates/Middleware.txt";
                    $middlewareContent = File::get($middlewareFile);
                    $middlewareContent = str_replace("{module}", $module, $middlewareContent);
                    $middlewareContent = str_replace("{name}", $name, $middlewareContent);
                    File::put($middlewareForder . "/" . $name . ".php", $middlewareContent);
                    return $this->info('Middleware Successfully created');
                } else {
                    return $this->error('Middleware Exists');
                }
            } else {
                return $this->error('Http Exists');
            }
        } else {
            return $this->error('src Exists');
        }
    }
}
