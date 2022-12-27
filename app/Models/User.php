<?php

namespace App\Models;

use App\Models\UserRole\UserRole;
use App\Models\UserRole\UserRoleLkp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The relationships that are loaded by default
     *
     * @var array
     */
    protected $with = ['roles'];

    public function roles(): BelongsToMany {
        return $this->belongsToMany(UserRoleLkp::class, 'user_roles', 'user_id', 'role_id')
            ->wherePivot('deleted_at', null);
    }

    public function userRoles(): HasMany {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }
}
