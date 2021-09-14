<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeverityCreateRequest;
use App\Models\Severity;
use Illuminate\Http\Request;

class SeverityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $severities = Severity::paginate(20);

        return [
            'html' => view('severities/partials/_container', [
                'severities'    => $severities,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $severities,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'severities',
                'container' => 'severities-container',
            ])->render(),
            'id' => 'type'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Severity $item)
    {
        return view('modals/partials/_delete', [
            'id'        => $item->id,
            'routeName' => route('severity.destroy', $item->id),
            'itemName'  => $item->name,
            'table'     => 'severities',
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
                'task'  => 'create',
                'view'  => 'severities',
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SeverityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeverityCreateRequest $request)
    {
        $channel = Severity::create([
            'name' => \filter_var( $request->name, \FILTER_SANITIZE_STRING),
        ]);

        return response()->json(
            view('complaint-channel/partials/_channel', [
                'channel' => $channel,
            ])->render()
            , 200);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Severity  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Severity $item)
    {
        return response()->json(
            view('form-ajax', [
                'item' => $item,
                'task' => 'edit',
                'view' => 'severities',
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Severity  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Severity $item)
    {

        $item->update([
            'name' => \filter_var( $request->name, \FILTER_SANITIZE_STRING),
        ]);

        return response()->json(
            view('severities/partials/_item', [
                'item' => $item,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Severity  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Severity $item)
    {
        if($item->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
