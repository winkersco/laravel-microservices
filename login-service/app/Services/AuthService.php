<?php

namespace App\Services;

use App\Events\UserLoggedIn;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
    ) {}

    public function login(array $credentials): ?string
    {
        $user = $this->userRepository->findByMobile($credentials['mobile']);

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;

            event(new UserLoggedIn($user, Carbon::now()->toIso8601String()));

            return $token;
        }

        return null;
    }
}
