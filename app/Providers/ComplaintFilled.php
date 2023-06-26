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
    public $autoResponse;
    public $autoEmailContacts;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ComplaintForm $form, $autoResponse, $autoEmailContacts = null)
    {
        $this->form = $form;
        $this->autoResponse = $autoResponse;
        $this->autoEmailContacts = $autoEmailContacts;
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
