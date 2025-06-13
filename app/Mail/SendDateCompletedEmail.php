<?php

namespace App\Mail;

use App\Models\AutomatedDateCompletedEmail;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use Illuminate\Mail\Mailable;

class SendDateCompletedEmail extends Mailable
{
    private $complaintForm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($complaintForm)
    {
        $this->complaintForm = $complaintForm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $clinic = Clinic::with([
           'managers' => function ($query) {
               return $query->whereIn('manager_type_id',
                                      [
                                          ClinicManagers::managerID('veterinary_manager'),

                                      ]);
           },
           'managers.user' => function ($query) {
               $query->select('id', 'email');
           }
       ])->find($this->complaintForm->clinic_id);


        $emails = $clinic->managers
            ->pluck('user.email')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $automatedEmails = AutomatedDateCompletedEmail::first();

        $sendTo = array_merge($emails, $automatedEmails->emails);

        $form = $this->from('complaintsreporting@vet.partners')
            ->subject('Complaint Report Completion')
            ->view('emails/date-completed-notification')
            ->with([
                'clinic' => $clinic,
                'complaintForm' => $this->complaintForm,
            ]);

        \Mail::to($sendTo)->send($form);
    }
}
