<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory,Notifiable;
    protected $fillable = ['login','password'];
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    public function record()
    {
        return $this->belongsToMany('App\Models\Record');
    }
}
