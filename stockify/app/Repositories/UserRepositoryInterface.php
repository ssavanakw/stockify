<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById($id); // Tambahkan ini
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
