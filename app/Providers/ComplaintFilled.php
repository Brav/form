<?php

namespace App\Providers;

use App\Models\ComplaintForm;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ComplaintFilled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $form;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ComplaintForm $form)
    {
        $this->form = $form;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
