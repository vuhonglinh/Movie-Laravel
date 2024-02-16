<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Seeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:seeding {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database Seeding';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');
        $namespace = "Modules\\{$module}\\seeders\\{$name}";
        $this->call('db:seed', ['class' => $namespace]);
    }
}
