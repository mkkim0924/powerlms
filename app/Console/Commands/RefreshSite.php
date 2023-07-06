<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will refresh website database and seed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        shell_exec('rm -rf storage/framework/sessions/*');
        shell_exec('git stash');
        shell_exec('git clean -fd');
//        shell_exec('sudo chmod -R 777 public');
//        shell_exec('sudo chmod -Rf 777 storage');
//        shell_exec('sudo chmod -Rf 777 resources/lang');
//        shell_exec('sudo chmod -R 777 bootstrap');
        shell_exec('sudo chown -R www-data:www-data public');

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        Artisan::call('db:seed',['--class'=>'DummyDataSeeder']);
    }
}
