<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'items_data',
        'delivery_address',
        'delivery_message',
        'payment_method'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'items_data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
