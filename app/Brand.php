<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'description', 'logo', 'color'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'brand_id');
    }
}
