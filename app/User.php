<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public static function add(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone']
        ]);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function review(Item $item)
    {
        return $this->hasOne(Review::class, 'user_id')
            ->where('item_id', '=', $item->id)->first();
    }

    public function hasOrderItem($givenItem) : bool
    {
        foreach ($this->orders as $order)
        {
            if ($order->status !== 1)
                continue;
            foreach ($order->items as $item)
                if ($item->item->id == $givenItem->id)
                    return true;
        }

                return false;
    }

}
