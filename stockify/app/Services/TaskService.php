<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getPendingTasks()
    {
        return $this->taskRepository->getPendingTasks();
    }

    public function getEligibleStaff()
    {
        return User::where('role', 'staff')->where('can_receive_tasks', true)->get();
    }

    public function assignTask($data)
    {
        $staff = User::where('id', $data['user_id'])
                    ->where('role', 'staff')
                    ->where('can_receive_tasks', true)
                    ->first();

        if (!$staff) {
            return ['success' => false, 'message' => 'Selected staff is not eligible for tasks.'];
        }

        $this->taskRepository->createTask([
            'title'       => $data['title'],
            'description' => $data['description'],
            'user_id'     => $staff->id,
            'status'      => 'Pending',
        ]);

        return ['success' => true, 'message' => 'Task assigned successfully.'];
    }

    public function markTaskAsComplete($taskId)
    {
        $task = $this->taskRepository->findTaskById($taskId);

        if (Auth::user()->id !== $task->user_id || Auth::user()->role !== 'staff') {
            return ['success' => false, 'message' => 'Unauthorized action.'];
        }

        $this->taskRepository->updateTaskStatus($taskId, 'completed');

        $report = Report::where('title', "Task Completed: " . $task->title)
                        ->where('user_id', $task->user_id)
                        ->first();

        if ($report) {
            $report->update(['status' => 'completed']);
        } else {
            Report::create([
                'title'       => "Task Completed: " . $task->title,
                'description' => $task->description,
                'user_id'     => $task->user_id,
                'status'      => 'completed',
            ]);
        }

        return ['success' => true, 'message' => 'Task marked as completed and reported.'];
    }
}
