<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Response;
use Auth;

class TaskController extends Controller
{
    public function index(Request $request) {
        if ($request->project_id) {
            $tasks = Task::where('project_id', $request->project_id)->orderBy('priority', 'asc')->get();
            return Response::json($tasks);
        } else {
            // To do
            // Return project id not passed
        }
    }

    /**
    * Show the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $task = Task::with('project')->find($id);
        if ($task) {
            return Response::json($task);
        } else {
            return Response::json('Task Not Found', 404);
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'project_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $priority = 1;
        $reference_task = Task::where('project_id', $request->project_id)->orderBy('priority', 'desc')->first();
        if ($reference_task) {
            $priority = $reference_task->priority + 1;
        }
        $data['priority'] = $priority;

        $task = Task::create($data);
        return Response::json($task);
    }

    /**
    * Show the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id, Request $request)
    {
        $task = Task::find($id);
        if ($task) {
            $task->name = $request->name;
            $task->description = $request->description;
            $task->save();
            return Response::json($task);
        } else {
            return Response::json('Task Not Found', 404);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return Response::json('Task Deleted', 200);
        } else {
            return Response::json('Task Not Found', 404);
        }
    }

    public function sort(Request $request) {
        if ($request->sorted_tasks && count($request->sorted_tasks) > 0) {
            foreach ($request->sorted_tasks as $priority => $task_id) {
                $task = Task::find($task_id);
                if ($task) {
                    $task->priority = $priority + 1;
                    $task->save();
                }
            }
            return Response::json('Tasks Sorted.', 200);
        }
        return Response::json('Sorting Tasks Fail.', 422);
    }
}
