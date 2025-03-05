<?php

namespace App\Repositories;

interface DashboardRepositoryInterface
{
    public function getCounts();
    public function getStaffUsers();
    public function getPendingTasksForUser($user);
}
