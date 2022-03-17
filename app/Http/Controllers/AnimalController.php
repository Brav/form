<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::paginate(20);

        return [
            'html' => view('animals/partials/_container', [
                'animals'    => $animals,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $animals,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'animals',
                'container' => 'animals-container',
            ])->render(),
            'id' => 'type'
        ];
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
                'view'  => 'animals',
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Animal::create([
            'name' => \filter_var( $request->name, \FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ]);

        return response()->json(
            view('animals/partials/_item', [
                'item' => $item,
            ])->render()
            , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $item)
    {
        return response()->json(
            view('form-ajax', [
                'item' => $item,
                'task' => 'edit',
                'view' => 'animals',
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $item)
    {
        $item->update([
            'name' => \filter_var( $request->name, \FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ]);

        return response()->json(
            view('animals/partials/_item', [
                'item' => $item,
            ])->render()
            , 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Animal $item)
    {
        return view('modals/partials/_delete', [
            'id'        => $item->id,
            'routeName' => route('animals.destroy', $item->id),
            'itemName'  => $item->name,
            'table'     => 'animals',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $item)
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

