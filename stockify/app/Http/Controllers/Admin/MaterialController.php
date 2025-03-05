<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MaterialService;
use App\Models\Category;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    protected $materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }

    public function index()
    {
        $materials = $this->materialService->getAllMaterials();
        return view('pages.materials.index', compact('materials'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.materials.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|min:3",
            "description" => "nullable",
            "price" => "required",
            "stock" => "required",
            "category_id" => "required",
        ]);

        $this->materialService->createMaterial($validated);

        return redirect('/materials')->with('success', 'Material added successfully.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $material = $this->materialService->getMaterialById($id);
        return view('pages.materials.edit', compact('categories', 'material'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required|min:3",
            "description" => "nullable",
            "price" => "required",
            "stock" => "required",
            "category_id" => "required",
        ]);

        $this->materialService->updateMaterial($id, $validated);

        return redirect('/materials')->with('success', 'Material updated successfully.');
    }

    public function delete($id)
    {
        $this->materialService->deleteMaterial($id);

        return redirect('/materials')->with('success', 'Material deleted successfully.');
    }
}
