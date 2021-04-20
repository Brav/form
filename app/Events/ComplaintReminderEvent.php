<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ComplaintReminderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $form;
    public $week;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($form, $week)
    {
        $this->form = $form;
        $this->week = $week;
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
