<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $pendingTasks = $this->taskService->getPendingTasks();
        $staffUsers = $this->taskService->getEligibleStaff();

        return view('tasks.index', compact('pendingTasks', 'staffUsers'));
    }

    public function assignTask(Request $request)
    {
        if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'manager')) {
            return redirect()->back()->with('error', 'You are not authorized to assign tasks.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $result = $this->taskService->assignTask($request->all());

        return redirect()->back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function markAsComplete($id)
    {
        $result = $this->taskService->markTaskAsComplete($id);
        return redirect()->back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }
}
