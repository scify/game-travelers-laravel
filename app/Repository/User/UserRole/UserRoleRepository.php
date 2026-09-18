<?php

declare(strict_types=1);

namespace App\Repository\User\UserRole;

use App\Models\UserRole\UserRole;
use App\Repository\Repository;

class UserRoleRepository extends Repository
{
    public function getModelClassName()
    {
        return UserRole::class;
    }

    public function getUserRoleWithTrashed($data)
    {
        return UserRole::query()->where($data)->withTrashed()->first();
    }
}
