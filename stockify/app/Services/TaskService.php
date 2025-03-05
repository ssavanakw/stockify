<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function completeTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->status = 'completed';
        $task->save();

        // Simpan tugas ke laporan
        Report::create([
            'task_id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'status' => 'Pending', // Default menunggu verifikasi
            'created_at' => now(),
        ]);

        return $task;
    }
}
