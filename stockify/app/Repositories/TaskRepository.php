<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getPendingTasks()
    {
        return Task::where('status', 'Pending')->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function findTaskById($taskId)
    {
        return Task::findOrFail($taskId);
    }

    public function updateTaskStatus($taskId, $status)
    {
        $task = Task::findOrFail($taskId);
        $task->update(['status' => $status]);
        return $task;
    }
}
