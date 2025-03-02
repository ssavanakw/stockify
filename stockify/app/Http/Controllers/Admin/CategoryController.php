<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return view('pages.categories.index',compact('categories'));
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
            "name.unique" => "Nama kategori harus ada!",
        ]);

        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->slug = Str::slug($request->input('name'));
        // $category->save();

        // return redirect('/categories');

        $data = [
            "name" => $request->input('name'),
            "slug" => \Illuminate\Support\Str::slug($request->input('name')),
        ];
    
        $this->categoryRepository->create($data);
    
        return redirect('/categories')->with('success', 'Category added!');

    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required|unique:categories,name",
        ], [
            "name.required" => "Nama kategori harus diisi!",
            "name.unique" => "Nama kategori harus beda!",
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->save();

        return redirect('/categories')->with('success', 'Category has been changed!');

    }
    
    public function delete($id)
    {
        Category::where('id', $id)->delete();

        return redirect('/categories')->with('success', 'Categoy deleted!');
    }

}
