<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicCreateRequest;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\User;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Clinic::query();

        $queryData = \filter_var_array(
            \array_filter(request()->all(), function($element){
            return is_array($element);
            }), FILTER_SANITIZE_STRING
        );

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
        });

        foreach ($queryData as $data)
        {
            if(isset($data['column'], $data['search'], $data['type']))
            {
                $this->createQuery($query, $data);
            }
        }

        $clinics = $query->paginate(20);

        if(!request()->ajax())
            return view('clinics/index', [
                'clinics' => $clinics,
            ]);

        return [
            'html' => view('clinics/partials/_clinics', [
                'clinics' => $clinics,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $clinics,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'clinics',
                'container' => 'clinics-container',
                'filter'    => 'clinic-filters',
            ])->render()
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Clinic $clinic)
    {
        return view('modals/partials/_delete', [
            'id'        => $clinic->id,
            'routeName' => route('clinics.destroy', $clinic->id),
            'itemName'  => $clinic->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::when(!auth()->user()->admin, function($query){
            return $query->where('created_by', '=', auth()->id());
        })->get();

        return view('form', [
            'task'  => 'create',
            'view'  => 'clinics',
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClinicCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicCreateRequest $request)
    {
        $data = $request->all();
        $data['owner_id'] = auth()->id();

        $clinic = Clinic::create($data);

        ClinicManagers::saveManagers($clinic, $request);

        return redirect()->route('clinics.index')->with([
            'status' => [
                'message' => 'Clinic Created',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        $userID = auth()->id();



        if (!auth()->user()->admin &&
            $clinic->lead_vet != $userID &&
            $clinic->practise_manager != $userID
        ) {
            return redirect()->route('clinics.index');
        }

        $users = User::when(!auth()->user()->admin, function($query){
            return $query->where('created_by', '=', auth()->id());
        })->get();

        return view('form', [
            'task'   => 'edit',
            'view'   => 'clinics',
            'users'  => $users,
            'clinic' => $clinic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {

        $data = $request->all();
        $data['owner_id'] = auth()->id();

        $clinic->update($data);

        ClinicManagers::saveManagers($clinic, $request);

        return redirect()->route('clinics.index')->with([
            'status' => [
                'message' => 'Clinic Updated',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        $userID = auth()->id();

        if (!auth()->user()->admin &&
            $clinic->lead_vet != $userID &&
            $clinic->practise_manager != $userID
        ) {
            die;
        }

        if($clinic->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }

    /**
     * Create query for filters
     *
     * @param mixed $query
     * @param mixed $data
     * @return void
     */
    private function createQuery($query, $data) :void
    {
        switch ($data['type'])
        {
            case 'text':
                $search = \trim($data['search']);

                if(\strlen($search) > 2)
                {
                    switch ($data['column']) {
                        case 'name':
                            $query->where($data['column'], 'like', '%' . $search . '%');
                            break;
                        case 'lead_vet':
                        case 'practice_manager':
                        case 'veterinary_manager':
                        case 'gm_veterinary_operations':
                        case 'general_manager':
                        case 'regional_manager':
                        case 'gm_vet_services':
                        case 'other':
                            $userID = array_search($data['column'], ClinicManagers::$managerTypes);
                            $query->whereIn('id', function($query) use($userID, $search)
                            {
                                return $query->select('clinic_id')
                                ->from('clinic_managers')
                                ->where('manager_type_id', '=', $userID)
                                ->whereIn('user_id', function($query) use($search){
                                    $query->select('id')
                                    ->from('users')
                                    ->where('name', 'like', '%' . $search . '%');
                                });
                            });
                            break;
                    }
                }

                break;
        }

    }
}
