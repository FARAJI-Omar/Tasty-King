<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'photo', 'password', 'status', 'role'];

    protected $hidden = ['password'];

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

}
