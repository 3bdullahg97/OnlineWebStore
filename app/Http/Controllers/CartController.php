<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart');
        $total = 0;
        return view('cart', compact('cart', 'total'));
    }

    public function addToCart(Item $item, Request $request)
    {
        $validatedRequest = $request->validate([
           'quantity' => 'integer|min:1|required'
        ]);

        $quantity = $validatedRequest['quantity'];

        $cart = Session::get('cart');
        # Case 1: if first item
        if(!isset($cart)) {
            $cart[$item->id] = [
                  'item'     => $item,
                  'quantity' => $quantity
            ];
            Session::put('cart', $cart);

            return redirect()->back();
            # Case 2: if item exist
        } elseif(isset($cart[$item->id])) {
            $cart[$item->id]['quantity'] += $quantity;
            Session::put('cart', $cart);

            return redirect()->back();
            # Case 3: if item does not exist
        } else {
            $cart[$item->id] = [
                'item'     => $item,
                'quantity' => $quantity
            ];
            Session::put('cart', $cart);

            return redirect()->back();
        }
    }

    public function removeFromCart(Item $item)
    {
        $cart = Session::get('cart');
        unset($cart[$item->id]);
        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function clearCart()
    {
        $cart = Session::get('cart');
        if(isset($cart))
            Session::remove('cart');

        return redirect()->back();
    }

    public function update(Request $request, Item $item)
    {
        $cart = Session::get('cart');
        $cart[$item->id]['quantity'] = $request['quantity'];
        Session::put('cart', $cart);

        return redirect()->back();
    }
}
