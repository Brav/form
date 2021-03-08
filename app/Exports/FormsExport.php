<?php

namespace App\Exports;

use App\Models\Clinic;
use App\Models\ComplaintForm;
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

    public function view(): View
    {

        $userClinics = null;

        if(auth()->user()->admin !== 1)
        {
            $userID  = auth()->id();
            $clinics = Clinic::query();

            foreach ($clinics as $field )
            {
                $clinics->orWhere($field, '=', $userID);
            }

            $userClinics = $clinics->get();
        }

        $forms = ComplaintForm::when(auth()->user()->admin !== 1, function($query) use($userClinics){
            return $query->whereIn('clinic_id', $userClinics->pluck('id')->toArray());
        })
        ->with(['clinic', 'location', 'category', 'type', 'channel'])
        ->get();

        return view('exports.forms', [
            'forms' => $forms,
        ]);
    }
}
