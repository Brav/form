<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutcomeOptionCreateRequest;
use App\Models\OutcomeOptions;
use App\Models\OutcomeOptionsCategories;
use Illuminate\Http\Request;

class OutcomeOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options    = OutcomeOptions::with(['category'])->paginate(20);
        $categories = OutcomeOptionsCategories::paginate(20);

        if(request()->ajax())
            return [
                'html' => view('outcome-options/partials/_container', [
                    'options' => $options,
                ])->render(),
                'pagination' => view('pagination', [
                    'paginator' => $options,
                    'layout'    => 'vendor.pagination.bootstrap-4',
                    'role'      => 'outcome-options',
                    'container' => 'outcome-options-container',
                ])->render(),
                'id' => 'type'
            ];

        return view('outcome-options/index', [
            'options'    => $options,
            'categories' => $categories,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(OutcomeOptions $option)
    {
        return view('modals/partials/_delete', [
            'id'        => $option->id,
            'routeName' => route('outcome-options.destroy', $option->id),
            'itemName'  => $option->name,
            'table'     => 'outcome-options',
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
                'view'       => 'outcome-options',
                'categories' => OutcomeOptionsCategories::all(),
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutcomeOptionCreateRequest $request)
    {
        $option = OutcomeOptions::create($request->all());

        return response()->json(
            view('outcome-options/partials/_option', [
                'option' => $option,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutcomeOptions  $outcomeOptions
     * @return \Illuminate\Http\Response
     */
    public function show(OutcomeOptions $option)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeOptions  $outcomeOptions
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeOptions $option)
    {
        return response()->json(
            view('form-ajax', [
                'task'       => 'edit',
                'view'       => 'outcome-options',
                'option'     => $option,
                'categories' => OutcomeOptionsCategories::all(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeOptions  $outcomeOptions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeOptions $option)
    {
        $option->update($request->all());

        return response()->json(
            view('outcome-options/partials/_option', [
                'option' => $option,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeOptions  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeOptions $option)
    {
        if($option->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
