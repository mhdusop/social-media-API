<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

/**
 * import request
 */

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

/**
 * import resource
 */

use App\Http\Resources\Auth\AuthResource;

/**
 * import service
 */

use App\Services\Auth\AuthService;
use Exception;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authService->register($request->validated());
            return new AuthResource(true, 'User registered successfully', $user);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request->validated());
            if ($token) {
                return new AuthResource(true, 'Login successful', ['token' => $token]);
            }
            return new AuthResource(false, 'Invalid credentials', 401);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
