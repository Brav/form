<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintTypeCreateRequest;
use App\Http\Requests\ComplaintTypeUpdateRequest;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use App\Models\Roles;
use App\Models\Severity;
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
        $types = ComplaintType::with(['category'])->paginate(20);

        return [
            'html' => view('complaint-types/partials/_container', [
                'types'    => $types,
                'channels' => ComplaintChannel::all(),
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $types,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'complaint-type',
                'container' => 'complaint-type-container',
            ])->render(),
            'id' => 'type'
        ];
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
                'severities' => Severity::SEVERITIES,
                'categories' => ComplaintCategory::all(),
                'channels'   => ComplaintChannel::all(),
                'levels'     => Roles::$levels,
                'roles'      => Roles::all(),
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

        $data['complaint_channels_settings'] = null;

        if($data['channel_settings_select'] === 'custom')
        {
            $data['complaint_channels_settings'] = $data['channel_settings'];
        }

        $type = ComplaintType::create($data);

        return response()->json(
            view('complaint-types/partials/_type', [
                'type'       => $type,
                'severities' => Severity::SEVERITIES,
                'channels'   => ComplaintChannel::all(),
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
                'severities' => Severity::SEVERITIES,
                'categories' => ComplaintCategory::all(),
                'channels'   => ComplaintChannel::all(),
                'levels'     => Roles::$levels,
                'roles'      => Roles::all(),
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

        $data['complaint_channels_settings'] = null;

        if($data['channel_settings_select'] === 'custom')
        {
            $data['complaint_channels_settings'] = $data['channel_settings'];
        }

        $type->update($data);

        return response()->json(
            view('complaint-types/partials/_type', [
                'type'     => $type,
                'channels' => ComplaintChannel::all(),
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
