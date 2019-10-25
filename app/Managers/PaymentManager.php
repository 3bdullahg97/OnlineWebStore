<?php

namespace App\Managers;

use App\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use App\Order;

class PaymentManager
{
    public static function createOnDeliveryOrder(User $user, Request $request)
    {
        $items = Session::get('cart');
        $order = Order::create([
            'user_id' => $user->id,
            'status'  => 0,
            'payment_method' => 0,
            'address_id' => $request['address'],
        ]);
        foreach ($items as $item)
        {
            if ($item['item']->reserve($item['quantity']))
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => $item['item']->id,
                    'quantity' => $item['quantity']
                ]);
        }
        Session::remove('cart');

    }

    public static function createPaypalOrder(User $user, Request $request)
    {
        $order = Order::create([
            'user_id' => $user->id,
            'status'  => 0,
            'payment_method' => 1,
            'address_id' => $request['address'],
        ]);

        $cartItems = Session::get('cart');
        foreach ($cartItems as $item)
        {
            if ($item['item']->reserve($item['quantity']))
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => $item['item']->id,
                    'quantity' => $item['quantity']
                ]);
        }

        $payingProcess = new PayPalManager();
        if($result = $payingProcess->pay($order))
        {
            Session::remove('cart');
            return $result;
        }
        else
            return null;
    }
}
