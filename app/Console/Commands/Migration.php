<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migration {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Migrations';

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
        $migrationsFolder = base_path('modules/' . $module . "/Migrations");
        if (!File::exists($migrationsFolder)) {
            File::makeDirectory($migrationsFolder, 755, true, true);
        }
        $name = Carbon::now()->format('Y_m_d_His_') . $name;
        if (!File::exists($migrationsFolder . "/" . $name . ".php")) {
            $migrationsFile = "app/Console/Commands/Templates/Migrations.txt";
            $migrationsContent = File::get($migrationsFile);
            $migrationsContent = str_replace("{table}", strtolower($module), $migrationsContent);
            File::put($migrationsFolder . "/" . $name . ".php", $migrationsContent);
            return $this->info('Migration Successfully created');
        } else {
            return $this->error('Migration Exists');
        }
    }
}
