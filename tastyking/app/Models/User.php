<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'photo', 'password', 'primary_address', 'status', 'role'];

    protected $hidden = ['password'];
}
