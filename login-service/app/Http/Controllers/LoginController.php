<?php

namespace App\Http\Controllers;

use App\Facades\ResponseFormatter;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class LoginController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->only('mobile', 'password');
        $token = $this->authService->login($credentials);

        if ($token) {
            return ResponseFormatter::success(['token' => $token]);
        } else {
            return ResponseFormatter::error('Unauthorized', 401);
        }
    }
}
