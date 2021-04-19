<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutcomeOptionCategoryCreateRequest;
use App\Models\OutcomeOptionsCategories;
use Illuminate\Http\Request;

class OutcomeOptionsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = OutcomeOptionsCategories::paginate(20);

        return [
            'html' => view('outcome-options-categories/partials/_container', [
                'categories' => $categories,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $categories,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'outcome-options-categories',
                'container' => 'outcome-options-categories-container',
            ])->render(),
            'id' => 'type'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(OutcomeOptionsCategories $category)
    {
        return view('modals/partials/_delete', [
            'id'        => $category->id,
            'routeName' => route('outcome-options-categories.destroy', $category->id),
            'itemName'  => $category->name,
            'table'     => 'outcome-options-categories',
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
                'view'       => 'outcome-options-categories',
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OutcomeOptionCategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutcomeOptionCategoryCreateRequest $request)
    {
        $category = OutcomeOptionsCategories::create($request->all());

        return response()->json(
            view('outcome-options-categories/partials/_category', [
                'category' => $category,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutcomeOptionsCategories  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(OutcomeOptionsCategories $category)
    {
        return response()->json(
            view('form-ajax', [
                'task'     => 'edit',
                'view'     => 'outcome-options-categories',
                'category' => $category,
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutcomeOptionsCategories  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutcomeOptionsCategories $category)
    {
        $category->update($request->all());

        return response()->json(
            view('outcome-options-categories/partials/_category', [
                'category' => $category,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutcomeOptionsCategories  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutcomeOptionsCategories $category)
    {
        if($category->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
