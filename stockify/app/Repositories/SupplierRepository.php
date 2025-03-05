<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getPaginatedSuppliers($perPage)
    {
        return Supplier::paginate($perPage);
    }

    public function createSupplier(array $data)
    {
        return Supplier::create($data);
    }

    public function getSupplierById($id)
    {
        return Supplier::findOrFail($id);
    }

    public function updateSupplier($id, array $data)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return $supplier->delete();
    }
}
