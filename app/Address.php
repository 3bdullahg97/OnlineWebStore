<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'street', 'city', 'postal_code', 'country'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add(array $data, User $user)
    {
        return self::create([
            'user_id'     => $user->id,
            'street'      => $data['street'],
            'city'        => $data['city'],
            'postal_code' => $data['postal_code'],
            'country'     => $data['country']
        ]);
    }
}
