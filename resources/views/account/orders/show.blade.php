@extends('layouts.user-panel')
@section('title', 'Home page')
@extends('templates.home-header')
@extends('templates.home-left-menu')
@section('user-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="{{ route('home') }}"><span class="fas fa-home m-10"></span>Home</a> / <a href="{{ route('account.orders') }}">Orders</a> / <a
                class="font-bold" href="{{ route('account.orders.show', $order->id) }}">Order#{{ $order->id }}</a></span>
    </nav>

    <div class="flex flex-col">
        <div class="flex flex-col md:flex-row md:items-start flex-grow-0 justify-center">
            <div class="cart bg-white border-t border-b border-heather flex flex-col md:border mt-20 md:m-20 w-full md:w-1/2 xl:w-2/3">
                <div class="specifications w-full">
                    <div class="text-oxford bg-athens_gray text-lg p-10" title="group"><b>Contact information</b></div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Full name</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->first_name . ' ' . $order->user->last_name }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Email Address</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->email }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Phone</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->phone }}</span>
                        </div>
                    </div>

                    <div class="text-oxford bg-athens_gray text- p-10" title="group"><b>Address information</b></div>
                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Street</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->addresses[0]->street }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">City</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->addresses[0]->city }}</span>
                        </div>
                    </div>
                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Country</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->addresses[0]->country }}</span>
                        </div>
                    </div>

                    <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                        <div class="col w-1/2 md:w-1/3 bg-athens_gray p-10">
                            <span class="text-gray">Postal code</span>
                        </div>
                        <div class="col w-1/2 md:w-2/3 flex justify-center items-center">
                            <span class="text-oxford">{{ $order->user->addresses[0]->postal_code }}</span>
                        </div>
                    </div>
                </div>
                <div class="items md:m-15">
                    @isset($order->items)
                        <div class="text-oxford bg-athens_gray text-lg p-10" title="group"><b>Order items</b></div>
                        <div class="flex">
                            <p class="text-sm w-4/6 p-10 text-center border border-athens_gray font-bold">Item</p>
                            <p class="text-sm w-1/6 p-10 text-center border border-athens_gray font-bold">Price</p>
                            <p class="text-sm w-1/6 p-10 text-center border border-athens_gray font-bold">Qty</p>


                        </div>
                        @foreach($order->items as $orderItem)
                            <div class="flex">
                                <div class="flex w-4/6 border border-athens_gray">
                                    <img class="h-75 w-75 mr-10 m-10" src="{{ $orderItem->item->images[0]->image_path }}" alt="Item image">
                                    <div class="flex flex-col p-15">
                                        <a href="/items/{{ $orderItem->order->id }}" class="text-oxford font-weight-light text-sm md:text-lg">{{ $orderItem->item->name }}</a>
                                        <div class="flex flex-col text-xs text-gray mt-5">
                                            <a href="/brands/{{ $orderItem->item->brand->id }}">{{ $orderItem->item->brand->name }}</a>
                                            <a href="/categories/{{ $orderItem->item->category->id }}">{{ $orderItem->item->category->name }}</a>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-sm w-1/6 p-10 text-center border border-athens_gray">US ${{ $orderItem->item->price }}</p>
                                <p class="text-sm w-1/6 p-10 text-center border border-athens_gray">{{ $orderItem->quantity }}</p>

                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>

            <div class="cart bg-white p-10 md:p-20 border-t border-b border-heather flex flex-col md:border mt-20 md:m-20 w-full md:w-1/2 xl:w-1/3">
                <div class="summary border-heather">
                    <div class="flex flex-col m-20 mt-25 text-oxford text-sm md:text-base">

                        <div class="flex mb-10 justify-between">
                            <p>Order date</p>
                            <p class="text-center">{{ date("F jS, Y", strtotime($order->created_at))}}</p>
                        </div>

                        <div class="flex mb-10 justify-between">
                            <p>Transaction #</p>
                            <p class="text-center">{{ $order->transaction ? $order->transaction->id : '-'}}</p>
                        </div>

                        <div class="flex mb-10 justify-between">
                            <p>Payment Method</p>
                            <p class="text-center">{{ $order->paymentMethod() }}</p>
                        </div>

                        <div class="flex mb-10 justify-between">
                            <p>Order status</p>
                            @switch($order->status)
                                @case(0)
                                <p class="text-center text-oxford">{{ $order->status() }}</p>
                                @break
                                @case(1)
                                <p class="text-center text-green">{{ $order->status() }}</p>
                                @break
                                @default
                                <p class="text-center text-red">{{ $order->status() }}</p>
                            @endswitch
                        </div>

                        <div class="flex mb-10 justify-between">
                            <p>Items({{ count($order->items) }})</p>
                            <p class="text-center">US ${{ $order->price() }}</p>
                        </div>

                        <div class="flex mb-10 justify-between">
                            <p>Shipping</p>
                            <p class="text-center">-</p>
                        </div>
                    </div>

                    <div class="flex m-20 mt-0 justify-between md:text-lg">
                        <p>Total order</p>
                        <p class="font-bold text-oxford">US ${{ $order->price() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
