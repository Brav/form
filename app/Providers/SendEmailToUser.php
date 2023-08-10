<?php

namespace App\Providers;

use App\Providers\ComplaintFilled;
/**
 *
 * @package App\Providers
 */
class SendEmailToUser
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

        \Mail::to($form->team_member_email)
        ->send(new \App\Mail\SendEmailToUser($form, $autoResponse, $event->autoCountryEmails));
    }
}
