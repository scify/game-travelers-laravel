<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\UserRole\UserRole;
use App\Models\UserRole\UserRoleLkp;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'email',
    'password',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The relationships that are loaded by default
     *
     * @var list<string>
     */
    protected $with = ['roles'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(UserRoleLkp::class, 'user_roles', 'user_id', 'role_id')
            ->wherePivot('deleted_at', null);
    }

    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
