<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getPendingTasks();

    public function createTask(array $data);

    public function findTaskById($taskId);

    public function updateTaskStatus($taskId, $status);
}
