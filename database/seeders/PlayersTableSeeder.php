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

    public function run()
    {
        echo "\nRunning Player Seeder...\n";

        $player_ids = $this->playerRepository->allWhere(['user_id' => 2], ['id'])->pluck('id')->all();
        if (count($player_ids) == 0) {
            $data = [
                ['user_id' => 2, 'name' => 'Κώστας Παπ.', 'avatar_id' => 5],
                ['user_id' => 2, 'name' => 'Νίκη Καραγ.', 'avatar_id' => 3],
            ];
            foreach ($data as $entry) {
                $player = $this->playerRepository->create($entry);
                echo "\nAdded Player: " . $player->name . "\n";
            }
        }
    }
}
