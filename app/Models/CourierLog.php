<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'order_id',
        'action',
    ];

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
