<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use RoleRecords;

class User extends Authenticatable
{
    
    use HasFactory,Notifiable;

    function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    function record()
    {
        return $this->hasOne('App\Models\Record');
    }
}
