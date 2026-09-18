<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id', 'user_id', 'player_id', 'board_id', 'mode_id', 'pawn_id_1', 'pawn_id_2', 'use_tutorial', 'location_1', 'location_2', 'active', 'first_player_turn', 'started', 'selected_board_size', 'game_phase', 'latest_random_result',
])]
#[Table(name: 'games')]
class Game extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }
}
