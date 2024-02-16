<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:seeder {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Seeder';

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
        $seedersFolder = base_path('modules/' . $module . "/seeders");
        if (!File::exists($seedersFolder)) {
            File::makeDirectory($seedersFolder, 755, true, true);
        }
        if (!File::exists($seedersFolder . "/" . $name . ".php")) {
            $seedersFile = "app/Console/Commands/Templates/Seeder.txt";
            $seedersContent = File::get($seedersFile);
            $seedersContent = str_replace("{module}", $module, $seedersContent);
            $seedersContent = str_replace("{name}", $name, $seedersContent);
            File::put($seedersFolder . "/" . $name . ".php", $seedersContent);
            return $this->info('Seeder Successfully created');
        } else {
            return $this->error('Seeder Exists');
        }
    }
}
