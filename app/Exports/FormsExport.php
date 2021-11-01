<?php

namespace App\Exports;

use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\ComplaintForm;
use App\Models\OutcomeOptionsCategories;
use App\Models\Severity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FormsExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     $userClinics = null;

    //     if(auth()->user()->admin !== 1)
    //     {
    //         $userID  = auth()->id();
    //         $clinics = Clinic::query();

    //         foreach ($clinics as $field )
    //         {
    //             $clinics->orWhere($field, '=', $userID);
    //         }

    //         $userClinics = $clinics->get();
    //     }

    //     $forms = ComplaintForm::when(auth()->user()->admin !== 1, function($query) use($userClinics){
    //         return $query->whereIn('clinic_id', $userClinics->pluck('id')->toArray());
    //     })
    //     ->with(['clinic', 'location', 'category', 'type', 'channel'])
    //     ->get();

    //     return $forms;
    // }

    /**
     * Command Export
     *
     * @var boolean
     */
    protected $commandExport = false;

    /**
     * @param bool $commandExport
     * @return void
     */
    function __construct (bool $commandExport = false)
    {

        $this->commandExport = $commandExport;

    }

    public function view(): View
    {

        $userClinics = [];

        if(auth()->check() && !auth()->user()->admin)
        {
            $userClinics = ClinicManagers::where('user_id', '=', auth()->id())
                ->get()
                ->pluck('clinic_id')
                ->toArray();
        }

        $forms = ComplaintForm::when(!$this->commandExport && !auth()->user()->admin, function($query) use($userClinics){
            return $query->whereIn('clinic_id', $userClinics);
        })
        ->when($this->commandExport, function($query){

            $currentDate = \Carbon\Carbon::now();

            $lastFriday =  $currentDate->subDays($currentDate->dayOfWeek)->subWeek();

            return $query->whereBetween['created_at', [$lastFriday, $currentDate]];

        })
        ->with(['clinic', 'location', 'category', 'type', 'channel', 'severity'])
        ->get();

        if($this->commandExport === true)
        {
            $canEdit = true;
        }
        else
        {
            $canEdit = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('w') ? true : false;
        }

        return view('complaint-form/partials/_table', [
            'forms'          => $forms,
            'outcomeOptions' => OutcomeOptionsCategories::with(['options'])->get(),
            'export'         => true,
            'canEdit'        => $canEdit,

        ]);
    }
}
