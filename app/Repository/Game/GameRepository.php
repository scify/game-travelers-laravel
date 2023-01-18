<?php

namespace App\Repository\Game;

use App\Models\Game;
use App\Repository\Repository;

class GameRepository extends Repository
{
    public function getModelClassName()
    {
        return Game::class;
    }

    public function getPawns()
    {
        $path = 'images/pawns';
        $width = 136;
        $height = 212;

        $pawns = [
            1 => [
                'id' => 1,
                'asset' => 'pawn-iasonas',
                'name' => 'Ιάσωνας',
                'alt' => 'Προεπισκόπηση πιονιού Ιάσωνα',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            2 => [
                'id' => 2,
                'asset' => 'pawn-myrto',
                'name' => 'Μυρτώ',
                'alt' => 'Προεπισκόπηση πιονιού Μυρτούς',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            3 => [
                'id' => 3,
                'asset' => 'pawn-katerina',
                'name' => 'Κατερίνα',
                'alt' => 'Προεπισκόπηση πιονιού Κατερίνας',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            4 => [
                'id' => 4,
                'asset' => 'pawn-dimitris',
                'name' => 'Δημήτρης',
                'alt' => 'Προεπισκόπηση πιονιού Δημήτρη',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            5 => [
                'id' => 5,
                'asset' => 'pawn-vasilis',
                'name' => 'Βασίλης',
                'alt' => 'Προεπισκόπηση πιονιού Βασίλη',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            6 => [
                'id' => 6,
                'asset' => 'pawn-zoumpoulia',
                'name' => 'Ζουμπουλία',
                'alt' => 'Προεπισκόπηση πιονιού Ζουμπουλίας',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            7 => [
                'id' => 7,
                'asset' => 'pawn-vrasidas',
                'name' => 'Βρασίδας',
                'alt' => 'Προεπισκόπηση πιονιού Βρασίδα',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
        ];
        return $pawns;
    }
}
