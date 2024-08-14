<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findByMobile(string $mobile): ?User
    {
        return User::where('mobile', $mobile)->first();
    }
}
