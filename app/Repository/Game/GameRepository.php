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

    /**
    * Returns an array of the game's boards.
    *
    * Note: 1x previews have been lossless optimized with optipng, while the 2x
    * assets have been compressed with pngquant's default fs8. The original
    * images have been keept in the images-source folder, which does not make
    * itself public.
    *
    * @return array
    */
    public function getBoards()
    {
        $preview_path = 'images/boards';
        $preview_width = 352;
        $preview_height = 244;

        $boards = [
            1 => [
                'id' => 1,
                'name' => 'Νησί',
                'description' => 'Πίστα νησιού',
                'comingsoon' => null,
                'preview' => [
                    'asset' => 'board-island', // extensions: .png, @2x.png
                    'alt' => 'Προεπισκόπηση πίστας νησιού',
                    'public_path' => $preview_path,
                    'width' => $preview_width,
                    'height' => $preview_height,
                ],
            ],
            2 => [
                'id' => 2,
                'name' => 'Βουνό',
                'description' => 'Πίστα βουνού',
                'comingsoon' => null,
                'preview' => [
                    'asset' => 'board-mountain', // extensions: .png, @2x.png
                    'alt' => 'Προεπισκόπηση πίστας νησιού',
                    'public_path' => $preview_path,
                    'width' => $preview_width,
                    'height' => $preview_height,
                ],
            ],
            3 => [
                'id' => 3,
                'name' => 'Πόλη',
                'description' => 'Πίστα πόλης',
                'comingsoon' => true,
                'preview' => [
                    'asset' => 'board-island', // extensions: .png, @2x.png
                    'alt' => 'Προεπισκόπηση πίστας πόλης',
                    'public_path' => $preview_path,
                    'width' => $preview_width,
                    'height' => $preview_height,
                ],
            ],
        ];

        return $boards;
    }

    /**
    * Returns an array of the game's pawns.
    *
    * Note: 1x & 2x previews have been lossless optimized with optipng. The
    * original images have been keept in the images-source folder, which does
    * not make itself public.
    *
    * @return array
    */
    public function getPawns()
    {
        $path = 'images/pawns';
        $width = 136;
        $height = 212;

        $pawns = [
            1 => [
                'id' => 1,
                'name' => 'Ιάσωνας',
                'asset' => 'pawn-iasonas',
                'description' => 'Πιόνι Ιάσωνα',
                'alt' => 'Προεπισκόπηση πιονιού Ιάσωνα',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            2 => [
                'id' => 2,
                'name' => 'Μυρτώ',
                'asset' => 'pawn-myrto',
                'description' => 'Πιόνι Μυρτούς',
                'alt' => 'Προεπισκόπηση πιονιού Μυρτούς',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            3 => [
                'id' => 3,
                'name' => 'Κατερίνα',
                'asset' => 'pawn-katerina',
                'description' => 'Πιόνι Κατερίνας',
                'alt' => 'Προεπισκόπηση πιονιού Κατερίνας',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            4 => [
                'id' => 4,
                'name' => 'Δημήτρης',
                'asset' => 'pawn-dimitris',
                'description' => 'Πιόνι Δημήτρη',
                'alt' => 'Προεπισκόπηση πιονιού Δημήτρη',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            5 => [
                'id' => 5,
                'name' => 'Βασίλης',
                'asset' => 'pawn-vasilis',
                'description' => 'Πιόνι Βασίλη',
                'alt' => 'Προεπισκόπηση πιονιού Βασίλη',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            6 => [
                'id' => 6,
                'name' => 'Ζουμπουλία',
                'asset' => 'pawn-zoumpoulia',
                'description' => 'Πιόνι Ζουμπουλίας',
                'alt' => 'Προεπισκόπηση πιονιού Ζουμπουλίας',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
            7 => [
                'id' => 7,
                'name' => 'Βρασίδας',
                'asset' => 'pawn-vrasidas',
                'description' => 'Πιόνι Βρασίδα',
                'alt' => 'Προεπισκόπηση πιονιού Βρασίδα',
                'public_path' => $path,
                'width' => $width,
                'height' => $height,
            ],
        ];
        return $pawns;
    }
}
