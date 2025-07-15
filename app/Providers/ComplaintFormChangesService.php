<?php

namespace App\Providers;

use App\Models\ComplaintForm;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\ServiceProvider;

class ComplaintFormChangesService
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $changedFields;
    public ComplaintForm $form;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($changedFields, $form)
    {
        $this->changedFields = $changedFields;
        $this->form = $form;
    }

    /**
     * Handle the event.
     *
     * @param   $event
     * @return void
     */
    public function handle($event): void
    {}
}
