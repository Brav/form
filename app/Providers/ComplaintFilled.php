<?php

namespace App\Providers;

use App\Models\ComplaintForm;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ComplaintFilled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $form;
    public $autoResponse;
    public $autoEmailContacts = null;
    public $autoCountryEmails;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ComplaintForm $form, $autoResponse, $autoEmailContacts, $autoCountryEmails)
    {
        $this->form = $form;
        $this->autoResponse = $autoResponse;
        $this->autoEmailContacts = $autoEmailContacts;
        $this->autoCountryEmails = $autoCountryEmails;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
