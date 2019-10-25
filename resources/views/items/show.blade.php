@extends('layouts.app')
@extends('templates.header')
@extends('templates.footer')
@extends('templates.left-menu')
@section('title', $item->name)

@section('content')
    <div class="search-bar flex bg-white justify-center border-b border-heather">
        <form id="search" class="flex w-full justify-center items-center text-pale_sky text-lg md:w-5/12 md:mt-15 md:mb-15">
            <input  style="border-bottom-left-radius: 2px; border-top-left-radius: 2px;" type="text" class="w-10/12 md:bg-catskill_white h-50 md:h-35">
            <button style="border-bottom-right-radius: 2px; border-top-right-radius: 2px;" type="submit" role="button" class="w-2/12 md:w-1/12 md:h-35 md:bg-catskill_white"><span class="fa fas fa-search"></span></button>
        </form>
    </div>
    <nav class="browsing-nav flex justify-center md:justify-start items-center text-gray text-sm h-40 mt-5 md:ml-150">
        <span><a href="/">Home</a> / <a href="/categories">Categories</a> /&nbsp;<a style="font-weight: bold" href="/categories/{{ $item->category->id }}">{{ $item->category->name }}</a></span>
    </nav>
    <div class="flex flex-col md:flex-row bg-white m-10 mb-0 p-20 md:pl-50 md:pr-50 rounded-lg border border-heather">
        <div class="md:hidden flex flex-col">
            <p class="text-oxford text-2xl" >{{ $item->name }}</p>
            <p class="text-gray text-sm" >{{ $item->description }}</p>
        </div>

        <div class="flex flex-col item-images md:w-1/2 justify-center items-center md:m-20">
            @isset($item->images[0])
            <img  src="{{  $item->images[0]->image_path }}" alt="Item image" class="main-image m-5" height="450" width="450">
            @endisset
            <nav class="flex flex-wrap md:flex-no-wrap">
                @isset($item->images)
                    @foreach($item->images as $image)
                        <img src="{{ $image->image_path }}" alt="item image" width="75" height="75" class="main-image w-1/5 md:w-75">
                    @endforeach
                @endisset
            </nav>
        </div>

        <div class="flex flex-col justify-center md:items-start md:w-1/2">
        <div class="hidden md:flex flex-col">
            <p class="text-oxford text-3xl" >{{ $item->name }}</p>
            <p class="text-gray" >{{ $item->description }}</p>
        </div>


        <div class="flex flex-col bg-athens_gray2 mt-20 p-10 rounded-lg">
            <p class="text-lg" style="font-weight: bold">${{ $item->price }}</p>
            <p class="text-sm text-green mb-10"><b>{{ $item->quantity }}</b> items in stock</p>
            <p class="text-sm text-oxford"><b>Brand</b>: {{$item->brand->name}}</p>
            <p class="text-sm text-oxford"><b>Item code</b>: I{{$item->id}}</p>
            <form id="add-to-cart" action="{{ route('add-to-cart', $item->id) }}" method="post" class="flex flex-row justify-center">
                @csrf
                <input type="number" name="quantity" class="w-1/4 m-5 rounded-lg bg-catskill_white text-center" value="1">
                <div onclick="document.getElementById('add-to-cart').submit()" role="button" class="custom-button w-3/4 m-5">

                    <div class="button-title rounded-l-lg">
                        <span style="font-size: 12px">ADD TO CART</span>
                    </div>
                    <div class="button-icon rounded-r-lg">
                        <span class="fas fa-cart-plus"></span>
                    </div>
                </div>
            </form>
            <p class="text-oxford flex justify-center" style="font-size: 13px"><b>234</b>&nbsp;orders</p>
        </div>
        </div>
    </div>
    <!-- End Item information -->
    <div class="flex flex-col md:flex-row m-10 ">

        <div class="item-specifications flex flex-col bg-white mb-10 md:mb-0 md:mt-0 md:mr-10 w-full md:w-3/4 p-20 rounded-lg border border-heather">
            <nav class="flex justify-center items-center font-weight-bold pb-5" style="border-bottom: 0.05em solid #E9EBEE">
                <a id="specifications-tab" class="text-oxford ml-10 mr-10 cursor-pointer" style="font-size: 18px; font-weight: bold" onclick="showSpecificationsTab()">Specifications</a>
                <a id="reviews-tab" class="text-heather ml-10 mr-10 cursor-pointer" style="font-size: 18px; font-weight: bold" onclick="showReviewsTab()">Reviews</a>
            </nav>

            <div id="specifications" class="specifications mt-10">
            @isset($specificationGroups)
                @foreach($specificationGroups as $group)
                    @continue(!$group->hasSpecifications($item))
                    @isset($group->specifications)
                            <div class="text-oxford bg-athens_gray text-lg" title="group"><b>{{ $group->group_name }}</b></div>
                            @foreach($group->specifications as $specification)
                                @continue(!$item->specification($specification->id))
                                <div class="row flex w-full" style="border-bottom: 0.025em solid #E9EBEE">
                                <div class="col w-1/2 md:w-1/3">
                                    <span class="text-gray">{{ $specification->name }}</span>
                                </div>
                                <div class="col w-1/2 md:w-2/3">
                                    <span class="text-oxford">{{ $item->specification($specification->id) ? $item->specification($specification->id) : 'Not specified' }}</span>
                                </div>
                                </div>

                                @endforeach
                        @endisset
                    @endforeach
            @endisset
            </div>

            <div id="reviews" class="hidden mt-10 flex flex-col">
                <div class="flex w-full flex-col md:flex-row">
                    <div class="flex w-full md:w-1/3">
                        <div class="flex m-20 border border-heather rounded p-20 items-center justify-center text-oxford w-full">
                            <div class="flex flex-col ">
                                <span class="text-6xl text-center">{{ $item->rating() }}</span>
                                <div class="flex items-center justify-center text-orange text-center">
                                    @for($i = 0; $i < ceil($item->rating()); $i++)
                                    <span class="fas fa-star"></span>
                                    @endfor
                                    @for($i = 0; $i < (5 - ceil($item->rating())); $i++)
                                    <span class="fas fa-star text-gray"></span>
                                        @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        @if(auth()->user()->review($item) !== null)
                        <div class="flex w-full flex-col mt-5 m-5 border border-catskill_white rounded-lg">
                            <div class="w-full bg-catskill rounded-t-lg p-10 flex justify-between">
                                <span class="m-5 ">Your review</span>
                                <form action="{{ route('reviews.destroy', auth()->user()->review($item)->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure?')" class="fas fa-trash text-red m-5 mt-10"></button>
                                </form>
                            </div>
                            <div class="flex w-full">
                                <div class="flex w-2/5 md:w-1/12 ml-20 md:ml-35">
                                    <div class="flex w-full">
                                        <div class="flex p-15 items-center justify-center text-oxford w-full">
                                            <div class="flex flex-col">
                                                <div class="flex items-center justify-center text-orange text-center text-sm md:text-base">
                                                    @for($i = 0;$i < auth()->user()->review($item)->rating; $i++)
                                                        <span class="fas fa-star"></span>
                                                    @endfor

                                                    @for($i = 0;$i < (5 - auth()->user()->review($item)->rating); $i++)
                                                        <span class="text-gray fas fa-star"></span>
                                                    @endfor

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex  w-3/5 m-20">
                                    {{ auth()->user()->review($item)->comment }}
                                </div>
                            </div>
                        </div>
                            @elseif(auth()->user()->hasOrderItem($item))
                            <form id="review" class="form-group md:w-2/3" action="{{ route('reviews.store', $item->id) }}" method="post">
                                @csrf
                                <h1 class="text-oxford text-lg text-left">Your review & rating</h1>
                                <div class="form-control">
                                    <label for="rating">Your rating (1 -> 5)</label>
                                    <input type="number" name="rating" id="rating" min="1" max="5" value="{{ old('rating') }}" class="{{ $errors->has('rating') ? 'border border-danjer' : '' }}" autocomplete="off" required>
                                </div>
                                <div class="form-control">
                                    <label for="comment">Your review</label>
                                    <textarea name="comment" id="comment"
                                              class="w-full bg-athens_gray border-heather rounded-lg {{ $errors->has('comment') ? 'border border-danjer' : '' }}">{{ old('comment') }}</textarea>
                                </div>
                                <div class="flex mt-0">
                                    <div onclick="javascript:document.getElementById('review').submit()" role="button" class="custom-button">
                                        <div class="button-title rounded-l-lg">
                                            <span style="font-size: 12px">Submit</span>
                                        </div>
                                        <div class="button-icon rounded-r-lg">
                                            <span class="fas fa-star"></span>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->any())
                                    <div class="form-control pt-40">
                                        <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                            @endif
                        @endauth

                </div>
                <div class="w-full bg-catskill_white m-5 text-oxford font-bold p-10 rounded-t-lg">All reviews</div>
                @isset($reviews)
                    <div class="flex flex-col">
                    @foreach($reviews as $review)
                        @auth
                            @continue($review->id == auth()->user()->review($item)->id)
                            @endauth
                        <div class="flex w-full flex-col mt-5 m-5 border border-catskill_white rounded-lg">
                            <div class="w-full bg-catskill rounded-t-lg p-10">
                                {{ $review->user->first_name . ' ' .  $review->user->last_name }}
                            </div>
                            <div class="flex w-full">
                                <div class="flex w-2/5 md:w-1/12 ml-20 md:ml-35">
                                    <div class="flex w-full">
                                        <div class="flex p-15 items-center justify-center text-oxford w-full">
                                            <div class="flex flex-col">
                                                <div class="flex items-center justify-center text-orange text-center text-sm md:text-base">
                                                    @for($i = 0;$i < $review->rating; $i++)
                                                        <span class="fas fa-star"></span>
                                                    @endfor

                                                    @for($i = 0;$i < (5 - $review->rating); $i++)
                                                            <span class="text-gray fas fa-star"></span>
                                                        @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex  w-3/5 m-20">
                                    {{ $review->comment }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endisset
            </div>

        </div>
        <div class="related-items flex flex-col bg-white w-full md:w-1/4 p-20 rounded-lg border border-heather">
            <p title="section label" style="font-size: 18px; font-weight: bold" class="text-oxford mb-20">Related Items</p>
            @isset($relatedItems)
                @foreach($relatedItems as $rItem)
                    <div class="flex">
                        <a class="m-5 mr-20 w-1/3" href="/items/{{ $rItem->id }}">
                            @isset($rItem->images[0])
                                <img src="{{ $rItem->images[0]->image_path }}" alt="{{ $rItem->name }}" height="125" width="125"></a>
                            @endisset
                        <div class="w-2/3">
                            <a href="/items/{{ $rItem->id }}"><p class="text-oxford">{{ $rItem->name }}</p></a>
                            <p class="text-gray mb-5" >{{ $rItem->brand->name }}</p>
                            <p style="font-size: 16px; font-weight: bold">${{ $rItem->price }}</p>
                        </div>
                    </div>
                    @endforeach
                @endisset
        </div>
    </div>
    <div class="brand-logo flex hidden">
        brand-logo
    </div>
    <div class="brand-products hidden md:flex"></div>

    <script>

    </script>
@endsection
