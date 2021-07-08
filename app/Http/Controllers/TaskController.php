<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Activity;
use App\Models\User;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Http\Resources\TaskEditResource;

class TaskController extends Controller
{
    public function edit(int $id)
    {
        $task = Task::whereId($id)
            ->select([ 'id', 'activity_id', 'user_id', 'anotation' ])
            ->first()
            ->load(['activity' => function ($query) {
                $query->select([ 'id', 'name' ]);
            }])
            ->load(['user' => function ($query) {
                $query->select([ 'id', 'name' ]);
            }]);

        $taskResource = TaskEditResource::make($task);

        return response()->json([
            'task' => $taskResource
        ]);
    }

    public function store(TaskStore $request)
    {
        $data = $request->all();
        Task::create($data);
    }

    public function update(int $id, TaskUpdate $request)
    {
        $data = $request->all();
        Task::find($id)->update($data);
    }

    public function getActivities()
    {
        $activities = Activity::orderBy('name')->select([ 'id', 'name' ])->get();
        return response()->json([
            'activities' => $activities
        ]);
    }

    public function getUsers()
    {
        $users = User::orderBy('name')->select(['id', 'name'])->get();
        return response()->json([
            'users' => $users
        ]);
    }
}
