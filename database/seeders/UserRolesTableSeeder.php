<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\BusinessLogicLayer\User\UserRole\UserRoleManager;
use App\Repository\User\UserRepository;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    public function __construct(protected UserRepository $userRepository, protected UserRoleManager $userRoleManager) {}

    public function run(): void
    {
        echo "\nRunning User Role Seeder...\n";

        $this->userRoleManager->assignAdminUserRoleTo($this->userRepository->find(1));
        $this->userRoleManager->assignRegisteredUserRoleTo($this->userRepository->find(2));
    }
}
