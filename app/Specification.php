<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Specification extends Model
{
    protected $fillable = [
        'group_id', 'name'
    ];

    public function group()
    {
        return $this->belongsTo( SpecificationGroup::class, 'group_id');
    }

    public function description($itemID)
    {
        return $this->hasMany(ItemSpecification::class, 'specification_id')
            ->where('item_id', '=', $itemID)->first()->description;
    }

    public static function add($specifications)
    {
        if (isset($specifications))
            foreach ($specifications as $specification)
            {
                if (!isset($specification))
                    continue;

                self::create([
                    'group_id' => SpecificationGroup::all()->last()->id,
                    'name' => $specification
                ]);
            }
    }

    public static function updateMultipleSpecifications($specifications)
    {
        foreach($specifications as $specificationID => $specificationValue) {
            if (!isset($specificationValue))
                continue;
            $specification = Specification::find($specificationID);
            $specification->update([ 'name' => $specificationValue]);
        }
    }
}
