<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ItemSpecification extends Model
{
    protected $fillable = [
        'item_id', 'specification_id', 'description'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function specification()
    {
        return $this->belongsTo(Specification::class, 'specification_id');
    }

    public static function add(Request $request, Item $item)
    {
        $specifications = $request['specifications'];
        if(isset($item) && isset($specifications))
            foreach ($specifications as $specificationID => $specificationDescription)
                if (isset($specificationDescription))
                    ItemSpecification::create([
                        'item_id' => $item->id,
                        'specification_id' => $specificationID,
                        'description' => $specificationDescription
                    ]);
    }
}
