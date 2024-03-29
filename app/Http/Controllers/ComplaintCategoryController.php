<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintCategoryCreateRequest;
use App\Http\Requests\ComplaintCategoryUpdateRequest;
use App\Models\Animal;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use App\Models\Roles;
use App\Models\Severity;
use Illuminate\Http\Request;

class ComplaintCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = ComplaintCategory::orderBy('name', "ASC")->paginate(20);

        if(!request()->ajax())
            return view('complaint-category/index', [
                'categories' => $categories,
                'types'      => ComplaintType::orderBy('name', "ASC")->with(['category'])->paginate(20)
                    ->withPath(route('complaint-type.index')),
                'channels'   => ComplaintChannel::orderBy('name', "ASC")->paginate(20)
                    ->withPath(route('complaint-channel.index')),
                'severities' => Severity::paginate(20),
                'animals'    => Animal::paginate(20),
            ]);

        return [
                'html' => view('complaint-category/partials/_container', [
                    'categories' => $categories,
                ])->render(),
                'pagination' => view('pagination', [
                    'paginator' => $categories,
                    'layout'    => 'vendor.pagination.bootstrap-4',
                    'role'      => 'complaint-category',
                    'container' => 'complaint-category-container',
                ])->render(),
                'id' => 'categories'
            ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(ComplaintCategory $complaint)
    {
        return view('modals/partials/_delete', [
            'id'        => $complaint->id,
            'routeName' => route('complaint-category.destroy', $complaint->id),
            'itemName'  => $complaint->name,
            'table'     => 'complaint-category',
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
                    'roles'      => Roles::all(),
                    'task'       => 'create',
                    'view'       => 'complaint-category',
                    'channels'   => ComplaintChannel::all(),
                    'severities' => Severity::all(),
                ])->render()
            , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintCategoryCreateRequest $request)
    {
        $category = ComplaintCategory::create(ComplaintCategory::formatData($request->all()));

        return response()->json(
            view('complaint-category/partials/_category', [
                'category' => $category,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintCategory $complaintCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintCategory $complaint)
    {
        return response()->json(
            view('form-ajax', [
                'category'   => $complaint,
                'roles'      => Roles::all(),
                'task'       => 'edit',
                'view'       => 'complaint-category',
                'channels'   => ComplaintChannel::all(),
                'severities' => Severity::all(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ComplaintCategoryUpdateRequest  $request
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ComplaintCategoryUpdateRequest $request, ComplaintCategory $complaint)
    {
        $complaint->update(ComplaintCategory::formatData($request->all()));

        return response()->json(
            view('complaint-category/partials/_category', [
                'category' => $complaint,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintCategory $complaint)
    {
        if($complaint->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
