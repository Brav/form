<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutomatedResponseRequest;
use App\Models\AutomatedResponse;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use App\Models\Severity;
use Illuminate\Http\Request;

class AutomatedResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('automated-response/index', [
            'responses' => AutomatedResponse::paginate(20),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(AutomatedResponse $response)
    {
        return view('modals/partials/_delete', [
            'id'        => $response->id,
            'routeName' => route('automated-response.destroy', $response->id),
            'itemName'  => $response->name,
            'table'     => 'response',
        ]);
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
                'task'       => 'create',
                'view'       => 'automated-response',
                'categories' => ComplaintCategory::all(),
                'types'      => ComplaintType::all(),
                'channels'   => ComplaintChannel::all(),
                'severities' => Severity::SEVERITIES,
            ])->render(),
            200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AutomatedResponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AutomatedResponseRequest $request)
    {
        $data = $request->all();

        $data['scenario'] = AutomatedResponse::scenario($request);

        $response = AutomatedResponse::create($data);

        return response()->json(
            view('automated-response/partials/_response', [
                'response' => $response,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AutomatedResponse $response
     * @return \Illuminate\Http\Response
     */
    public function edit(AutomatedResponse $response)
    {
        return response()->json(
            view('form-ajax', [
                'task'       => 'edit',
                'view'       => 'automated-response',
                'response'   => $response,
                'categories' => ComplaintCategory::all(),
                'types'      => ComplaintType::all(),
                'channels'   => ComplaintChannel::all(),
                'severities' => Severity::SEVERITIES,
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AutomatedResponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AutomatedResponseRequest $request)
    {
        $data = $request->all();

        $data['scenario'] = AutomatedResponse::scenario($request);

        $response = AutomatedResponse::create($data);

        return response()->json(
            view('automated-response/partials/_response', [
                'response' => $response,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AutomatedResponse $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(AutomatedResponse $response)
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