<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getPaginatedSuppliers($perPage)
    {
        return $this->supplierRepository->getPaginatedSuppliers($perPage);
    }

    public function createSupplier($data)
    {
        return $this->supplierRepository->createSupplier($data);
    }

    public function getSupplierById($id)
    {
        return $this->supplierRepository->getSupplierById($id);
    }

    public function updateSupplier($id, $data)
    {
        return $this->supplierRepository->updateSupplier($id, $data);
    }

    public function deleteSupplier($id)
    {
        return $this->supplierRepository->deleteSupplier($id);
    }
}
