<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return response()->json(
            [
                'status' => 'SUCCESS',
                'data' => $members->toArray()
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

        $checkName = Member::whereRaw('UPPER(TRIM(name)) = UPPER(TRIM(?))',[trim(strtoupper($request->input('name')))])->get();

        if(count($checkName)==0)
        {
            $member = new Member;
            $member->name = $request->input('name');
            $member->email = $request->input('email');
            $member->phone = $request->input('phone');
            $member->position = $request->input('position');
            $member->description = $request->input('description');
            $member->save();

            if($request->picture)
            {
                $picPath = $request->file('picture')->storeAs('',$member->id.'_pic.'.$request->file('picture')->extension(),'public_upload');
                $member->picture = $picPath;
                $member->save();
            }

            Log::info('New Member added :: '.json_encode($member));

            $result['status'] = 'SUCCESS';
        }else{
            $result['message'] = __('This member already exists');
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

        $member = Member::find($id);

        if($member)
        {
            $result['status'] = 'SUCCESS';
            $result['data'] = $member;
        }else{
            $result['status'] = 'ERROR';
            $result['message'] = __('Member not found');
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

        $checkName = Member::whereRaw('UPPER(TRIM(name)) = UPPER(TRIM(?)) and id<>?',[trim(strtoupper($request->input('name'))), $id])->get();

        if(count($checkName)==0)
        {
            $changeMember = Member::find($id);
            $changeMember->name = $request->input('name');
            $changeMember->email = $request->input('email');
            $changeMember->phone = $request->input('phone');
            $changeMember->position = $request->input('position');
            $changeMember->description = $request->input('description');

            $changeMember->save();

            if($request->picture)
            {
                $picPath = $request->file('picture')->storeAs('',$changeMember->id.'_pic.'.$request->file('picture')->extension(),'public_upload');
                $changeMember->picture = $picPath;
                $changeMember->save();
            }

            Log::info('Member updated  :: '.$changeMember);

            $result['status'] = 'SUCCESS';
            $result['data']= $changeMember;

        }else{
            $result['status'] = 'ERROR';
            $result['message']= __('Member name already exists');
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
        $deleteThis = Member::find($id);

        if($deleteThis)
        {
            $deleteThis->delete();
            Log::info('Deleting Member :: '.json_encode($deleteThis));

            return response([
                'status' => 'SUCCESS',
                'data' => $deleteThis
            ], 200);
        }else{
            return response([
                'status' => 'ERROR',
                'message' => __('Member not found')
            ], 400);
        }
    }
}
