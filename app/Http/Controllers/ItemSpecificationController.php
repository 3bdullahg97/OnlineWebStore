<?php

namespace App\Http\Controllers;

use App\ItemSpecification;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemSpecificationController extends Controller
{
    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $itemSpecifications = $request['itemSpecifications'];
        if (isset($itemSpecifications))
            foreach ($itemSpecifications as $specificationID => $description) {
                if ($item_specification = ItemSpecification::all()
                    ->where('specification_id', '=', $specificationID)
                    ->where('item_id', '=', $item->id)->first())
                    DB::table('item_specifications')
                        ->where('specification_id', '=', $specificationID)
                        ->where('item_id', '=', $item->id)
                        ->update(['description' => $description]);
                else
                    ItemSpecification::create([
                        'specification_id' => $specificationID,
                        'item_id'          => $item->id,
                        'description'      => $description
                    ]);

            }

        return redirect()->back();
    }
}
