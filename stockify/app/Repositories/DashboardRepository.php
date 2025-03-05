<?php

namespace App\Repositories;

use App\Models\Material;
use App\Models\Category;
use App\Models\Report;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\Task;
use App\Models\User;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getCounts()
    {
        return [
            'materialCount' => Material::count(),
            'categoryCount' => Category::count(),
            'supplierCount' => Supplier::count(),
            'reportCount' => Report::count(),
            'userCount' => User::count(),
            'transactionCount' => StockTransaction::count(),
        ];
    }

    public function getStaffUsers()
    {
        return User::where('role', 'staff')->where('can_receive_tasks', true)->get();
    }

    public function getPendingTasksForUser($user)
    {
        if ($user->role === 'admin' || $user->role === 'manager') {
            return Task::where('status', 'Pending')->get();
        } else {
            return Task::where('status', 'Pending')
                ->where('user_id', $user->id)
                ->get();
        }
    }
}
