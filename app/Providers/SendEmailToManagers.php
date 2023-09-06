<?php

namespace App\Providers;

use App\Models\User;
use App\Providers\ComplaintFilled;
/**
 *
 * @package App\Providers
 */
class SendEmailToManagers
{
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
     * @param  ComplaintFilled  $event
     * @return void
     */
    public function handle(ComplaintFilled $event)
    {

        $form         = $event->form;
        $autoResponse = $event->autoResponse;

        $managers = User::whereIn('id', function($query) use ($form, $autoResponse){
                    return $query->from('clinic_managers')->select('user_id')
                        ->where('clinic_id', '=', $form->clinic_id)
                        ->whereIn('manager_type_id', $autoResponse->additional_contacts ?? [])
                        ->get();
                })
            ->get();

        if(!$managers)
        {
            $mailTo = false;
        }

        $mailTo = array_merge($managers->pluck('email')->toArray(), $autoResponse->additional_emails ?? []);

        $mailTo = \array_filter(\filter_var_array($mailTo, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL));

        if($event->autoEmailContacts)
        {
            \array_push($mailTo, ...\explode(',', $event->autoEmailContacts));
        }

        if($event->autoCountryEmails)
        {
            \array_push($mailTo, ...\explode(',', $event->autoCountryEmails['emails']));
        }

        // Special case when client aggression is reported
        // if($form->aggression !== null)
        // {
        //     \array_push($mailTo, ...[
        //         'shane.matthews@vetpartners.com.au',
        //         'michelle.phipps@vet.partners',
        //         'suan.wallis@vetpartners.com.au',
        //         'safety@vet.partners',
        //         'imalimalomrk@gmail.com',
        //         'Gillian.Porter@vet.partners',
        //         'tayla.hayes@vet.partners',
        //         'pippa.sicolo@vetpartners.com.au',
        //     ]);
        // }

        $mailTo = array_filter($mailTo);

        if($mailTo)
        {
            \Mail::to($mailTo)
            ->send(new \App\Mail\SendEmailToManagers($form, $event->autoCountryEmails));
        }

    }
}
