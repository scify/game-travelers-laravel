<?php

declare(strict_types=1);

namespace App\Models\UserRole;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'role_id', 'user_id',
])]
#[Table(name: 'user_roles')]
class UserRole extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRoleLkp::class, 'role_id', 'id');
    }
}
