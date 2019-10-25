<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    protected $fillable = [
        'item_id', 'user_id', 'rating', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public static function add(Request $request, User $user, Item $item)
    {
        return self::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'rating'  => $request['rating'],
            'comment' => $request['comment']
        ]);
    }
}
