<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class client extends Authenticatable
{
    protected $fillable = ['name', 'email', 'photo', 'password', 'primary_address', 'status'];

    protected $hidden = ['password'];
}
