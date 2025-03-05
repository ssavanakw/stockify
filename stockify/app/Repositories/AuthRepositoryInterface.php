<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function findUserByEmail(string $email);
    public function attemptLogin(array $credentials);
    public function logout();
}
