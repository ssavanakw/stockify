<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ReportRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Attributes\Middleware;


class ReportController extends Controller
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $reports = $this->reportRepository->getAll();
        return view('pages.reports.index', compact('reports'));
    }

    public function show($id)
    {
        $report = $this->reportRepository->getById($id);
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
            'status' => 'required|in:pending,resolved',
        ]);

        $data['user_id'] = Auth::id();

        $this->reportRepository->create($data);
        return redirect()->route('reports.index')->with('success', 'Report created successfully');
    }

    public function edit($id)
    {
        $report = $this->reportRepository->getById($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,resolved',
        ]);

        $this->reportRepository->update($id, $data);
        return redirect()->route('reports.index')->with('success', 'Report updated successfully');
    }

    public function delete($id)
    {
        $this->reportRepository->delete($id);
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully');
    }
}
