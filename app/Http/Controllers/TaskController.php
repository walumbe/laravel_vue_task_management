<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Status;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $user = Auth::user();
        // if (!$user) {
        
        //     return response()->json(['status' => false, 'message' => 'User not authenticated.'], 401);
        // }

        $data = DB::table('tasks')
            ->join('statuses', 'statuses.id', '=', 'tasks.status_id')
            ->select('tasks.name', 'tasks.description', 'tasks.due_date', 'statuses.name as status')
            ->get();

        // return response()->json(['status' => true, 'data' => $data]);
        return TaskResource::collection($data);
    }

    public function store(TaskRequest $request)
    {

        $request->validated();

        $status_id = Status::where('name', 'Not Assigned')->value('id');

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'duedate' => $request->duedate,
            'status_id' => $status_id
        ]);

        return new TaskResource($task);
    }

    
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}

