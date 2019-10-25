<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemImage;
use Illuminate\Http\Request;

class ItemImageController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $this->authorize('create', ItemImage::class);

        ItemImage::add($request, $item);

        return redirect()->back();
    }

    public function update(Request $request, ItemImage $itemImage)
    {
        $this->authorize('update', $itemImage);

        $itemImage->edit($request);

        return redirect()->back();
    }

    public function destroy(ItemImage $itemImage)
    {
        $this->authorize('delete', $itemImage);

        $itemImage->deleteImage();

        return redirect()->back();
    }
}
