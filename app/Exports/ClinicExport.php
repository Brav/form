<?php

namespace App\Exports;

use App\Models\Clinic;
use App\Models\ClinicManagers;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClinicExport implements FromView
{

    public function view(): View
    {
        $query = Clinic::query();

        $managerTypes = ClinicManagers::$managerTypes;

        $query->with(['managers', 'managers.user'])
        ->when(!auth()->user()->admin, function($query){
            $userID = auth()->id();

            return $query->where('owner_id', '=', $userID)
                ->whereIn('id', function($query) use ($userID)
                {
                    return $query->select('clinic_id')
                        ->from('clinic_managers')
                        ->where('user_id', '=', $userID)
                        ->whereIn('manager_type_id', [
                            \array_search('lead_vet', ClinicManagers::$managerTypes),
                            \array_search('regional_manager', ClinicManagers::$managerTypes),
                        ]);

                });
        })->orderBy('name', 'ASC');

        $clinics = $query->withTrashed()->get();

        return view('clinics/export/clinics', [
            'clinics' => $clinics,
        ]);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
