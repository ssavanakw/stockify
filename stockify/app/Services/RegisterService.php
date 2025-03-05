<?php

namespace App\Services;

use App\Repositories\RegisterRepository;

class RegisterService
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function registerUser(array $data)
    {
        return $this->registerRepository->createUser($data);
    }
}
