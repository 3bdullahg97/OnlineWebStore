<?php

namespace App;

use App\Managers\PayPalManager;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'status', 'payment_method', 'address_id'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'order_id');
    }

    public function status()
    {
        switch ($this->status)
        {
            case 0:
                return 'Pending';
                break;
            case 1:
                return 'Completed';
                break;
            case 2:
                return 'Canceled';
                break;
            case 3:
                return 'Refunded';
                break;
            default:
                return false;
        }
    }

    public function paymentMethod()
    {
        switch($this->payment_method)
        {
            case 0:
                return 'On delivery';
                break;
            case 1:
                return 'PayPal';
                break;
            default:
                return false;
        }
    }

    public function price()
    {
        $totalPrice = 0;
        if (isset($this->items))
            foreach ($this->items as $orderItem)
            {
                $totalPrice += $orderItem->quantity * $orderItem->item->price;
            }

        return $totalPrice;
    }

    public function complete()
    {
        $this->update([
            'status' => 1
        ]);
        Transaction::create([
            'user_id' => $this->user->id,
            'order_id' => $this->id,
            'status'   => 0
        ]);
    }

    public function cancel()
    {
        if (isset($this->transaction->id))
        {
            $this->refund();
            $this->update([
                'status' => 3
            ]);
        } else
            $this->update([
                'status' => 2
            ]);
        $this->returnItemsToStore();

        return redirect()->back();

    }

    public function refund()
    {
        $refund = new PayPalManager();
        $refund->refund($this);
    }

    private function returnItemsToStore()
    {
        foreach ($this->items as $orderItem)
        {
            $orderItem->item->update([
                'quantity' => $orderItem->item->quantity + $orderItem->quantity
            ]);
        }
    }
}
