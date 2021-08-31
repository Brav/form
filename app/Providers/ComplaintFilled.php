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
    public $additionalContacts;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ComplaintForm $form, ?array $additionalContacts)
    {
        $this->form = $form;
        $this->additionalContacts = $additionalContacts;
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
