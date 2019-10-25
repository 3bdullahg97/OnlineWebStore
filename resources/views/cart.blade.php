@extends('layouts.app')
@section('title', 'Shopping Cart')
@extends('templates.header')
@extends('templates.left-menu')
@section('content')
    <div class="flex flex-col">
        <div class="flex justify-between md:justify-around mt-15 items-center">
            <h1 class="m-10 md:m-20 text-lg md:text-2xl text-oxford flex items-center w-1/2">Shopping Cart</h1>

            <div class="hidden md:flex justify-end w-1/2">
                <a onclick="document.getElementById('clear-cart').submit()" class="hidden w-200 h-50 md:flex text-white font-bold cursor-pointer text-sm m-20">
                    <div class="bg-red w-3/4 text-warning flex justify-center items-center text-center rounded-l-lg">Clear Cart</div>
                    <span class="bg-red w-1/4 flex justify-center items-center text-center rounded-r-lg"><span class="fas fa-trash-alt"></span></span>
                </a>

                <a class="hidden w-200 h-50 md:flex text-heather font-bold cursor-pointer text-sm m-20" href="/items">
                    <div class="w-3/4 bg-oxford flex justify-center items-center text-center rounded-l-lg" >Continue Shopping</div>
                    <span class="w-1/4 bg-mirage flex justify-center items-center text-center rounded-r-lg"><span class="fas fa-undo"></span></span>
                </a>
            </div>

            <div class="flex md:hidden justify-end w-1/2 items-center">
                <a style="background-color: #9B353F" class="md:hidden m-10 md:m-20 text-white flex items-center text-xs justify-content rounded" onclick="document.getElementById('clear-cart').submit()"><span class="fas fa-trash-alt m-10"></span></a>

                <a class="md:hidden m-10 md:m-20 text-heather bg-oxford flex items-center text-xs justify-content rounded" href="/items"><span class="fas fa-undo m-10"></span></a>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:justify-around md:items-start flex-grow-0">

            <div id="cart-items" class="flex flex-col w-full md:w-2/3">
                @isset($cart)
                    @foreach($cart as $item)
                        @isset($item['item'])
                        <?php $total += $item['item']->price * $item['quantity'] ?>
                        <div class="cart bg-white mt-20 p-10 md:p-20 border-t border-b border-heather flex md:border md:ml-50 md:rounded-lg">
                            <div class="w-3/4 flex">
                                <img class="h-75 w-75 md:h-150 md:w-150" src="{{ $item['item']->images[0]->image_path }}" alt="Item image">
                                <div class="flex flex-col ml-10 md:ml-20">
                                    <a href="/items/{{ $item['item']->id }}" class="text-oxford font-weight-light text-sm md:text-lg">{{ $item['item']->name }}</a>
                                    <a href="/brands/{{ $item['item']->brand->id }}" class="text-sm text-gray italic text-xs md:text-base">{{ $item['item']->brand->name }}</a>
                                </div>
                            </div>
                            <div class="w-2/4 flex flex-col justify-around items-center m-5">
                                <div class="text-xs md:text-base flex flex-col justify-center items-center">
                                    <h1 class="font-bold md:mb-20 text-base md:text-lg">US ${{ $item['item']->price }}</h1>
                                    <form id="update-cart-item[{{ $item["item"]->id }}]" class="flex flex-col justify-center text-center" action="{{ route('update-cart-item', $item['item']->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <label for="quantity">Qty</label>
                                        <input type="number" max="{{ $item['item']->quantity }}" name="quantity" value="{{ $item['quantity'] }}" id="quantity" class="bg-catskill_white w-2/4 rounded h-25 p-10 self-center h-35 md:w-1/3">
                                    </form>

                                    <form id="remove-from-cart[{{ $item['item']->id }}]" action="{{ route('remove-from-cart', $item['item']->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>

                                    <div class="flex">
                                        <div title="Update item quantity" onclick="document.getElementById('update-cart-item[{{ $item["item"]->id }}]').submit()" class="flex justify-center items-center text-base m-10 mt-15 cursor-pointer">
                                            <span class="text-oxford fas fa-edit"></span>
                                        </div>
                                        <div title="Remove item from your cart" onclick="document.getElementById('remove-from-cart[{{ $item["item"]->id }}]').submit()" class="flex justify-center items-center text-base m-10 mt-15 cursor-pointer">
                                            <span style="color: #9B353F" class=" fas fa-trash"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endisset
                    @endforeach
                @endisset

            </div>

            <div class="flex flex-col md:bg-white md:border md:border-heather md:w-1/3 md:m-20 md:mt-20 md:mr-50 md:rounded-lg">

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

                <div class="flex flex-col justify-center items-center mt-0 mb-30">
                    @if(auth()->id())
                        @if($total !== 0)
                            <a href="{{ route('checkout') }}" role="button" class="custom-button">
                                <div class="button-title rounded-l-lg">
                                    <span style="font-size: 12px">CHECKOUT</span>
                                </div>
                                <div class="button-icon rounded-r-lg">
                                    <span class="fas fa-check-circle"></span>
                                </div>
                            </a>
                        @else
                            <div role="button" class="w-200 h-50 flex text-heather font-bold cursor-not-allowed">
                                <div class="w-3/4 bg-gray flex justify-center items-center text-center rounded-l-lg">
                                    <span style="font-size: 12px">CHECKOUT</span>
                                </div>
                                <div class="w-1/4 bg-gray flex justify-center items-center text-center rounded-r-lg">
                                    <span class="fas fa-check-circle"></span>
                                </div>
                            </div>
                            <p class="mt-10 text-gray">Your cart is empty</p>

                            @endif
                        @else
                        <div role="button" class="w-200 h-50 flex text-heather font-bold cursor-not-allowed">
                            <div class="w-3/4 bg-gray flex justify-center items-center text-center rounded-l-lg">
                                <span style="font-size: 12px">CHECKOUT</span>
                            </div>
                            <div class="w-1/4 bg-gray flex justify-center items-center text-center rounded-r-lg">
                                <span class="fas fa-check-circle"></span>
                            </div>
                        </div>
                        <p class="mt-10 text-gray"><a class="text-oxford" href="/login">Login</a> before going to checkout</p>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <form id="clear-cart" action="{{ route('clear-cart') }}" method="post">
        @csrf
    </form>
@endsection
