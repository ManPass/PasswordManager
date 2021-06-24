<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use RoleRecords;

class users extends Authenticatable
{
    use HasFactory,Notifiable;

    function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }
}
