<?php

namespace App\Repository\Player;

use App\Models\Player;
use App\Repository\Repository;

class PlayerRepository extends Repository
{
    public function getModelClassName()
    {
        return Player::class;
    }

    public function getAvatars()
    {
        $width = 100;
        $height = 100;
        $avatars = [
            1 => [  // Avatar's Unique ID
                'id' => 1, // Repeating id for convenience.
                'asset' => 'boy-1', // Extensions .png, @2x.png and svg implied.
                'description' => 'Φατσούλα αγοριού με καστανά μαλιά', // For "alt".
                'public_path' => 'images/avatars', // Public path of all avatars.
                'width' => $width, // Dimensions for all avatars (100x100px/1:1 ratio).
                'height' => $height,
            ],
            2 => [  // Avatar's Unique ID
                'id' => 2, // Repeating id for convenience.
                'asset' => 'boy-2', // Extensions .png, @2x.png and svg implied.
                'description' => 'Φατσούλα αγοριού με μαύρα μαλιά', // For "alt".
                'public_path' => 'images/avatars', // Public path of all avatars.
                'width' => $width, // Dimensions for all avatars (100x100px/1:1 ratio).
                'height' => $height,
            ],
            3 => [  // Avatar's Unique ID
                'id' => 3, // Repeating id for convenience.
                'asset' => 'girl-1', // Extensions .png, @2x.png and svg implied.
                'description' => 'Φατσούλα κοριτσιού με μαύρα μαλιά', // For "alt".
                'public_path' => 'images/avatars', // Public path of all avatars.
                'width' => $width, // Dimensions for all avatars (100x100px/1:1 ratio).
                'height' => $height,
            ],
            4 => [  // Avatar's Unique ID
                'id' => 4, // Repeating id for convenience.
                'asset' => 'girl-2', // Extensions .png, @2x.png and svg implied.
                'description' => 'Φατσούλα κοριτσιού με ξανθά μαλιά', // For "alt".
                'public_path' => 'images/avatars', // Public path of all avatars.
                'width' => $width, // Dimensions for all avatars (100x100px/1:1 ratio).
                'height' => $height,
            ],
            5 => [  // Avatar's Unique ID
                'id' => 5, // Repeating id for convenience.
                'asset' => 'dog', // Extensions .png, @2x.png and svg implied.
                'description' => 'Φατσούλα σκύλου', // For "alt".
                'public_path' => 'images/avatars', // Public path of all avatars.
                'width' => $width, // Dimensions for all avatars (100x100px/1:1 ratio).
                'height' => $height,
            ],
            6 => [  // Avatar's Unique ID
                'id' => 6, // Repeating id for convenience.
                'asset' => 'cat', // Extensions .png, @2x.png and svg implied.
                'description' => 'Φατσούλα γατούλας', // For "alt".
                'public_path' => 'images/avatars', // Public path of all avatars.
                'width' => $width, // Dimensions for all avatars (100x100px/1:1 ratio).
                'height' => $height,
            ],

        ];
        return $avatars;
    }

    public function playerExists(int $player_id, int $user_id): bool
    {
        return Player::where(['id' => $player_id, 'user_id' => $user_id])->exists();
    }
}
