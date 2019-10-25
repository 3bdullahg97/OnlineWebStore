@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', 'Items')
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a class="font-bold" href="/admin/items">Items</a></span>
    </nav>
    <div class="flex flex-col md:flex-row">
        <div class="flex flex-col bg-white md:w-1/4 rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Add a new Item</div>
            <form id="new-item" action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p class="m-15 text-oxford font-bold">Item basic information</p>
                <div class="form-group">
                    <div class="form-control">
                        <label for="name">Item name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="{{ $errors->has('name') ? 'border border-danjer' : '' }}" autocomplete="off" required>
                    </div>

                    <div class="form-control">
                        <label for="category">Item category</label><br>
                        <select class="bg-catskill_white text-oxford {{ $errors->has('category') ? 'border border-danjer' : '' }}" autocomplete="off" required name="category" id="category" onchange="showSpecifications(this)">
                            @isset($categories)
                                <option value="select">Select ...</option>
                                @foreach($categories as $category)
                                    @if(old('category') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="brand">Item brand</label><br>
                        <select class="bg-catskill_white text-oxford  {{ $errors->has('brand') ? 'border border-danjer' : '' }}" name="brand" id="brand" required>
                            @isset($brands)
                                <option value="select">Select ...</option>
                                @foreach($brands as $brand)
                                    @if(old('brand') == $brand->id)
                                        <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                    @else
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endif
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="price">Unit price</label>
                        <input type="number" name="price" id="price" class="{{ $errors->has('price') ? 'border border-danjer' : '' }}" value="{{ old('price') }}" autocomplete="off" required>
                    </div>

                    <div class="form-control">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity"
                               class="{{ $errors->has('quantity') ? 'border border-danjer' : '' }}"
                               value="{{ old('quantity') }}" autocomplete="off" required>
                    </div>

                    <div class="form-control">
                        <label for="description">Description</label><br>
                        <textarea class="{{ $errors->has('description') ? 'border border-danjer' : '' }}
                            bg-catskill_white rounded-lg w-full h-100 p-10"
                                  name="description" id="description">{{ old('description') }}</textarea>

                    </div>

                </div>
                <p class="m-15 text-oxford font-bold">Item images</p>
                <div class="form-group">
                    <div class="form-control">
                        <label for="images-count"># of images</label>
                        <div class="flex items-center">
                            <input  id="images-count" class="w-3/4 {{ $errors->has('images.1') ? 'border border-danjer' : '' }}"><br>
                            <a class="flex justify-center items-center w-1/4 cursor-pointer bg-oxford text-heather
                                font-bold rounded-lg m-5 p-5 text-sm" onclick="addImagesFields()">Show</a>
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

                    <div class="form-control" id="images-div">

                    </div>
                </div>
                <p class="m-15 text-oxford font-bold">Item specifications</p>
                <div id="item-specification-dev" class="form-group"></div>

                <div class="flex justify-center items-center mt-0 mb-25">
                    <div onclick="javascript:document.getElementById('new-item').submit()" role="button" class="custom-button">
                        <div class="button-title rounded-l-lg">
                            <span style="font-size: 12px">ADD ITEM</span>
                        </div>
                        <div class="button-icon rounded-r-lg">
                            <span class="fas fa-plus-circle"></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-col bg-white md:w-3/4 rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Items table</div>
            <div class="flex flex-col justify-between h-full mb-10">
                <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                    <thead class="bg-catskill_white">
                    <tr class="h-50">
                        <th>Name</th>
                        <th>Price</th>
                        <th >Qty</th>
                        <th>ٌRUD</th>
                    </tr>
                    </thead>
                    @isset($items)
                        @foreach($items as $item)
                            <tr>
                            <td><a href="/items/{{ $item->id }}">{{ $item->name }}</a></td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="flex flex-col md:flex-row justify-center items-center text-white">
                                <a href="{{ route('items.edit', $item->id) }}" class="bg-oxford p-10 rounded-lg m-5"><span class="fas fa-edit"></span></a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="post">@csrf @method('delete')
                                    <button onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg m-5"><span class="fas fa-trash-alt"></span></button></form>
                            </td>
                            </tr>
                        @endforeach
                    @endisset
                </table>
                <div class="flex justify-center items-center">
                    {{ $items->links() }}
                </div>
            </div>


        </div>
    </div>
@endsection
