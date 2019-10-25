<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationGroup extends Model
{
    protected $fillable = [
        'category_id', 'group_name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'group_id');
    }

    public static function add($request)
    {
        if (isset($request['groups'])) {
            $groups = $request['groups'];
            foreach ($groups as $group) {
                if (!isset($group['name']))
                    continue;

                self::create([
                    'category_id' => Category::all()->last()->id,
                    'group_name' => $group['name']
                ]);
                Specification::add($group['specifications']);
            }
        }
    }


    public static function updateMultipleGroups($groups)
    {
        if (isset($groups)) {
            foreach($groups as $groupID => $groupValue) {
                if (!isset($groupValue['name']))
                    continue;
                $group = SpecificationGroup::find($groupID);
                $group->update(['group_name' => $groupValue['name']]);
                if (isset($groupValue['specifications']))
                    Specification::updateMultipleSpecifications($groupValue['specifications']);
            }
        }
    }

    public function hasSpecifications(Item $item)
    {
        foreach ($this->specifications as $specification)
            if ($item->specification($specification->id))
                return true;

        return false;
    }
}
