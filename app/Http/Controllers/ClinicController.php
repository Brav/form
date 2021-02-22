<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicCreateRequest;
use App\Models\Clinic;
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
        return view('clinics/index', [
            'clinics' => Clinic::with([
                'leadVet',
                'practiseManager',
                'vetManager',
                'gmVeterinaryOptions',
                'gmRegion',
                'regionalManager',
            ])->get(),
        ]);
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
        return view('form', [
            'task'  => 'create',
            'view'  => 'clinics',
            'users' => User::all(),
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
        Clinic::create($request->all());

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
        return view('form', [
            'task'   => 'edit',
            'view'   => 'clinics',
            'users'  => User::all(),
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
        $clinic-save($request->all());

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


    }
}
