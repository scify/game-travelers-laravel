<?php

namespace App\Repository\Game;

use App\Models\Game;
use App\Repository\Repository;

class GameRepository extends Repository
{
    public function getModelClassName() {
        return Game::class;
    }
}
