<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'price', 'brand_id', 'category_id', 'description', 'quantity'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function specifications()
    {
        return $this->hasMany(ItemSpecification::class, 'item_id');
    }

    public function specification($specificationID)
    {
        if ($specification = ItemSpecification::all()->where('item_id', '=', $this->id)
            ->where('specification_id', '=', $specificationID)->first())
            return $specification->description;
        else
            return null;
    }

    public static function add($request)
    {
        return self::create([
            'name'          => $request['name'],
            'brand_id'      => $request['brand'],
            'category_id'   => $request['category'],
            'quantity'      => $request['quantity'],
            'price'         => $request['price'],
            'description'   => $request['description']
        ]);
    }

    public function deleteMultipleImages()
    {
        $images = $this->images;
        foreach($images as $image)
            $image->deleteImage();
    }

    public function reserve($numberOfReservedItems)
    {
        if($this->quantity >= $numberOfReservedItems)
        {
            $this->quantity -= $numberOfReservedItems;
            $this->save();
            return true;
        }
        else
            return false;
    }

    public function rating() : float
    {
        $total = 0;
        $reviews = Review::where('item_id', '=', $this->id)->get();
        $count = count($reviews);
        foreach ($reviews as $review)
            $total += $review->rating;

        if ($count == 0)
            return 0;
        else
            return $total/(float)$count;
    }
}
