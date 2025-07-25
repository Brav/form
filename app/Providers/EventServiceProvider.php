<?php

namespace App\Providers;

use App\Events\ComplaintReminderEvent;
use App\Listeners\SendReminder;
use App\Mail\SendDateCompletedEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ComplaintFilled::class => [
            SendEmailToManagers::class,
            SendEmailToUser::class,
        ],

        ComplaintReminderEvent::class => [
            SendReminder::class
        ],

        DateCompletedService::class => [
            SendDateCompletedEmailService::class
        ],

        ComplaintFormChangesService::class => [
            SendComplaintFormChangesService::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
