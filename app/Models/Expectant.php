<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expectant extends Model
{
    use HasFactory;
    protected $fillable = ['login','password','token'];
}
