<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'logo'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

    public function specificationGroups()
    {
        return $this->hasMany(SpecificationGroup::class, 'category_id');
    }
}
