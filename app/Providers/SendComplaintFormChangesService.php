<?php

namespace App\Providers;
use App\Mail\ComplaintFormChangesEmail;
use App\Mail\SendDateCompletedEmail;
use App\Models\AutomatedDateCompletedEmail;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendComplaintFormChangesService
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
        $changedFields = $event->changedFields;

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

        if($emails){
            \Mail::to(array_filter($emails))
                ->send(new ComplaintFormChangesEmail($form, $clinic, $changedFields));
        }

    }

}

