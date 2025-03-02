<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use App\Models\Report;
use App\Models\Supplier;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     if (!Auth::check()) {
    //         return redirect('/login')->with('error-unauthorized', 'Login first');
    //     }

    //     $materialCount = Material::count();
    //     $categoryCount = Category::count();
    //     $supplierCount = Supplier::count();
    //     $reportCount = Report::count();
    //     $userCount = User::count();

    //     $staffUsers = User::where('role', 'staff')->where('can_receive_tasks', true)->get();


    //     // Fetch pending tasks
    //     // $pendingTasks = Task::where('status', 'Pending')->get();
    //     $pendingTasks = Task::where('status', 'Pending')
    //     ->where('user_id', Auth::id()) // Hanya ambil task milik user yang login
    //     ->get();

    //     // Pass all data to the view
    //     return view('pages.dashboard.admin', compact(
    //         'materialCount', 'categoryCount', 'reportCount', 'supplierCount', 'userCount', 'staffUsers', 'pendingTasks'
    //     ));
    // }

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error-unauthorized', 'Login first');
        }
    
        $materialCount = Material::count();
        $categoryCount = Category::count();
        $supplierCount = Supplier::count();
        $reportCount = Report::count();
        $userCount = User::count();
    
        $staffUsers = User::where('role', 'staff')->where('can_receive_tasks', true)->get();
    
        // Menentukan user yang sedang login
        $user = Auth::user();
    
        // Jika admin atau manager, ambil semua tugas
        if ($user->role === 'admin' || $user->role === 'manager') {
            $pendingTasks = Task::where('status', 'Pending')->get();
        } else {
            // Jika staff, hanya ambil tugas miliknya
            $pendingTasks = Task::where('status', 'Pending')
                ->where('user_id', $user->id)
                ->get();
        }
    
        // Tambahkan data untuk chart
        $materialData = [$materialCount, $categoryCount];
        $userData = [$userCount, $supplierCount];
    
        return view('pages.dashboard.admin', compact(
            'materialCount', 'categoryCount', 'reportCount', 'supplierCount', 'userCount', 'staffUsers', 'pendingTasks', 'materialData', 'userData'
        ));
    }
}
