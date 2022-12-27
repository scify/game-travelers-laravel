<?php

namespace Database\Seeders;

use App\BusinessLogicLayer\User\UserRole\UserRoleManager;
use App\Repository\User\UserRepository;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder {
    protected $userRepository;
    protected $userRoleManager;

    public function __construct(UserRepository $userRepository, UserRoleManager $userRoleManager) {
        $this->userRepository = $userRepository;
        $this->userRoleManager = $userRoleManager;
    }

    public function run() {
        echo "\nRunning User Role Seeder...\n";

        $this->userRoleManager->assignAdminUserRoleTo($this->userRepository->find(1));
        $this->userRoleManager->assignRegisteredUserRoleTo($this->userRepository->find(2));
    }
}
