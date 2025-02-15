<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user can manage one restaurant (if they are a restaurant manager)
    public function managedRestaurant()
    {
        return $this->hasOne(Restaurant::class, 'manager_id');
    }

    // A user can place many orders (if they are a customer)
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // A user can deliver many orders (if they are a courier)
    public function deliveredOrders()
    {
        return $this->hasMany(Order::class, 'courier_id');
    }

    // A user can have many courier logs (if they are a courier)
    public function courierLogs()
    {
        return $this->hasMany(CourierLog::class, 'courier_id');
    }

    // Check if the user is a restaurant manager
    public function isRestaurantManager(): bool
    {
        return $this->role === 'restaurant_manager';
    }

    // Check if the user is a customer
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    // Check if the user is a courier
    public function isCourier(): bool
    {
        return $this->role === 'courier';
    }

    // Check if the user is an admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
