<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationCreateRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::paginate(20);

        if(request()->ajax())
            return [
                'html' => view('location/partials/_container', [
                    'types' => $locations,
                ])->render(),
                'pagination' => view('pagination', [
                    'paginator' => $locations,
                    'layout'    => 'vendor.pagination.bootstrap-4',
                    'role'      => 'complaint-type',
                    'container' => 'complaint-type-container',
                ])->render(),
                'id' => 'type'
            ];

        return view('location/index', [
            'locations' => $locations,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Location $location)
    {
        return view('modals/partials/_delete', [
            'id'        => $location->id,
            'routeName' => route('location.destroy', $location->id),
            'itemName'  => $location->name,
            'table'     => 'location',
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
                'view'       => 'location',
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LocationCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationCreateRequest $request)
    {
        $location = Location::create($request->all());

        return response()->json(
            view('location/partials/_location', [
                'location' => $location,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return response()->json(
            view('form-ajax', [
                'location' => $location,
                'task'     => 'edit',
                'view'     => 'location',
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $location->update($request->all());

        return response()->json(
            view('location/partials/_location', [
                'location' => $location,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
