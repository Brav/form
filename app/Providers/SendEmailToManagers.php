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

        $additionalEmails = [];

        $form           = $event->form;

        $complaintLevel = $form->complaintLevel();

        $roles = null;

        $users = [];

        if(isset($complaintLevel['level']) && $complaintLevel['level'] === 'no_sending')
        {
            return;
        }

        if(\is_numeric($complaintLevel) )
        {
            if ($form->type->complaint_channels_settings === null)
            {
                $roles = Roles::where('level' , 'like', '%"' . $complaintLevel . '"%')->get();
            }

            if ($form->type->complaint_channels_settings !== null &&
                isset($form->type->complaint_channels_settings[$form->severity]['additional_emails']))
            {
                $emails = \explode(',', $form->type->complaint_channels_settings[$form->severity]['additional_emails']);

                $additionalEmails = \filter_var_array($emails, FILTER_VALIDATE_EMAIL);
            }
            else
            {
                if($form->channel !== null && $form->channel->additonal_emails !== null)
                {
                    $additionalEmails = \filter_var_array(\explode(',', $form->channel->additonal_emails),
                     FILTER_VALIDATE_EMAIL);
                }
            }
        }

        if($form->category->email_to_roles !== null)
        {
            $where = \filter_var_array($form->category->email_to_roles, FILTER_VALIDATE_INT);

            $roles = Roles::whereIn('id' , $where)->get();
        }

        if(optional($form->type)->complaint_channels_settings !== null)
        {
            if(isset($complaintLevel['roles']))
            {
                $roles = Roles::whereIn('id' , $complaintLevel['roles'])->get();
            }
            else
            {
                $roles = Roles::where('level' , 'like', '%"' . $complaintLevel . '"%')->get();
            }
        }

        if($form->category->additional_emails !== null)
        {
            $additionalEmails = \filter_var_array(\explode(',', $form->category->additional_emails),
                     FILTER_VALIDATE_EMAIL);
        }

        if($roles)
        {
            $users = User::whereIn('role_id', $roles->pluck('id')->toArray())
                            ->whereIn('id', function($query) use ($form){
                                return $query->from('clinic_managers')->select('user_id')
                                    ->where('clinic_id', '=', $form->clinic_id)
                                    ->get();
                            })
                            ->get();
        }

        $mailTo = array_merge(
            $users ? $users->pluck('email')->toArray() : [],
            [$form->team_member_email],
            $additionalEmails
        );

        if($mailTo)
        {
            \Mail::to($mailTo)
            ->send(new \App\Mail\SendEmailToManagers($form));
        }



    }
}
