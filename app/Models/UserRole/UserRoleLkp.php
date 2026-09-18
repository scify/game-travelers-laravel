<?php

declare(strict_types=1);

namespace App\Models\UserRole;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'id', 'name',
])]
#[Table(name: 'user_roles_lkp')]
class UserRoleLkp extends Model
{
    use SoftDeletes;
}
