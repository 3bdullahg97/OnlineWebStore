@extends('layouts.app')
@extends('templates.header')
@extends('templates.left-menu')
@section('title', 'Items')

@section('content')
    <div>
<div class="h-60 bg-white text-trout flex justify-between md:justify-start items-center"
    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">

    <div class="hidden h-full md:w-2/12 bg-mirage text-spindle font-bold md:flex justify-center items-center cursor-pointer">
        Filters
    </div>

    <div class="md:hidden w-2/12 h-full bg-mirage text-spindle font-bold flex justify-center items-center cursor-pointer"
         onclick="toggleDropDownFilter()">
        <i class="fas fa-filter text-lg"></i>
    </div>

    <form id="search-filter" class="w-10/12 md:w-3/12 md:ml-30 md:rounded-lg flex h-full md:h-40 md:bg-catskill_white">
        <input id="search-input" type="get" class="w-10/12 md:w-11/12  md:bg-catskill_white">
        <button class="w-2/12 md:w-1/12"><span class="fa fas fa-search"></span></button>
    </form>

</div>


<div class="filter h-0 bg-mirage" id="filter">
    <!-- Soon -->
</div>

<div class=" flex justify-between">

    <div class="hidden w-2/12 text-heather bg-oxford font-bold md:flex"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">

        <form action="" method="get" class="flex flex-col m-20 mt-30">

            <div class="flex flex-col">
                <label class="mb-10" for="" class="text-lg">Stock Status</label>
                <div class="text-sm"><input type="radio" name="stock_statuis" value="1"> in stock</div>
                <div class="text-sm"><input type="radio" name="stock_statuis" value="0"> Out of stock</div>
            </div>

            <div class="flex flex-col mt-30">
                <label class="mb-10" for="">Price</label>
                <div class="text-sm">JOD <input type="text" class="w-50 bg-mirage"> - JOD <input type="text"
                    class="w-50 bg-mirage"></div>
            </div>

            <div class="flex flex-col mt-30 ">
                <label class="mb-10" for="">Brand</label>
                <div class="text-sm"><input type="checkbox" name="brand" value="dell"> Dell</div>
                <div class="text-sm"><input type="checkbox" name="brand" value="apple"> Apple</div>
                <div class="text-sm"><input type="checkbox" name="brand" value="toshiba"> Toshiba</div>
            </div>
        </form>
    </div>


    <div class="results md:w-10/12 flex flex-row flex-wrap justify-center mt-50" id="results">
        <div class="flex">
            @foreach($items as $item)
            <div class="item-card m-20 rounded-lg w-full md:w-250">
                <div class="card-image p-10">
                    <a href="items/{{ $item->id }}" class="item-image">
                        <img src="{{ isset($item->images[0]->image_path) ? $item->images[0]->image_path : '' }}" alt="{{ $item->name }}" height="175" width="175">
                    </a>
                </div>
                <div class="card-body">
                    <a href="items/{{$item->id}}" class="item-name">{{ $item->name }}</a>
                    <a href="brands/{{ $item->brand->id }}" class="item-brand">{{ $item->brand->name }}</a>
                </div>

                <p class="item-price">${{ $item->price }}</p>

                <form id="add-to-cart[{{ $item->id }}]" action="{{ route('add-to-cart', $item->id) }}" method="post">
                    @csrf
                </form>
                <div onclick="document.getElementById('add-to-cart[{{ $item->id }}]').submit()" class="card-footer rounded-b-lg">
                    Add to Cart
                </div>
            </div>
        @endforeach
        </div>
    </div>

</div>
    </div>
@endsection
