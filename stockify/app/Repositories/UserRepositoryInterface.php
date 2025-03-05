<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function updatePassword($id, $newPassword);

    public function delete($id);
}
