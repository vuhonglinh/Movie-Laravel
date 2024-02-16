<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Model extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:model {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Model';

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
            $modelFolder = $srcForder . "/Models";
            if (!File::exists($modelFolder)) {
                File::makeDirectory($modelFolder, 755, true, true);
            }
            if (!File::exists($modelFolder . "/" . $name . ".php")) {
                $modelsFile = "app/Console/Commands/Templates/Model.txt";
                $modelsContent = File::get($modelsFile);
                $modelsContent = str_replace("{module}", $module, $modelsContent);
                $modelsContent = str_replace("{name}", $name, $modelsContent);
                File::put($modelFolder . "/" . $name . ".php", $modelsContent);
                return $this->info('Models Successfully created');
            } else {
                return $this->error('Models Exists');
            }
        } else {
            return $this->error('Src Exists');
        }
    }
}
