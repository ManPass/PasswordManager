<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['role'];
    use HasFactory;

    function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'user_roles');
    }

    function records()
    {
        return $this->belongsToMany('App\Models\Record', 'role_records', 'role_id', 'records_id');
    }
}
