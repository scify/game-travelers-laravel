<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Repository\User\UserRole\UserRoleLkpRepository;
use Illuminate\Database\Seeder;

class UserRoleLkpTableSeeder extends Seeder
{
    public function __construct(protected UserRoleLkpRepository $userRoleLkpRepository) {}

    public function run(): void
    {
        echo "\nRunning User Role lkp Seeder...\n";

        $data = [
            ['id' => 1, 'name' => 'Platform Administrator'],
            ['id' => 2, 'name' => 'Registered User'],
        ];
        foreach ($data as $userRoleLkp) {
            $role = $this->userRoleLkpRepository->updateOrCreate(['id' => $userRoleLkp['id']], $userRoleLkp);
            echo "\nAdded User Role: " . $role->name . "\n";
        }
    }
}
