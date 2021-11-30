<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Cron';

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
     * @return int
     */
    public function handle()
    {
        \Mail::raw('Hello, welcome to Laravel!', function ($message) {
            $message
              ->to('sashamiljkovic984@gmail.com')
              ->subject('test');
          });
    }
}
