<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use App\Models\User;
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
        $pendingTasks = Task::where('status', 'Pending')->get();
    
        // Retrieve only staff with a specific condition (e.g., role = 'staff' and allowed to receive tasks)
        $staffUsers = User::where('role', 'staff')->where('can_receive_tasks', true)->get();

        return view('tasks.index', compact('pendingTasks', 'staffUsers'));
    }

    public function assignTask(Request $request)
    {
        if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'manager')) {
            return redirect()->back()->with('error', 'You are not authorized to assign tasks.');
        }

        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id', 
        ]);

        // Ensure that the selected staff is eligible for tasks
        $staff = User::where('id', $request->user_id)
                    ->where('role', 'staff')
                    ->where('can_receive_tasks', true)
                    ->first();

        if (!$staff) {
            return redirect()->back()->with('error', 'Selected staff is not eligible for tasks.');
        }

        // Create task
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $staff->id,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Task assigned successfully.');
    }

    public function create()
    {
        $staff = User::where('role', 'staff')->where('can_receive_tasks', true)->get();
    return view('tasks.create', compact('staff'));

    }


    // public function assignTask(Request $request)
    // {
    //     // Check if the user is an Admin or Manager
    //     if (!Auth::check()) {
    //         return redirect()->back()->with('error', 'You are not authorized to assign tasks.');
    //     }

    //     // Validate input
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'user_id' => 'required|exists:users,id', // Ensure user exists
    //     ]);

    //     // Create a new task
    //     Task::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'user_id' => $request->user_id,
    //         'status' => 'Pending', // Default status
    //     ]);

    //     return redirect()->back()->with('success', 'Task assigned successfully.');
    // }

        public function markAsComplete($id)
    {
        $task = Task::findOrFail($id);

        // Only allow staff to complete their assigned tasks
        if (Auth::user()->id !== $task->user_id || Auth::user()->role !== 'staff') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        
        // Update task status to 'completed'
        $task->status = 'completed';
        $task->save();

        // Check if a report already exists for this task
        $report = Report::where('title', "Task Completed: " . $task->title)
                        ->where('user_id', $task->user_id)
                        ->first();

        if ($report) {
            // Update the existing report status
            $report->status = 'completed';
            $report->save();
        } else {
            // Create a new report with 'completed' status
            Report::create([
                'title'       => $task->title,
                'description' => $task->description,
                'user_id'     => $task->user_id,
                'status'      => 'completed',
            ]);
        }
        // // Update task status (Use 'Done' instead of 'completed')
        // $task->status = 'completed';
        // $task->save();

        // // Create a new report
        // Report::create([
        //     'title'       => "Task Completed: " . $task->title,
        //     'description' => "Task '{$task->description}' has been completed by {$task->user->name}.",
        //     'user_id'     => $task->user_id,
        //     'status'      => 'Completed',
        // ]);

        return redirect()->back()->with('success', 'Task marked as completed and reported.');
    }


    public function completeTask($taskId)
    {
        $task = Task::findOrFail($taskId);

        // Ensure only staff can complete tasks
        if (Auth::user()->role !== 'staff') {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Task marked as completed.');
    }
}
