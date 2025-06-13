<?php

namespace App\Providers;


use App\Console\Commands\ComplaintReminder;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DateCompletedService
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $form;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($form)
    {
        $this->form = $form;
    }

    /**
     * Handle the event.
     *
     * @param   $event
     * @return void
     */
    public function handle($event): void
    {




    }

}
