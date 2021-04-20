<?php

namespace App\Listeners;

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
        $form           = $event->form;

        $complaintLevel = $form->complaintLevel();

        $roles          = Roles::where('level' , 'like', '%"' . $complaintLevel . '"%')->get();

        $users          = User::whereIn('role_id', $roles->pluck('id')->toArray())
                            ->whereIn('id', function($query) use ($form){
                                return ClinicManagers::select('user_id')
                                    ->where('clinic_id', '=', $form->clinic_id)
                                    ->get();
                            })
                            ->get();

        \Mail::to($users->pluck('email')->toArray())->send(new \App\Mail\SendReminder($form, $event->week));

        $column = \str_replace(' ', '_', $event->week) . '_reminder';

        \DB::table('complaint_forms_reminder_sent')->insert([
            'complaint_form_id' => $form->id,
            $column             => true,
        ]);
    }
}
