<?php

namespace App\Http\Controllers;

use App\Managers\PayPalManager;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if(auth()->id() == 1)
        {
            $this->authorize('viewAny', Order::class);
            $orders = Order::paginate(7);
            return view('admin.orders.index', compact('orders'));
        }
        else
        {
            $orders = Order::where('user_id', '=', auth()->id())->paginate(7);
            return view('account.orders.index', compact('orders'));
        }
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        if (auth()->id() == 1)
            return view('admin.orders.show', compact('order'));
        else
            return view('account.orders.show', compact('order'));
    }

    public function cancel(Request $request, Order $order)
    {
        $this->authorize('update',$order);
        $order->cancel();

        return redirect()->back();
    }

    public function complete(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $order->complete();

        return redirect()->back();
    }

    public function execute(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $paying = new PayPalManager();
        $paying->executePayment($request, $order);


        return redirect()->route('orders.last');
    }

    public function refund(Order $order)
    {
        $this->authorize('update', $order);

        $refundProcess = new PayPalManager();
        $refundProcess->refund($order);

        return redirect()->route('orders.last');
    }

    public function last()
    {
        $order = Order::all()->where('user_id', '=', auth()->id())->last();
        if (!$order)
            abort(404);
        else
        {
            $this->authorize('view', $order);
        }

        return view('orders.last', compact('order'));
    }
}
