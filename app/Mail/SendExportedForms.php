<?php

namespace App\Mail;

use App\Exports\FormsExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendExportedForms extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $forms = Excel::download(new  FormsExport(true), 'forms.xlsx')->getFile();

        return $this->view('emails/export')
            ->subject('Weekly Complaint Forms Export')
            ->attach($forms, ['as' => 'forms.xlsx']);
    }
}
