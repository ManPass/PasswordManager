<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleRecord extends Model
{
    use HasFactory;

    protected $fillable = ['user_role_id', 'records_id'];

    public $timestamps = false;

    function userRoles()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id', 'id');
    }

    function records()
    {
        return $this->belongsTo(Records::class, 'records_id', 'id');
    }
}
