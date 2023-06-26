<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutomatedEmailContactsRequest;
use App\Models\AutomatedEmailContacts;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use App\Models\Severity;
use Illuminate\Http\Request;

class AutomatedEmailContactsController extends Controller
{

    function index()
    {
        $responses = AutomatedEmailContacts::paginate(20);

        if(!request()->ajax())
        {
            return view('automated-email-contacts/index', [
                'responses' => $responses,
            ]);
        }

        return [
            'html' => view('automated-email-contacts/partials/_responses', [
                'responses' => $responses,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $responses,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'responses',
                'container' => 'responses-container',
            ])->render()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(
            view('form-ajax', [
                'task'        => 'create',
                'view'        => 'automated-email-contacts',
                'categories'  => ComplaintCategory::all(),
                'types'       => ComplaintType::all(),
                'channels'    => ComplaintChannel::all(),
                'severities'  => Severity::get(),
                'aggressions' => ComplaintForm::clientAggressionValues(),
            ])->render(),
            200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AutomatedEmailContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AutomatedEmailContactsRequest $request)
    {
        $data = $request->all();

        $data['scenario'] = AutomatedEmailContacts::scenario($request);
        $data['contacts'] = AutomatedEmailContacts::contacts($request->contacts);

        $response = AutomatedEmailContacts::create($data);

        return response()->json(
            view('automated-email-contacts/partials/_response', [
                'response' => $response,
            ])->render()
            , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AutomatedEmailContacts $response
     * @return \Illuminate\Http\Response
     */
    public function edit(AutomatedEmailContacts $response)
    {
        return response()->json(
            view('form-ajax', [
                'task'       => 'edit',
                'view'       => 'automated-email-contacts',
                'response'   => $response,
                'categories' => ComplaintCategory::all(),
                'types'      => ComplaintType::all(),
                'channels'   => ComplaintChannel::all(),
                'severities' => Severity::get(),
                'aggressions' => ComplaintForm::clientAggressionValues(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AutomatedEmailContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AutomatedEmailContactsRequest $request, AutomatedEmailContacts $response)
    {
        $data = $request->all();

        $data['scenario'] = AutomatedEmailContacts::scenario($request);
        $data['contacts'] = AutomatedEmailContacts::contacts($request->contacts);

        $response->update($data);

        return response()->json(
            view('automated-email-contacts/partials/_response', [
                'response' => $response->fresh(),
            ])->render()
            , 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(AutomatedEmailContacts $response)
    {
        return view('modals/partials/_delete', [
            'id'        => $response->id,
            'routeName' => route('automated-email-contacts.destroy', $response->id),
            'itemName'  => $response->name,
            'table'     => 'response',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AutomatedResponse $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(AutomatedEmailContacts $response)
    {
        if($response->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }


}
