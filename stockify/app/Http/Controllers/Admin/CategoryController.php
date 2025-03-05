<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|unique:categories,name",
        ], [
            "name.required" => "Nama kategori harus diisi!",
            "name.unique" => "Nama kategori harus unik!",
        ]);

        $this->categoryService->createCategory($validatedData);

        return redirect('/categories')->with('success', 'Category added!');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required|unique:categories,name",
        ], [
            "name.required" => "Nama kategori harus diisi!",
            "name.unique" => "Nama kategori harus unik!",
        ]);

        $this->categoryService->updateCategory($id, $validatedData);

        return redirect('/categories')->with('success', 'Category has been changed!');
    }

    public function delete($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect('/categories')->with('success', 'Category deleted!');
    }
}
