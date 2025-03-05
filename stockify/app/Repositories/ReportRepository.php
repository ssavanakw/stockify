<?php

namespace App\Repositories;

use App\Models\Report;

class ReportRepository implements ReportRepositoryInterface
{
    public function getAll()
    {
        return Report::paginate(10);
    }

    public function getById($id)
    {
        return Report::findOrFail($id);
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
        $report = Report::findOrFail($id);
        return $report->delete();
    }
}
