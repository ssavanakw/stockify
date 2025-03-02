<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Repositories\MaterialRepositoryInterface;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    protected $materialRepository;

    public function __construct(MaterialRepositoryInterface $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function index()
    {
        // $materials = Material::with('category')->paginate(10);

        $materials = $this->materialRepository->getAll();

        return view('pages.materials.index', compact('materials'));

        // return view('pages.materials.index',[
        //     "materials" => $materials,
        // ]);
    }
    public function create()
    {
        $categories = Category::all();

        return view('pages.materials.create',[
            "categories" => $categories,
        ]);
    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            "name" => "required|min:3",
            "description" => "nullable",
            "price" => "required",
            "stock" => "required",
            "category_id" => "required",
        ]);

        // Material::create($validated);

        $this->materialRepository->create($validated);

        return redirect('/materials')->with('success', 'Material added successfully');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $materials = Material::findOrFail($id);

        return view('pages.materials.edit',[
            "categories" => $categories,
            "material" => $materials,
        ]);
    }

    public function update(Request $request, $id)
    {
        // $validated=$request->validate([
        //     "name" => "required|min:3",
        //     "description" => "nullable",
        //     "price" => "required",
        //     "stock" => "required",
        //     "category_id" => "required",
        // ]);

        // Material::where('id', $id)->update([
        // "name" => $request->input('name'),
        // "price" => $request->input('price'),
        // "stock" => $request->input('stock'),
        // "description" => $request->input('description'),
        // "category_id" => $request->input('category_id'),
        // ]);

        // return redirect('/materials');

        $validated = $request->validate([
            "name" => "required|min:3",
            "description" => "nullable",
            "price" => "required",
            "stock" => "required",
            "category_id" => "required",
        ]);
    
        $this->materialRepository->update($id, $validated);
    
        return redirect('/materials')->with('success', 'Material updated successfully.');
    
    }


    public function delete($id)
    {
        $this->materialRepository->delete($id);

        return redirect('/materials')->with('success', 'Material deleted successfully.');

        
        // $materials = Material::where('id',$id);
        // $materials->delete();

        // return redirect('/materials');
    }
}