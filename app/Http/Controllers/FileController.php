<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\ComplaintForm;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('files/index', [
            'files' => File::orderBy('title', 'ASC')->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function delete(File $file)
    {
        return view('modals/partials/_delete', [
            'id'        => $file->id,
            'routeName' => route('file.destroy', $file->id),
            'itemName'  => $file->title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\FileRequest $request
     * @return Response
     */
    public function store(FileRequest $request)
    {
        $fileName = Str::random(16) . '.' . $request->file('file')->extension();

        $data['title'] = \filter_var($request->title, \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['name']  = $fileName;

        if(!Storage::putFileAs(
            'public/files', $request->file('file'),  $fileName,
        ))
        {
            return response()->json('error', 403);
        }

        if($file = File::create($data))
        {
            return response()->json([
                'html'     => view('files/partials/_file', [
                    'file' => $file,
                ])->render(),
                'table'    => 'files',
            ], 200);
        }

        return response()->json('error', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param File $file
     * @return Response
     */
    public function edit(File $file)
    {
        return response()->json(
            view('form-ajax', [
                'file' => $file,
                'task' => 'edit',
                'view' => 'files',
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\FileUpdateRequest  $request
     * @param File $file
     * @return Response
     */
    public function update(FileUpdateRequest $request, File $file)
    {
        $file->update([
            'title' => \filter_var($request->title, \FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ]);

        return response()->json(
            view('files/partials/_file', [
                'file' => $file,
            ])->render()
        , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ComplaintForm $form
     * @return JsonResponse
     */
    public function destroy(ComplaintForm $form): JsonResponse
    {

        $directory = 'documents/complaint_form_' . $form->id;

        $fileName =
            \strtolower(
                \str_replace(' ', '',
                    \filter_var(request()->input('file'),
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                        FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                    )
                )
            );

        return Storage::delete($directory . '/' . $fileName) ?
        response()->json('success', 200) : response()->json('error', 500);


    }

    /**
     * Downloads the selected file
     *
     * @param string $name Name of the file
     * @return mixed
     */
    public function download(string $name)
    {
        $file = File::where('name', 'like', '%' . $name . '%')->first();

        if(!$file)
        {
            abort(404);
        }

        return Storage::download('public/files/' . $file->name);
    }
}
