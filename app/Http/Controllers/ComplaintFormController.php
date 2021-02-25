<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('complaint-form/form', [
            'clinics'    => DB::table('clinics')->select('id', 'name')->get(),
            'categories' => ComplaintCategory::get(),
            'types'      => ComplaintType::get(),
            'channels'   => ComplaintChannel::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintForm $complaintForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintForm $complaintForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintForm $complaintForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintForm $complaintForm)
    {
        //
    }
}
