<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintFormChangesEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $complaintForm;
    private $clinic;

    private $changedFields;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($complaintForm, $clinic, $changedFields)
    {
        $this->complaintForm = $complaintForm;
        $this->clinic = $clinic;
        $this->changedFields = $changedFields;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from('complaintsreporting@vet.partners')
            ->subject('Complaint Report Changes')
            ->view('emails/complaint_form_changes_email')
            ->with([
                'clinic' => $this->clinic,
                'complaintForm' => $this->complaintForm,
                'changedFields' => $this->changedFields,
            ]);
    }
}
