<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;
    use HasFactory;

    function users()
    {
        return $this->belongsTo(users::class, 'user_id', 'id');
    }

    function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    function roleRecords()
    {
        return $this->hasMany(RoleRecord::class, 'user_role_id');
    }

}
