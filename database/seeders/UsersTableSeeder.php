<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Repository\User\UserRepository;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function __construct(protected UserRepository $userRepository) {}

    public function run(): void
    {
        echo "\nRunning User Seeder...\n";
        echo config()->string('app.seed_password') . "\n";

        // Seeds only an empty users table, so existing accounts are never touched.
        $existing_ids = $this->userRepository->allWhere([], ['id'])->pluck('id')->all();
        if (count($existing_ids) === 0) {
            $data = [
                [
                    'id' => 1,
                    'email' => 'admin-taxidiotes@scify.org',
                    'password' => bcrypt(config()->string('app.seed_password')),
                ],
                [
                    'id' => 2,
                    'email' => 'user-taxidiotes@scify.org',
                    'password' => bcrypt(config()->string('app.seed_password')),
                ],
            ];

            foreach ($data as $user) {
                $user = $this->userRepository->updateOrCreate(['id' => $user['id']],
                    $user);
                echo "\nAdded User: " . $user->email . "\n";
            }
        }
    }
}
