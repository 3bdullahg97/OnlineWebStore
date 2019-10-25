<?php


namespace App\Managers;

use App\Item;
use App\ItemImage;
use App\ItemSpecification;
use Illuminate\Http\Request;


class ItemManager
{
    public static function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => 'string|min:5|max:50|required',
            'price' => 'numeric|required',
            'quantity' => 'integer|min:1|required',
            'brand' => 'integer|required',
            'category' => 'integer|required',
            'description' => 'string|min:5|required',
        ]);

        $item = Item::add($validatedRequest);
        ItemImage::add($request, $item);
        ItemSpecification::add($request, $item);
    }

    public static function delete(Item $item)
    {
        $item->deleteMultipleImages();
        $item->delete();
    }
}
