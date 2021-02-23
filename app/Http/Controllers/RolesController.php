<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolesStoreRequest;
use App\Http\Requests\RolesUpdateRequest;
use App\Models\Roles;

/** @package RolesController */
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();

        return view('roles/index', [
            'roles' => Roles::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Roles $roles)
    {
        return view('modals/partials/_delete', [
            'id'        => $roles->id,
            'routeName' => route('roles.destroy', $roles->id),
            'itemName'  => $roles->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form', [
                'levels' => Roles::$levels,
                'task'   => 'create',
                'view'  => 'roles',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\RolesStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesStoreRequest $request)
    {
        $data = $request->all();

        $data['permissions'] = $request->read . $request->write . $request->delete;

        Roles::create($data);

        return redirect()->route('roles.index')->with([
            'status' => [
                'message' => 'Role Created',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        return view('form', [
            'role'   => $roles,
            'view'  => 'roles',
            'levels' => Roles::$levels,
            'task'   => 'edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\RolesUpdateRequest  $request
     * @param  \App\Models\Roles  $roles
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RolesUpdateRequest $request, Roles $roles)
    {
        $data = $request->all();

        $data['permissions'] = $request->read . $request->write . $request->delete;

        $roles->update($data);

        return redirect()->route('roles.index')->with([
            'status' => [
                'message' => 'Role updated',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        if($roles->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
