<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        foreach ($projects as $oneProject) {
            $oneProject->client;
        }

        return response()->json(
            [
                'status' => 'SUCCESS',
                'data' => $projects->toArray()
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

        $checkName = Project::whereRaw('UPPER(TRIM(name)) = UPPER(TRIM(?))',[trim(strtoupper($request->input('name')))])->get();

        if(count($checkName)==0)
        {
            $project = new Project;
            $project->name = $request->input('name');
            $project->description = $request->input('description');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->budget = $request->input('budget');
            $project->constraints = $request->input('constraints');
            $project->final_cost = $request->input('final_cost');
            $project->project_link = $request->input('project_link');
            $project->client_id = $request->input('client_id');

            $project->save();

            $project->members()->attach($request->input('teamMembers'));

            Log::info('New Project added :: '.json_encode($project));

            $result['status'] = 'SUCCESS';
        }else{
            $result['message'] = __('This project already exists');
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

        $project = Project::find($id);

        if($project)
        {
            $project->members;
            $result['status'] = 'SUCCESS';
            $result['data'] = $project;
        }else{
            $result['status'] = 'ERROR';
            $result['message'] = __('Project not found');
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

        $checkName = Project::whereRaw('UPPER(TRIM(name)) = UPPER(TRIM(?)) and id<>?',[trim(strtoupper($request->input('name'))), $id])->get();

        if(count($checkName)==0)
        {
            $changeProject = Project::find($id);
            $changeProject->name = $request->input('name');
            $changeProject->description = $request->input('description');
            $changeProject->start_date = $request->input('start_date');
            $changeProject->end_date = $request->input('end_date');
            $changeProject->budget = $request->input('budget');
            $changeProject->constraints = $request->input('constraints');
            $changeProject->final_cost = $request->input('final_cost');
            $changeProject->client_id = $request->input('client_id');

            $changeProject->save();
            $changeProject->members()->sync($request->input('teamMembers'));

            Log::info('Project updated  :: '.$changeProject);

            $result['status'] = 'SUCCESS';
            $result['data']= $changeProject;

        }else{
            $result['status'] = 'ERROR';
            $result['message']= __('Project name already exists');
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
        $deleteThis = Project::find($id);

        if($deleteThis)
        {
            $deleteThis->delete();
            Log::info('Deleting Project :: '.json_encode($deleteThis));

            return response([
                'status' => 'SUCCESS',
                'data' => $deleteThis
            ], 200);
        }else{
            return response([
                'status' => 'ERROR',
                'message' => __('Project not found')
            ], 400);
        }
    }

    /**
     * Get project information by project_link column
     *
     * @param string project_link hash
     * @return \Illuminate\Http\Response
     */
    public function getProjectByLink($project_link)
    {
        $result=array(
            "status" => 'ERROR',
            "message" => '',
            "data" => array()
        );

        $auxProject = DB::table('projects')->where('project_link',$project_link)->get();

        if($auxProject->count()>0)
        {
            $project = Project::find($auxProject[0]->id);
            if($project)
            {
                $project->members;
                $project->client;
                $result['status'] = 'SUCCESS';
                $result['data'] = $project;
            }else{
                $result['message'] = __('Project not found');
            }
        }else{
            $result['message'] = __('Project not found');
        }
        return response($result, 200);
    }
}
