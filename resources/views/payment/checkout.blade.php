@extends('layouts.app')
@section('title', 'Checkout')
@extends('templates.header')
@extends('templates.left-menu')
@section('content')
    <div class="flex flex-col">
        <div class="flex justify-between md:justify-around mt-15 items-center">
            <h1 class="m-10 md:m-20 text-lg md:text-2xl text-oxford flex items-center w-1/2">Review order</h1>

            <a class="hidden w-200 h-50 md:flex text-heather font-bold cursor-pointer text-sm m-20" href="/cart">
                <div class="w-3/4 bg-oxford flex justify-center items-center text-center rounded-l-lg" >Back to cart</div>
                <span class="w-1/4 bg-mirage flex justify-center items-center text-center rounded-r-lg"><span class="fas fa-undo"></span></span></a>

            <a class="md:hidden m-10 md:m-20 text-heather bg-oxford flex items-center text-xs justify-content rounded" href="/cart"><span class="fas fa-undo m-10"></span></a>

             </div>

        <div class="flex flex-col md:flex-row md:items-start flex-grow-0 justify-center">
            <div class="cart bg-white border-t border-b border-heather flex flex-col md:border mt-20 md:m-20 w-full md:w-1/2 xl:w-2/3">
                <div class="specifications w-full">
                    <div class="text-oxford bg-athens_gray text-lg p-10" title="group"><b>Contact information</b></div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Email Address</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Phone</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $user->phone }}</span>
                        </div>
                    </div>

                    <div class="text-oxford bg-athens_gray text- p-10" title="group"><b>Address information</b></div>
                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Street</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $user->addresses[0]->street }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">City</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $user->addresses[0]->city }}</span>
                        </div>
                    </div>
                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Country</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $user->addresses[0]->country }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Postal code</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $user->addresses[0]->postal_code }}</span>
                        </div>
                    </div>
                </div>
                <div class="items md:m-15">
                    @isset($cart)
                        <div class="text-oxford bg-athens_gray text-lg p-10" title="group"><b>Order items</b></div>
                        <div class="flex">
                            <p class="text-sm w-4/6 p-10 text-center border border-athens_gray font-bold">Item</p>
                            <p class="text-sm w-1/6 p-10 text-center border border-athens_gray font-bold">Price</p>
                            <p class="text-sm w-1/6 p-10 text-center border border-athens_gray font-bold">Qty</p>


                        </div>
                        @foreach($cart as $item)
                            <div class="flex">
                                <div class="flex w-4/6 border border-athens_gray">
                                    <a href="/items/{{ $item['item']->id }}">
                                        <img class="h-75 w-75 mr-10 m-10" src="{{ $item['item']->images[0]->image_path }}" alt="Item image">
                                    </a>
                                    <div class="flex flex-col p-15">
                                        <a href="/items/{{ $item['item']->id }}" class="text-oxford font-weight-light text-sm md:text-lg">{{ $item['item']->name }}</a>
                                        <div class="flex flex-col text-xs text-gray mt-5">
                                            <a href="/brands/{{ $item['item']->brand->id }}">{{ $item['item']->brand->name }}</a>
                                            <a href="/categories/{{ $item['item']->category->id }}">{{ $item['item']->category->name }}</a>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-sm w-1/6 p-10 text-center border border-athens_gray">US ${{ $item['item']->price }}</p>
                                <p class="text-sm w-1/6 p-10 text-center border border-athens_gray">{{ $item['quantity'] }}</p>

                                    <?php $total += $item['item']->price * $item['quantity'] ?>

                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>

            <div class="cart bg-white p-10 md:p-20 border-t border-b border-heather flex flex-col md:border mt-20 md:m-20 w-full md:w-1/2 xl:w-1/3">
                <div class="summary border-heather">
                    <div class="flex flex-col m-20 mt-25 text-oxford text-sm md:text-base">
                        <div class="flex mb-10 justify-between">
                            <p>Items({{ count($cart) }})</p>
                            <p class="text-center">US ${{ $total }}</p>
                        </div>

                        <div class="flex mb-10 justify-between">
                            <p>Shipping</p>
                            <p class="text-center">-</p>
                        </div>
                    </div>

                    <div class="flex m-20 mt-0 justify-between md:text-lg">
                        <p>TOTAL</p>
                        <p class="font-bold text-oxford">US ${{ $total }}</p>
                    </div>
                    <form id="payment-submit" action="{{ route('payment.submit') }}" method="post" class="flex flex-col justify-center items-center mt-0 mb-25">
                        @csrf
                        <div class="form-group">
                            <div class="form-control">
                                <label for="address">Choose another address</label>
                                <select class="bg-catskill_white w-full p-10 rounded" name="address" id="address">
                                    @isset($user->addresses)
                                        @foreach($user->addresses as $address)
                                            <option value="{{ $address->id }}">{{ $address->street . ' St. ' .$address->postal_code}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="payment-method" id="payment-method">
                        <div onclick="javascript: document.getElementById('payment-method').setAttribute('value', '0');
                            document.getElementById('payment-submit').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">Paying on delivery</span>
                            </div>
                            <div class="button-icon rounded-r-lg">
                                <span class="fas fa-truck"></span>
                            </div>
                        </div>

                        <div onclick="javascript:document.getElementById('payment-method').setAttribute('value', '1');
                            document.getElementById('payment-submit').submit()" role="button" class="paypal-custom-button mt-20">
                                <div class="button-title rounded-l-lg bg-yellow">
                                    <span style="font-size: 12px">Paying using PayPal</span>
                                </div>
                                <div class="button-icon rounded-r-lg">
                                    <span class="fab fa-paypal"></span>
                                </div>
                            </div>
                    </form>
                    <div id="paypal-button">

                    </div>
                </div>
            </div>we
        </div>
    </div>
    {{--
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Call your server to save the transaction
                    return fetch('/paypal-transaction-complete', {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID
                        })
                    });
                });
            }
        }).render('#paypal-button');
    </script> --}}
@endsection
