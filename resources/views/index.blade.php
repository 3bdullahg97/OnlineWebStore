@extends('layouts.app')
@extends('templates.header')
@extends('templates.footer')
@extends('templates.left-menu')
@section('title', 'Welcome')

@section('content')
<div class="hero w-full h-200 md:h-300 lg:h-400 xl:h-500 flex flex-col items-start md:items-center md:justify-center" loading="lazy">
    <form id="search" class="hidden md:flex w-full md:w-6/12 justify-center items-center text-pale_sky bg-white text-lg opacity-75 md:mb-100 md:rounded-lg">
        <input type="text" class="w-10/12 md:w-11/12 h-50 md:rounded-l-lg">
        <button type="submit" role="button" class="w-2/12 md:w-1/12 h-50"><span class="fa fas fa-search"></span></button>
    </form>
</div>

<div class="w-full h-70 flex items-center justify-center bg-oxford text-heather font-bold text-xs md:text-sm text-center">
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
</div>


<div class="flex flex-col items-start m-20">
    <div class="text-abbey p-20">
        <h2 class="text-lg font-bold flex-col">New items</h2>
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    </div>

    <div class="flex flex-wrap justify-center w-full">
        @isset($items)
            @foreach($items as $item)
                <div class="item-card m-20 rounded-lg w-full md:w-250">
                    <div class="card-image p-10">
                        <a href="items/{{ $item->id }}" class="item-image">
                            @isset($item->images[0])
                            <img src="{{ $item->images[0]->image_path }}" alt="{{ $item->name }}"
                                 height="175" width="175">
                                @endisset
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="items/{{$item->id}}" class="item-name">{{ $item->name }}</a>
                        <a href="brands/{{ $item->brand->id }}" class="item-brand">{{ $item->brand->name }}</a>
                    </div>

                    <p class="item-price">${{ $item->price }}</p>
                    <form id="add-to-cart[{{ $item->id }}]" action="{{ route('add-to-cart', $item->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="quantity" id="quantity" value="1">
                    </form>
                    <div onclick="document.getElementById('add-to-cart[{{ $item->id }}]').submit()" class="card-footer rounded-b-lg">
                        Add to Cart
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
    <!-- End items div -->
</div>

<div class="flex items-center justify-center">
    <a href="/items">
    <div class="custom-button">
        <div class="button-title rounded-l-lg">
            Show all items
        </div>
        <div class="button-icon rounded-r-lg">
            <span class="fas fa-angle-double-right"></span>
        </div>
    </div>
    </a>
</div>

@endsection
