<?php

namespace App\Repositories;

use App\Models\Report;

class ReportRepository implements ReportRepositoryInterface
{
    public function getAll()
    {
        return Report::orderBy('created_at', 'desc')->paginate(10);
    }

    public function getById($id)
    {
        return Report::with('user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Report::create($data);
    }

    public function update($id, array $data)
    {
        $report = Report::findOrFail($id);
        $report->update($data);
        return $report;
    }

    public function delete($id)
    {
        return Report::destroy($id);
    }

    public function getReportsByUser($userId)
    {
        return Report::where('user_id', $userId)->get();
    }
}
