<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Request extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:request {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Request';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');
        if (!File::exists(base_path('modules/' . $module))) {
            $this->error("Module '{$module}' not exists");
        }

        $srcForder = base_path('modules/' . $module . '/src');
        if (File::exists($srcForder)) {
            $httpForder = $srcForder . '/Http';
            if (File::exists($httpForder)) {
                $requestsForder = $httpForder . '/Requests';
                if (!File::exists($requestsForder)) {
                    File::makeDirectory($requestsForder, 755, true, true);
                }
                if (!File::exists($requestsForder . "/" . $name . ".php")) {
                    $requestsFile = "app/Console/Commands/Templates/Requests.txt";
                    $requestsContent = File::get($requestsFile);
                    $requestsContent = str_replace("{module}", $module, $requestsContent);
                    $requestsContent = str_replace("{name}", $name, $requestsContent);
                    File::put($requestsForder . "/" . $name . ".php", $requestsContent);
                    return $this->info('Requests Successfully created');
                } else {
                    return $this->error('Requests Exists');
                }
            } else {
                return $this->error('Http Exists');
            }
        } else {
            return $this->error('src Exists');
        }
    }
}
