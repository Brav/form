<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientInjuryTypeRequest;
use App\Models\PatientInjuryType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class PatientInjuryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('patient-injury-types/index', [
            'types' => PatientInjuryType::paginate(20),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function delete(PatientInjuryType $item)
    {
        return view('modals/partials/_delete', [
            'id'        => $item->id,
            'routeName' => route('patient-injury-types.delete', $item->id),
            'itemName'  => $item->name,
            'table'     => 'severities',
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
                'task'  => 'create',
                'view'  => 'patient-injury-types',
            ])->render()
            , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PatientInjuryTypeRequest  $request
     * @return JsonResponse
     */
    public function store(PatientInjuryTypeRequest $request): JsonResponse
    {

        $item = PatientInjuryType::create([
            'name' => $request->name,
        ]);

        return response()->json(
            view('patient-injury-types/partials/_item', [
                'item' => $item,
            ])->render()
            , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PatientInjuryType $item
     * @return JsonResponse
     * @throws Throwable
     */
    public function edit(PatientInjuryType $item): JsonResponse
    {
        return response()->json(
            view('form-ajax', [
                'item' => $item,
                'task' => 'edit',
                'view' => 'patient-injury-types',
            ])->render()
            , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatientInjuryTypeRequest $request
     * @param PatientInjuryType $item
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(PatientInjuryTypeRequest $request, PatientInjuryType $item): JsonResponse
    {

        $item->update([
            'name' => \filter_var( $request->name, \FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ]);

        return response()->json(
            view('patient-injury-types/partials/_item', [
                'item' => $item,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PatientInjuryType $item
     * @return JsonResponse
     */
    public function destroy(PatientInjuryType $item): JsonResponse
    {
        if($item->delete()) {
            return response()->json([
                'Deleted'
            ], 200);
        }

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
