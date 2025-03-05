<?php

namespace App\Services;

use App\Repositories\MaterialRepository;

class MaterialService
{
    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function getAllMaterials()
    {
        return $this->materialRepository->getAll();
    }

    public function getMaterialById($id)
    {
        return $this->materialRepository->getById($id);
    }

    public function createMaterial(array $data)
    {
        return $this->materialRepository->create($data);
    }

    public function updateMaterial($id, array $data)
    {
        return $this->materialRepository->update($id, $data);
    }

    public function deleteMaterial($id)
    {
        return $this->materialRepository->delete($id);
    }
}
