<?php

namespace App\Console\Commands;

use App\Events\ComplaintReminderEvent;
use App\Models\ComplaintForm;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 *
 * @package App\Console\Commands
 */
class ComplaintReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the reminder to the managers to complete the complaint outcome';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $twoWeeksAgo = Carbon::now()->subDays(14);
        $oneWeekAgo  = Carbon::now()->subDays(7);

        $formsOneWeek = ComplaintForm::whereBetween('created_at', [$twoWeeksAgo, $oneWeekAgo])
            ->whereNotIn('id', function($query){
                return $query->select('complaint_form_id')
                    ->from('complaint_forms_reminder_sent')
                    ->whereNotNull('one_week_reminder');
                })
            ->whereNotNull('outcome_options')
            ->get();

        foreach ($formsOneWeek as $form)
        {
            ComplaintReminderEvent::dispatch($form, 'one week');
        }

        $formsTwoWeeks = ComplaintForm::whereDate('created_at', '<', $twoWeeksAgo)
            ->whereNotIn('id', function($query){
                return $query->select('complaint_form_id')
                    ->from('complaint_forms_reminder_sent')
                    ->whereNotNull('two_weeks_reminder');
                })
            ->whereNotNull('outcome_options')
            ->get();

        foreach ($formsTwoWeeks as $form)
        {
            ComplaintReminderEvent::dispatch($form, 'two weeks');
        }
    }

}
