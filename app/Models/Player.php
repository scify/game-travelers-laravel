<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id', 'user_id', 'name', 'avatar_id', 'auto', 'select_key', 'navigate_key', 'help_after_x_mistakes', 'scanning_speed', 'dice_type', 'board_size', 'difficulty', 'movement_mode', 'music_volume', 'sound_volume'
    ];

    use SoftDeletes;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
