<?php

namespace App\Repository\User\UserRole;

abstract class UserRolesLkp {
    //ATTENTION: these values match with the db values defined in database\seeders\UsersRoleLkpTableSeeder.php
    const ADMIN = 1;
    const USER = 2;
}
