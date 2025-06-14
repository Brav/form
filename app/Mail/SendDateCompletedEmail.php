<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SendDateCompletedEmail extends Mailable
{
    private $complaintForm;
    private $clinic;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($complaintForm, $clinic)
    {
        $this->complaintForm = $complaintForm;
        $this->clinic = $clinic;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from('complaintsreporting@vet.partners')
            ->subject('Complaint Report Completion')
            ->view('emails/date-completed-notification')
            ->with([
                'clinic' => $this->clinic,
                'complaintForm' => $this->complaintForm,
            ]);
    }
}
