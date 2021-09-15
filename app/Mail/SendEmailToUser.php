<?php

namespace App\Mail;

use App\Models\Severity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $response;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form, $response)
    {
        $this->form     = $form;
        $this->response = $response;
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
            ->view('emails/complaint-form-user')
            ->with([
                'form'     => $this->form,
                'response' => $this->response,
            ]);
    }
}
