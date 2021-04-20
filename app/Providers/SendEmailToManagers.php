<?php

namespace App\Providers;

use App\Models\ClinicManagers;
use App\Models\Roles;
use App\Models\User;
use App\Providers\ComplaintFilled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        $form           = $event->form;

        $complaintLevel = $form->complaintLevel();

        $roles          = Roles::where('level' , 'like', '%"' . $complaintLevel . '"%')->get();

        $users          = User::whereIn('role_id', $roles->pluck('id')->toArray())
                            ->whereIn('id', function($query) use ($form){
                                return $query->from('clinic_managers')->select('user_id')
                                    ->where('clinic_id', '=', $form->clinic_id)
                                    ->get();
                            })
                            ->get();

        \Mail::to($users->pluck('email')->toArray())->send(new \App\Mail\SendEmailToManagers($form));
    }
}
