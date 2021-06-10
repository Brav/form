<?php

namespace App\Providers;

use App\Models\Roles;
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

        $form           = $event->form;

        $complaintLevel = $form->complaintLevel();

        if($complaintLevel['level'] === 'no_sending')
        {
            return;
        }

        if(\is_numeric($complaintLevel) && $form->type->complaint_channels_settings === null)
        {
            $roles = Roles::where('level' , 'like', '%"' . $complaintLevel . '"%')->get();
        }

        if($form->type->complaint_channels_settings !== null)
        {
            if(isset($complaintLevel['roles']))
            {
                $roles = Roles::whereIn('id' , $complaintLevel['roles'])->get();
            }
            else
            {
                $roles = Roles::where('level' , 'like', '%"' . $complaintLevel['level'] . '"%')->get();
            }
        }

        $users = User::whereIn('role_id', $roles->pluck('id')->toArray())
                            ->whereIn('id', function($query) use ($form){
                                return $query->from('clinic_managers')->select('user_id')
                                    ->where('clinic_id', '=', $form->clinic_id)
                                    ->get();
                            })
                            ->get();

        \Mail::to(array_merge($users->pluck('email')->toArray(), [$form->team_member_email]))
            ->send(new \App\Mail\SendEmailToManagers($form));
    }
}
