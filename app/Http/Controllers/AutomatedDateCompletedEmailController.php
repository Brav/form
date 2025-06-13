<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutomatedDateCompletedEmailRequest;
use App\Models\AutomatedDateCompletedEmail;
use App\Models\AutomatedResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AutomatedDateCompletedEmailController extends Controller
{
    public function index()
    {
        $response = AutomatedDateCompletedEmail::first();

        if (!request()->ajax()) {
            return view('automated-date-completed-email/index', [
                'response' => $response,
            ]);
        }
    }

    /**
     * @throws Throwable
     */
    public function edit(AutomatedDateCompletedEmail $response): JsonResponse
    {
        return response()->json(
              view('form-ajax', [
                  'task'     => 'edit',
                  'view'     => 'automated-date-completed-email',
                  'response' => $response,

              ])->render()
            , 200);
    }

    /**
     * @throws Throwable
     */
    public function update(AutomatedDateCompletedEmailRequest $request, AutomatedDateCompletedEmail $response)
    {
        $data = $request->all();

        $data['emails'] = AutomatedResponse::additionalEmails($request->emails);

        $response->update($data);

        return response()->json(
              view('automated-date-completed-email/partials/_responses', [
                  'response' => $response,
              ])->render()
            , 200);
    }
}
