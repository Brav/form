<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintTypeCreateRequest;
use App\Http\Requests\ComplaintTypeUpdateRequest;
use App\Models\ComplaintCategory;
use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(ComplaintType $type)
    {
        return view('modals/partials/_delete', [
            'id'        => $type->id,
            'routeName' => route('complaint-type.destroy', $type->id),
            'itemName'  => $type->name,
            'table'     => 'complaint-types',
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
                'view'       => 'complaint-types',
                'categories' => ComplaintCategory::all(),
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ComplaintTypeCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintTypeCreateRequest $request)
    {
        $data = $request->all();

        if($data['level'] === 'None')
        {
            $data['level'] = null;
        }

        $type = ComplaintType::create($data);

        return response()->json(
            view('complaint-types/partials/_type', [
                'type' => $type,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintType $type)
    {
        return response()->json(
            view('form-ajax', [
                'type'       => $type,
                'task'       => 'edit',
                'view'       => 'complaint-types',
                'categories' => ComplaintCategory::all(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ComplaintTypeUpdateRequest  $request
     * @param  \App\Models\ComplaintType  $type
     * @return \Illuminate\Http\Response
     */
    public function update(ComplaintTypeUpdateRequest $request, ComplaintType $type)
    {
        $data = $request->all();

        if($data['level'] === 'None')
        {
            $data['level'] = null;
        }

        $type->update($data);

        return response()->json(
            view('complaint-types/partials/_type', [
                'type' => $type,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintType  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintType $type)
    {
        if($type->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
