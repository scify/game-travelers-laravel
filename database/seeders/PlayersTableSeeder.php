<?php

namespace Database\Seeders;

use App\Repository\Player\PlayerRepository;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Integer;

class PlayersTableSeeder extends Seeder
{

    protected PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    protected function __next_id(array $ids)
    {
        if (count($ids) == 0)
            return 1;
        else
            return max($ids) + 1;
    }

    public function run()
    {
        echo "\nRunning Player Seeder...\n";

        $ids = $this->playerRepository->allWhere(['user_id' => 2], ['id'])->pluck('id')->all();
        if (count($ids) == 0) {
            $data = [
                ['user_id' => 2, 'name' => 'Κώστας Παπ.', 'avatar_id' => 5],
                ['user_id' => 2, 'name' => 'Νίκη Καραγ.', 'avatar_id' => 3],
            ];
            foreach ($data as $entry) {
                $ids = $this->playerRepository->allWhere(['user_id' => $entry['user_id']], ['id'])->pluck('id')->all();
                $entry ['id'] = $this->__next_id($ids);
                $player = $this->playerRepository->updateOrCreate(['id' => $entry['id'], 'user_id' => $entry['user_id']], $entry);
                echo "\nAdded Player: " . $player->name . "\n";
            }
        }
    }
}
