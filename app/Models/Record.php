<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public $timestamps = false;
    protected $fillable = ['source', 'password', 'login', 'url', 'comment', 'tag'];
    use HasFactory;

    

    function roleRecords()
    {
        return $this->hasMany(RoleRecord::class, 'records_id');
    }

    function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_records');
    }
}
