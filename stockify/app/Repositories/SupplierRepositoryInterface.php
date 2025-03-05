<?php

namespace App\Repositories;

interface SupplierRepositoryInterface
{
    public function getPaginatedSuppliers($perPage);

    public function createSupplier(array $data);

    public function getSupplierById($id);

    public function updateSupplier($id, array $data);

    public function deleteSupplier($id);
}
