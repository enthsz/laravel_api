<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskService
{
    public function getTaskService()
    {
        return Task::all();
    }

    public function createTaskService(array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:80'
        ]);

        if ($validator->fails())
        {
            return[ 'error' => $validator->errors()->first() ];
           
        }

        return Task::create($data);

    }

    public function updateTaskService(array $data, $id)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:80'
        ]);

        if ($validator->fails())
        {
            return[ 'error' => $validator->errors()->first() ];
           
        }

        $task = Task::find($id);
        if (!$task) {
            return ['error' => 'Tarefa não encontrada'];
        }
        $task->update($data);

        return $task;
    }

    public function deleteTaskService($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return ['error' => 'Tarefa não encontrada'];
        }
        $task->delete();
        return [
            'message' => 'Tarefa excluída com sucesso',
            'task' => $task 
        ];    
    }

}
