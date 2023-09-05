<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutomatedCountryEmailRequest;
use App\Models\AutomatedCountryEmail;
use Illuminate\Http\Request;

class AutomatedCountryEmailController extends Controller
{
    function index()
    {
        $responses = AutomatedCountryEmail::paginate(20);

        if(!request()->ajax())
        {
            return view('automated-country-emails/index', [
                'responses' => $responses,
            ]);
        }

        return [
            'html' => view('automated-country-emails/partials/_responses', [
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
                'view'        => 'automated-country-emails',
            ])->render(),
            200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AutomatedCountryEmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AutomatedCountryEmailRequest $request)
    {
        $data = $request->all();

        $data['body']['client'] = \strip_tags($data['body']['client'], '<p><a><bold><strong><em><i>');
        $data['body']['clinic'] = \strip_tags($data['body']['clinic'], '<p><a><bold><strong><em><i>');

        $data['emails'] ??= [];

        $response = AutomatedCountryEmail::create($data);

        return response()->json(
            view('automated-country-emails/partials/_response', [
                'response' => $response,
            ])->render()
            , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AutomatedCountryEmail $response
     * @return \Illuminate\Http\Response
     */
    public function edit(AutomatedCountryEmail $response)
    {
        return response()->json(
            view('form-ajax', [
                'task'       => 'edit',
                'view'       => 'automated-country-emails',
                'response'   => $response,
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AutomatedCountryEmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AutomatedCountryEmailRequest $request, AutomatedCountryEmail $response)
    {
        $data = $request->all();

        $data['body']['client'] = \strip_tags($data['body']['client'], '<p><a><bold><strong><em><i>');
        $data['body']['clinic'] = \strip_tags($data['body']['clinic'], '<p><a><bold><strong><em><i>');

        $data['country'] = \strtolower($data['country']);

        $response->update($data);

        return response()->json(
            view('automated-country-emails/partials/_response', [
                'response' => $response->fresh(),
            ])->render()
            , 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(AutomatedCountryEmail $response)
    {
        return view('modals/partials/_delete', [
            'id'        => $response->id,
            'routeName' => route('automated-country-emails.destroy', $response->id),
            'itemName'  => $response->country,
            'table'     => 'response',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AutomatedResponse $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(AutomatedCountryEmail $response)
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
