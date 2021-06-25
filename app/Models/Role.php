<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    use HasFactory;

    function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'role_id');
    }

    function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User');
    }

    function records()
    {
        return $this->belongsToMany('App\Models\Record', 'role_records', 'user_role_id', 'records_id');
    }


}
