<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        $reports = $this->reportService->getAll();
        return view('pages.reports.index', compact('reports'));
    }

    public function show($id)
    {
        $report = $this->reportService->getById($id);
        return view('reports.show', compact('report'));
    }

    public function create()
    {
        return view('pages.reports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,completed',
        ]);

        $data['user_id'] = Auth::id();

        $this->reportService->create($data);
        return redirect()->route('reports.index')->with('success', 'Report created successfully');
    }

    public function edit($id)
    {
        $report = $this->reportService->getById($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,resolved',
        ]);

        $this->reportService->update($id, $data);
        return redirect()->route('reports.index')->with('success', 'Report updated successfully');
    }

    public function delete($id)
    {
        $this->reportService->delete($id);
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully');
    }
    
}
