<?php

namespace App\Mail;

use App\Models\ComplaintForm;
use App\Models\Severity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToManagers extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $autoCountryEmails;

    public $autoResponse;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form, $autoCountryEmails, $autoResponse)
    {
        $this->form = $form;
        $this->autoCountryEmails = $autoCountryEmails;
        $this->autoResponse = $autoResponse;
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
                'form'              => $this->form,
                'autoCountryEmails' => $this->autoCountryEmails,
                'autoResponse' => $this->autoResponse,
                'aggressions'       => ComplaintForm::clientAggressionValues(),
            ]);
    }
}
