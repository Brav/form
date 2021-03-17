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

        $users = User::query();

        $users->when(!auth()->user()->admin, function($query){
            return $query->where('created_by', '=', auth()->id());
        });

        $users = $users->with(['role'])->paginate(20);

        if(!request()->ajax())
            return view('users/index', [
                'users' => $users,
            ]);

        return [
            'html' => view('users/partials/_users', [
                'users' => $users,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $users,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'users',
                'container' => 'users-container',
            ])->render()
        ];

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

        $users = null;

        if(auth()->user()->admin)
        {
            $users = User::where('id', '!=', auth()->id())->get();
        }

        return view('form', [
            'task'  => 'create',
            'view'  => 'users',
            'roles' => Roles::all(),
            'users' => $users,
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

        $data['created_by'] = auth()->id();

        if(auth()->user()->admin)
        {
            $data['created_by'] = is_numeric($request->post('created_by')) ?
                (int) $request->post('created_by') : null;
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
        $userID = auth()->id();

        if (!auth()->user()->admin &&
            $user->created_by != $userID &&
            $user->id != $userID
        ) {
            return redirect()->route('users.index');
        }

        $users = null;

        if(auth()->user()->admin)
        {
            $users = User::where('id', '!=', auth()->id())->get();
        }

        return view('form', [
            'task'  => 'edit',
            'view'  => 'users',
            'roles' => Roles::all(),
            'user'  => $user,
            'users' => $users,
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
        else
        {
            $data['admin'] = false;
        }

        if($request->password)
        {
            $data['password'] = Hash::make($request->password);
        }

        if(auth()->user()->admin)
        {
            $data['created_by'] = is_numeric($request->post('created_by')) ?
                (int) $request->post('created_by') : null;
        }

        if(!$request->can_login)
        {
            $data['can_login'] = false;
        }

        $user->update($data);

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
        $userID = auth()->id();

        if (!auth()->user()->admin &&
            $user->created_by != $userID
        ) {
            die();
        }

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
