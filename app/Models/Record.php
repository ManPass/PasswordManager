<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public $timestamps = false;
    protected $fillable = ['source', 'password', 'login', 'url', 'comment', 'tag'];
    use HasFactory;

    public function getPasswordAttribute()
    {
        return decrypt($this->attributes['password']);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = encrypt($value);
    }

    function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_records', 'records_id', 'role_id');
    }

}
