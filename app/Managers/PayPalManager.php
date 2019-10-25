<?php


namespace App\Managers;

use App\Order;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
use PayPal\Api\ShippingInfo;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RefundRequest;

class PayPalManager
{
    private $clientID;
    private $secret;
    private $apiContext;

    public function __construct()
    {
        if (config('paypal.settings.mode') == 'sandbox')
        {
            $this->clientID = config('paypal.sandbox.client_id');
            $this->secret = config('paypal.sandbox.secret');

        } else
        {
            $this->clientID = config('paypal.live.client_id');
            $this->secret = config('paypal.live.secret');
        }
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientID, $this->secret));
        $this->apiContext->setConfig([
            'mode' => config('paypal.settings.mode'),
            'http.ConnectionTimeOut' => config('paypal.settings.http.ConnectionTimeOut'),
            'log.LogEnabled' => config('paypal.settings.log.LogEnabled'),
            'log.FileName' => config('paypal.settings.log.FileName'),
            'log.LogLevel' => config('paypal.settings.log.LogLevel')
        ]);
    }

    public function pay(Order $order)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = array();
        foreach($order->items as $orderItem)
        {
            $item = new Item();
            $item->setName($orderItem->item->name)
                ->setDescription($orderItem->item->description)
                ->setQuantity($orderItem->quantity)
                ->setPrice($orderItem->item->price)
                ->setCurrency('USD');

            $items[count($items)] = $item;
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        $amount = new Amount();
        $amount->setTotal($order->price())
            ->setCurrency('USD');

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setFee(0)
            ->setSubtotal($order->price());

        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)->setReferenceId($order->id);
        $redirectUrls = new RedirectUrls();

        $payment = new Payment();

        $redirectUrls->setReturnUrl(route('orders.execute', $order->id))
            ->setCancelUrl(route('orders.cancel', $order->id));

        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);


        try {
            $payment->create($this->apiContext);

        } catch(PayPalConnectionException $ex)
        {
            $order->cancel();

            dd($ex);
        }
        return $payment->getApprovalLink();
    }

    public function executePayment(Request $request, Order $order)
    {
        if (empty($payerID = $request->input('PayerID')) || empty($request->input('token')) )
            die('Payment Failed');

        $paymentID = $request->input('paymentId');

        $payment = Payment::get($paymentID, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);

        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved')
        {
            $payment->getTransactions();
            $paymentJSON = $payment->toJSON();
            $paymentTransactionsArray = json_decode($paymentJSON);
            $saleId = $paymentTransactionsArray->transactions[0]->related_resources[0]->sale->id;

            \App\Transaction::create([
                'user_id' => $order->user->id,
                'order_id' => $order->id,
                'sale_id' => $saleId,
                'status'  => 0,
            ]);

            return redirect()->route('orders.last');
        }


        die('Payment : ' . $result);
    }

    public function refund(Order $order)
    {

        try {
            $sale = Sale::get($order->transaction->sale_id, $this->apiContext);

        } catch (\Exception $ex)
        {
            die($ex);
        }


        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($order->price());

        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amount);

        try
        {
            $refundedSale = $sale->refundSale($refundRequest, $this->apiContext);
        } catch (\Exception $ex)
        {
            die($ex);
        }

        $order->transaction->update([
            'status' => 1
        ]);
    }

}
