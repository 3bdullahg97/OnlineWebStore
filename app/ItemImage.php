<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemImage extends Model
{
    protected $fillable = [
        'item_id', 'image_path'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public static function add(Request $request, Item $item)
    {
        $validatedRequest = $request->validate([
           'images.*' => 'image'
        ]);

        if(isset ($validatedRequest['images']))
        {
            $images = $validatedRequest['images'];
            foreach($images as $image)
                self::create([
                    'item_id' => $item->id,
                    'image_path' => '/storage/' . $image->store('items/' . $item->id, 'public')
                ]);
        }

    }

    public function edit(Request $request)
    {
        $validatedRequest = $request->validate([
            'updatedImage.*' => 'image|required'
        ]);
        Storage::disk('public')->delete($this->image_path);
        $images = $validatedRequest['updatedImage'];
        if (isset($images))
            foreach ($images as $image)
                $this->update([
                    'image_path' => '/storage/' . $image->store('items/' . $this->item->id, 'public')
                ]);
    }

    public function deleteImage()
    {
        Storage::disk('public')->delete($this->image_path);
        $this->delete();
    }
}

