<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminder extends Mailable
{
    use Queueable, SerializesModels;

    private $form;
    private $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form, $week)
    {
        $this->form = $form;
        $this->week = $week;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('complaintsreporting@vet.partners')
            ->subject('Complaint Form Filled')
            ->view('emails/complaint-form')
            ->with([
                'form' => $this->form,
                'week' => $this->week,
            ]);
    }
}
