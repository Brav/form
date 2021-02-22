<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with(['role'])->paginate(20);

        return view('users/index', [
            'users' => $users,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        return view('modals/partials/_delete', [
            'id'        => $user->id,
            'routeName' => route('users.destroy', $user->id),
            'itemName'  => $user->name,
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
            'task'  => 'create',
            'view'  => 'users',
            'roles' => Roles::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        if( $request->admin == 1 )
        {
            $data['can_login'] = true;
        }

        if($request->password)
        {
            $data['password'] = Hash::make($request->password);
        }

        User::create($data);

        return redirect()->route('users.index')->with([
            'status' => [
                'message' => 'User Created',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users/form', [
            'task'  => 'edit',
            'view'  => 'users',
            'roles' => Roles::all(),
            'user'  => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();

        $data['password'] = $user->password;

        if( $request->admin == 1 )
        {
            $data['can_login'] = true;
        }

        if($request->password)
        {
            $data['password'] = Hash::make($request->password);
        }

        $user->save($data);

        return redirect()->route('users.index')->with([
            'status' => [
                'message' => 'User Updated',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id === auth()->id())
        {
            return response()->json([
                'You are not allowed to delete yourself!'
            ], 403);
        }

        if($user->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
