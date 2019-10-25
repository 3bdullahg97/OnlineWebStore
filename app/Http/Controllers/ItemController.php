<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Item;
use App\Review;
use App\Managers\ItemManager;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items =  Item::paginate(15);

        return view('items.index', compact('items'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Item::class);

        $items = Item::paginate(15);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.items.index', compact('items', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Item::class);

       ItemManager::create($request);

        return redirect()->back();
    }

    public function show(Item $item)
    {
        $specificationGroups = $item->category->specificationGroups;

        $reviews = Review::where('item_id', '=', $item->id)->get();

        $relatedItems = Item::paginate(4);

        $brandProducts = Item::paginate(4)->where('brand_id', '=', $item->brand->id);

        $itemSpecifications = $item->specifications();
        return view('items.show', compact('item', 'specificationGroups',
            'reviews', 'authReview', 'relatedItems', 'brandProducts', 'itemSpecifications'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);

        $categories = Category::all();
        $brands     = Brand::all();
        $images     = $item->images;
        return view('admin.items.edit', compact('item', 'categories' ,'brands', 'images'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validatedRequest = $request->validate([
            'name' => 'string|min:5|max:50|required',
            'price' => 'numeric|required',
            'quantity' => 'integer|min:1|required',
            'brand_id' => 'integer|required',
            'category_id' => 'integer|required',
            'description' => 'string|min:5|required',
        ]);

        $item->update($validatedRequest);

        return redirect()->back();
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        ItemManager::delete($item);

        return redirect()->back();
    }
}
