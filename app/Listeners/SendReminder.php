<?php

namespace App\Listeners;

use App\Models\AutomatedResponse;
use App\Models\ClinicManagers;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReminder
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $form = $event->form;

        $autoResponse = AutomatedResponse::whereJsonContains('scenario->categories', $form->complaint_category_id)
            ->whereJsonContains('scenario->types', $form->complaint_type_id)
            ->whereJsonContains('scenario->channels', $form->complaint_channel_id)
            ->whereJsonContains('scenario->severity', $form->severity_id)
            ->first();

        if(!$autoResponse)
        {
            $autoResponse = AutomatedResponse::where('default', '=', true)->first();
        }

        $managers = User::whereIn('id', function($query) use ($form, $autoResponse){
            return $query->from('clinic_managers')->select('user_id')
                ->where('clinic_id', '=', $form->clinic_id)
                ->whereIn('manager_type_id', $autoResponse->additional_contacts ?? [])
                ->get();
        })
        ->get();

        $mailTo = array_merge($managers->pluck('email')->toArray(), $autoResponse->additional_emails ?? []);

        $mailTo = \filter_var_array($mailTo, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);

        if($mailTo)
        {
            \Mail::to()->send(new \App\Mail\SendReminder($form, $event->week));
        }

        $column = \str_replace(' ', '_', $event->week) . '_reminder';

        \DB::table('complaint_forms_reminder_sent')->insert([
            'complaint_form_id' => $form->id,
            $column             => true,
        ]);
    }
}
