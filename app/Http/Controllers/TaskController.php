<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return TaskResource::collection(Task::all());
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

