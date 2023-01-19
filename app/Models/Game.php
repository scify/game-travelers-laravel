<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'id', 'user_id', 'player_id', 'board_id', 'mode_id', 'pawn_id_1', 'pawn_id_2', 'use_tutorial', 'location_1', 'location_2', 'active', 'first_player_turn', 'started', 'selected_board_size', 'game_phase',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }
}
