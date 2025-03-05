<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardData()
    {
        $counts = $this->dashboardRepository->getCounts();
        $staffUsers = $this->dashboardRepository->getStaffUsers();
        $user = Auth::user();
        $pendingTasks = $this->dashboardRepository->getPendingTasksForUser($user);

        $overviewChartData = [
            'labels' => ['Material', 'Category', 'Users', 'Supplier', 'Transaction', 'Report'],
            'data' => [
                $counts['materialCount'], 
                $counts['categoryCount'], 
                $counts['userCount'], 
                $counts['supplierCount'], 
                $counts['transactionCount'], 
                $counts['reportCount']
            ]
        ];

        return array_merge($counts, [
            'staffUsers' => $staffUsers,
            'pendingTasks' => $pendingTasks,
            'overviewChartData' => $overviewChartData
        ]);
    }
}
