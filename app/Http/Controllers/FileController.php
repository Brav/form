<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
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
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
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
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        if(!Storage::delete('public/files/' . $file->name))
        {
            return response()->json('error', 500);
        }

        if($file->delete())
        {
            return response()->json('deleted', 200);
        }

        return response()->json('error', 500);
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
