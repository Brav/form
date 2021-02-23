<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintChannelCreateRequest;
use App\Models\ComplaintChannel;
use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(ComplaintChannel $channel)
    {
        return view('modals/partials/_delete', [
            'id'        => $channel->id,
            'routeName' => route('complaint-channel.destroy', $channel->id),
            'itemName'  => $channel->name,
            'table'     => 'complaint-channel',
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
                'task'  => 'create',
                'view'  => 'complaint-channel',
                'types' => ComplaintType::all(),
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ComplaintChannelCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintChannelCreateRequest $request)
    {
        $data = $request->all();

        if($data['level'] === 'None')
        {
            $data['level'] = null;
        }

        $channel = ComplaintChannel::create($data);

        return response()->json(
            view('complaint-channel/partials/_channel', [
                'channel' => $channel,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintChannel  $complaintChannel
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintChannel $complaintChannel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintChannel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintChannel $channel)
    {
        return response()->json(
            view('form-ajax', [
                'channel' => $channel,
                'task'    => 'edit',
                'view'    => 'complaint-channel',
                'types'   => ComplaintType::all(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintChannel  $complaintChannel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintChannel $channel)
    {
        $data = $request->all();

        if($data['level'] === 'None')
        {
            $data['level'] = null;
        }

        $channel->update($data);

        return response()->json(
            view('complaint-channel/partials/_channel', [
                'channel' => $channel,
            ])->render()
            , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintChannel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintChannel $channel)
    {
        if($channel->delete())
        return response()->json([
            'Deleted'
        ], 200);

    return response()->json([
        'Something went wrong!'
    ], 500);
    }
}
