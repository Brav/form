<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutomatedResponseRequest;
use App\Models\AutomatedResponse;
use App\Models\ClinicManagers;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use App\Models\File;
use App\Models\Severity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AutomatedResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws Throwable
     */
    public function index()
    {
        $responses = AutomatedResponse::paginate(20);
        $files = File::orderBy('title', 'ASC')->get();

        if (!request()->ajax()) {
            return view('automated-response/index', [
                'responses' => $responses,
                'files'     => $files,
            ]);
        }

        return [
            'html'       => view('automated-response/partials/_responses', [
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
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Response
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
                'severities' => Severity::get(),
                'managers'   => ClinicManagers::$managersLabel,
            ])->render(),
            200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\AutomatedResponseRequest $request
     * @return Response
     */
    public function store(AutomatedResponseRequest $request)
    {
        $data = $request->all();

        $data['scenario'] = AutomatedResponse::scenario($request);
        $data['response'] = \trim(\strip_tags($data['response'], '<br><p><em><strong><a>'));
        $data['default'] = \filter_var($request->default, \FILTER_VALIDATE_BOOLEAN);
        $data['additional_emails'] = AutomatedResponse::additionalEmails($request->additional_emails);

        $response = AutomatedResponse::create($data);

        return response()->json(
              view('automated-response/partials/_response', [
                  'response' => $response,
              ])->render()
            , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AutomatedResponse $response
     * @return Response
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
                  'severities' => Severity::get(),
                  'managers'   => ClinicManagers::$managersLabel,
              ])->render()
            , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\AutomatedResponseRequest $request
     * @return Response
     */
    public function update(AutomatedResponseRequest $request, AutomatedResponse $response)
    {
        $data = $request->all();

        $data['scenario'] = AutomatedResponse::scenario($request);
        $data['response'] = \trim(\strip_tags($data['response'], '<br><p><em><strong><a>'));
        $data['default'] = \filter_var($request->default, \FILTER_VALIDATE_BOOLEAN);
        $data['additional_emails'] = AutomatedResponse::additionalEmails($request->additional_emails);

        $response->update($data);

        return response()->json(
              view('automated-response/partials/_response', [
                  'response' => $response,
              ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AutomatedResponse $response
     * @return Response
     */
    public function destroy(AutomatedResponse $response)
    {
        if ($response->delete())
            return response()->json([
                                        'Deleted'
                                    ], 200);

        return response()->json([
                                    'Something went wrong!'
                                ], 500);
    }

}
