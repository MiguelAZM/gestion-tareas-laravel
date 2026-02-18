<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Notifications\TaskCreatedNotification;
use App\Notifications\TaskCompletedNotification;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->user()->tasks();

        $query->orderBy(
                $request->get('sort_by', 'expiration_date'),
                $request->get('order', 'asc')
            );

            $tasks = $query->paginate(10);


        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->tasks()->create(
            $request->validated());

        $request->user()->notify(
            new TaskCreatedNotification($task));

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorizeTask($task);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);

        $task->update($request->validated());

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return response()->json([
            'message' => 'Tarea eliminada'
        ]);
    }


    //marcar tarea completada
    public function markCompleted(Request $request, Task $task) {
        $this->authorizeTask($task);
        $task->update([
            'completed' => true,
            'justification' => $request->input('justification')
        ]);
        if ($task->user) {
            $task->user->notify(new TaskCompletedNotification($task)
            );
        }
        return response()->json($task); }

    // solo el dueño puede acceder
    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'No autorizado');
        }
    }
}
