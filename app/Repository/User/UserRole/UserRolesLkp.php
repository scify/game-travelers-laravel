<?php

declare(strict_types=1);

namespace App\Repository\User\UserRole;

abstract class UserRolesLkp
{
    // ATTENTION: these values match with the db values defined in database\seeders\UsersRoleLkpTableSeeder.php
    public const ADMIN = 1;

    public const USER = 2;
}
