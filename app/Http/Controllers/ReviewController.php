<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use App\Item;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request, Item $item)
    {
        $this->authorize('create', Review::class);
        $validatedRequest = $request->validate([
            'rating' => 'integer|min:1|max:5|required',
            'comment' => 'string|min:5|required',
        ]);

        $user = User::find(auth()->id());
        Review::add($validatedRequest, $user, $item);

        return redirect()->back();
    }

    public function show(Review $review)
    {
        //
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete',  $review);
        $review->delete();

        return redirect()->back();
    }
}
