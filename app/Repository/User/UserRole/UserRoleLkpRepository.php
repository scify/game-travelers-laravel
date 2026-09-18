<?php

declare(strict_types=1);

namespace App\Repository\User\UserRole;

use App\Models\UserRole\UserRoleLkp;
use App\Repository\Repository;

class UserRoleLkpRepository extends Repository
{
    public function getModelClassName(): string
    {
        return UserRoleLkp::class;
    }
}
