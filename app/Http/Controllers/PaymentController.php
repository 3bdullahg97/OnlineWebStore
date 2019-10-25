<?php

namespace App\Http\Controllers;

use App\Managers\PaymentManager;
use App\Managers\PayPalManager;
use App\Order;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cart = Session::get('cart');
        $total = 0;
        $user = User::find(auth()->id());
        return view('payment.checkout', compact('cart', 'total' ,'user'));
    }

    public function submit(Request $request)
    {
        $user = User::find(auth()->id());
        switch ($request->input('payment-method'))
        {
            case 0 :
                PaymentManager::createOnDeliveryOrder($user, $request);
                return redirect()->route('orders.last');
                break;
            case 1 :
                return redirect(PaymentManager::createPaypalOrder($user, $request));
                break;
            default :
                abort(404);
        }
    }


}
