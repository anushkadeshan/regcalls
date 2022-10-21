<?php

namespace App\Console\Commands;

use PDO;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class RegcallsStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regcalls:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial Set up of the project';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //create database template
        if ($this->confirm('All the data will be reset to defaults. Do you wish to continue?')) {
            $hasDb = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'regcalls_g0000'");
            if(empty($hasDb)) {
                DB::statement("CREATE DATABASE regcalls_g0000 CHARACTER SET 'utf8mb4' ");
                $this->info("Database Created Successfully");
            }
            else {
                $this->warn("Database already exists");
            }

            Artisan::call('migrate:fresh --seed');
            $this->info('Regcalls Defaults has been initialized.');

        }
    }
}
