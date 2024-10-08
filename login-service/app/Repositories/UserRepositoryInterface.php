<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByMobile(string $mobile): ?User;
}
