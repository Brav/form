<?php

namespace App\Providers;

use App\Mail\SendDateCompletedEmail;
use App\Models\AutomatedDateCompletedEmail;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendDateCompletedEmailService
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param   $event
     * @return void
     */
    public function handle($event): void
    {

        $form = $event->form;

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
       ])->find($form->clinic_id);

        $emails = $clinic->managers
            ->pluck('user.email')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $automatedEmails = AutomatedDateCompletedEmail::first();

        $mailTo = array_filter(array_merge($emails, $automatedEmails->emails));

        if($mailTo) {
            \Mail::to($mailTo)
                ->send(new SendDateCompletedEmail($form, $clinic));
        }
    }

}
