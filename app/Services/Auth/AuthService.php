<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepositories;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositories $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        return $this->authRepository->register($data);
    }

    public function login(array $data)
    {
        return $this->authRepository->login($data);
    }
}
