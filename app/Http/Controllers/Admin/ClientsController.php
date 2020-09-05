<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json(
            [
                'status' => 'SUCCESS',
                'data' => $clients->toArray()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result=array(
            "status" => 'ERROR',
            "message" => '',
            "data" => array()
        );

        $checkName = Client::whereRaw('UPPER(TRIM(name)) = UPPER(TRIM(?))',[trim(strtoupper($request->input('name')))])->get();

        if(count($checkName)==0)
        {
            $client = new Client;
            $client->name = $request->input('name');
            $client->email = $request->input('email');
            $client->phone = $request->input('phone');
            $client->contact = $request->input('contact');
            $client->address = $request->input('address');
            $client->notes = $request->input('notes');

            $client->save();

            Log::info('New Client added :: '.json_encode($client));

            $result['status'] = 'SUCCESS';
            $result['data'] = $client;
        }else{
            $result['data'] = array(
                'id' => $checkName[0]->id
            );
            $result['message'] = __('This client already exists');
        }
        return response($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result=array(
            "status" => 'ERROR',
            "message" => '',
            "data" => array()
        );

        $client = Client::find($id);

        if($client)
        {
            $result['status'] = 'SUCCESS';
            $result['data'] = $client;
        }else{
            $result['status'] = 'ERROR';
            $result['message'] = __('Client not found');
        }
        return response($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result=array(
            "status" => 'ERROR',
            "message" => '',
            "data" => array()
        );

        $checkName = Client::whereRaw('UPPER(TRIM(name)) = UPPER(TRIM(?)) and id<>?',[trim(strtoupper($request->input('name'))), $id])->get();

        if(count($checkName)==0)
        {
            $changeClient = Client::find($id);
            $changeClient->name = $request->input('name');
            $changeClient->email = $request->input('email');
            $changeClient->phone = $request->input('phone');
            $changeClient->contact = $request->input('contact');
            $changeClient->address = $request->input('address');
            $changeClient->notes = $request->input('notes');

            $changeClient->save();

            Log::info('Client updated  :: '.$changeClient);

            $result['status'] = 'SUCCESS';
            $result['data']= $changeClient;

        }else{
            $result['status'] = 'ERROR';
            $result['message']= __('Client name already exists');
        }

        return response($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteThis = Client::find($id);

        if($deleteThis)
        {
            $deleteThis->delete();
            Log::info('Deleting Client :: '.json_encode($deleteThis));

            return response([
                'status' => 'SUCCESS',
                'data' => $deleteThis
            ], 200);
        }else{
            return response([
                'status' => 'ERROR',
                'message' => __('Client not found')
            ], 400);
        }
    }
}
