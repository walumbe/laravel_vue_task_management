<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTaskRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserTaskResource;
use App\Models\UserTask;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('user_tasks')
            ->join('users', 'users.id', '=', 'user_tasks.user_id')
            ->join('tasks', 'tasks.id', '=', 'user_tasks.task_id')
            ->join('statuses', 'statuses.id', '=', 'user_tasks.status_id')
            ->select('tasks.name as task', 'user_tasks.due_date', 'user_tasks.start_time', 'user_tasks.end_time', 'user_tasks.remarks', 'statuses.name as status')
            ->get();

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'task' => $row->task,
                'due_date' => $row->due_date,
                'start_time' => $row->start_time,
                'end_time' => $row->end_time,
                'remarks' => $row->remarks,
                'status' => $row->status,
            ];
        }

        return response()->json(['status' => true, 'data' => $formattedData]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserTaskRequest $request)
    {
        $request->validated($request->all());
     
        $user_task = UserTask::create([
            'user_id' => Auth::user()->id,
            'task_id' => $request->task_id,
            'due_date'=>$request->due_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'remarks' => $request->remarks,
            'status_id' => $request->status_id,
        ]);
                

        return new UserTaskResource($user_task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserTask $userTask)
    {
        return new UserTaskResource($userTask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserTaskRequest $request, UserTask $userTask)
    {
        $userTask->update($request->validated());

        return new UserTaskResource($userTask);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTask $userTask)
    {
        $userTask->delete();

        return response()->noContent();
    }
}
