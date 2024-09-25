<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;

use function PHPUnit\Framework\isEmpty;

class TaskController extends Controller
{

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getTask()
    {
        $tasks = $this->taskService->getTaskService();

        if (count($tasks) === 0)
        {
            return response()->json(['message' => 'Empty List']);
        }

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createTask(Request $request)
    {
        $tasks = $this->taskService->createTaskService($request->all());

        if (isset($tasks['error']))
        {
            return response()->json(['error' => $tasks['error']], 422);
        }

        return response()->json(["Tarefa criada com Sucesso" => $tasks]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTask(Request $request, string $id)
    {
        $tasks = $this->taskService->updateTaskService($request->all(), $id);

        if (isset($tasks['error']))
        {
            return response()->json(['error' => $tasks['error']], 422);
        }

        return response()->json(["Tarefa atualizada com Sucesso" => $tasks]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteTask(string $id)
{
    $result = $this->taskService->deleteTaskService($id);

    if (isset($result['error'])) {
        return response()->json(['error' => $result['error']], 404);
    }

    return response()->json([
        'message' => $result['message'],
        'task' => $result['task'] 
    ], 200);
}

}
