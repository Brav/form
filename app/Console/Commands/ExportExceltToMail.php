<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportExceltToMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export complaints for the last week';

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
        // sayali.joshi@vet.partners - used to receive emails, maybe will start in the future again
        \Mail::to(['cathy.zheng@vet.partners', 'cheryl.loredo@vet.partners',])
        ->send(new \App\Mail\SendExportedForms());
    }
}
