<?php

namespace App\Repositories;

use App\Models\Material;

class MaterialRepository implements MaterialRepositoryInterface
{
    public function getAll()
    {
        return Material::with('category')->paginate(10);
    }

    public function getById($id)
    {
        return Material::findOrFail($id);
    }

    public function create(array $data)
    {
        return Material::create($data);
    }

    public function update($id, array $data)
    {
        $material = Material::findOrFail($id);
        $material->update($data);
        return $material;
    }

    public function delete($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
    }
}
