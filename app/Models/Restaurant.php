<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'manager_id',
        'status',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'restaurant_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'restaurant_id');
    }

    public function restaurantLogs()
    {
        return $this->hasMany(RestaurantLog::class, 'restaurant_id');
    }
}
