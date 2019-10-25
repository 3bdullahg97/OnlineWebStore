@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', "Edit $item->name")
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a href="/admin/items">Items</a> /
            <a class="font-bold" href="/admin/items/{{ $item->id }}/edit">{{ $item->name }}</a></span>
    </nav>

    <div class="flex w-full flex-col md:flex-row">
        <div class="flex w-full flex-col md:flex-row">
            <div class="md:w-4/6 flex flex-col bg-white rounded-lg m-10">
                <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Basic information</div>

                <form id="update-item" class="flex flex-col w-full" action="{{ route('items.update', $item->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                        <div class="form-group">
                            <div class="form-control">
                                <label for="name">Categoy name</label>
                                <input type="text" name="name" id="name" value="{{ $item->name }}" class="{{ $errors->has('name') ? 'border border-danjer' : '' }}">
                            </div>
                            <div class="form-control">
                                <label for="category">Item category</label><br>
                                <select class="bg-catskill_white text-oxford" name="category" id="category">
                                    <option value="">Select category ...</option>
                                    @isset($categories)
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id === $item->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="form-control">
                                <label for="brand">Item brand</label><br>
                                <select class="bg-catskill_white text-oxford" name="brand" id="brand">
                                    <option value="">Select brand ...</option>
                                    @isset($brands)
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $brand->id === $item->brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="form-control">
                                <label for="price">Unit price</label>
                                <input type="number" name="price" id="price" class="{{ $errors->has('price') ? 'border border-danjer' : '' }}" value="{{ $item->price }}">
                            </div>

                            <div class="form-control">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="{{ $errors->has('quantity') ? 'border border-danjer' : '' }}" value="{{ $item->quantity }}">
                            </div>
                            <div class="form-control">
                                <label for="description">Description</label><br>
                                <textarea class="bg-catskill_white rounded-lg w-full h-100 p-10 {{ $errors->has('description') ? 'border border-danjer' : '' }}"
                                          name="description" id="description">{{ $brand->description }}</textarea>
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

                        </div>

                    <div class="flex justify-center items-center mt-0 mb-25">
                        <div onclick="javascript:document.getElementById('update-item').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">UPDATE ITEM</span>
                            </div>
                            <div class="button-icon rounded-r-lg">
                                <span class="fas fa-plus-circle"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="md:w-2/6 flex flex-col bg-white rounded-lg m-10 justify-between">
                <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Item images</div>
                <div class="flex flex-col justify-center items-center p-15">
                    @isset($images)
                        @foreach($images as $image)
                            <div class="flex justify-around m-10 w-full border rounded-lg border-catskill_white">
                                <form id="update-image[{{ $image->id }}]" class="flex items-center justify-center"
                                      action="{{ route('itemImages.update', $image->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <img src="{{ $image->image_path }}" alt="{{ $image->id }}"
                                         width="150" height="150">
                                    <div class="hidden h-0">
                                        <input type="file" id="{{ $image->id }}"
                                               name="updatedImage[{{ $image->id }}]" />
                                    </div>
                                </form>

                                <div class="flex flex-row md:flex-col justify-center items-center">
                                    <button onclick="javascript: document.getElementById({{ $image->id }}).click()"
                                            class="bg-oxford text-heather font-bold text-sm rounded-lg p-10 m-5">
                                        <span class="fas fa-upload"></span>
                                    </button>

                                    <button onclick="javascript: document.getElementById('update-image[{{ $image->id }}]').submit()" class="text-white font-bold text-sm rounded-lg p-10 m-5 bg-green">
                                        <span class="fas fa-edit"></span>
                                    </button>

                                    <form action="{{ route('itemImages.destroy', $image->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white font-bold text-sm rounded-lg p-10 m-5 bg-red">
                                            <span class="fas fa-trash"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
                <form id="new-item-image" class="flex flex-col justify-center items-center"
                      action="{{ route('itemImages.store', $item->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-control">
                            <label for="images-count"># of images</label>
                            <div class="flex items-center">
                                <input  id="images-count" class="w-3/4"><br>
                                <a class="flex justify-center items-center w-1/4 cursor-pointer bg-oxford text-heather
                                font-bold rounded-lg m-5 p-5 text-sm" onclick="addImagesFields()">Show</a>
                            </div>
                        </div>
                        <div class="form-control" id="images-div">

                        </div>
                    </div>

                    <div class="flex justify-center items-center mt-0 mb-25">
                        <div onclick="javascript:document.getElementById('new-item-image').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">ADD IMAGES</span>
                            </div>
                            <div class="button-icon rounded-r-lg">
                                <span class="fas fa-plus-circle"></span>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

        <div class="flex flex-col bg-white rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Item Specifications</div>
            <form id="update-item-specifications" action="{{ route('itemSpecifications.update', $item->id) }}" method="post">
                @csrf
                @method('PATCH')
                @isset($item->category->specificationGroups)
                    <div class="form-group border border-catskill_white rounded-lg p-15">
                        @foreach($item->category->specificationGroups as $group)
                            <div class="form-control">
                                <label for="groups[{{ $group->id }}][name]">Group: {{ $group->group_name }}</label>

                                @isset($group->specifications)
                                    <div class="form-group border border-catskill_white rounded-lg p-15">
                                        @foreach($group->specifications as $specification)
                                            <div class="form-control">
                                                <label for="itemSpecifications[{{ $specification->id }}]">
                                                    Specification: {{ $specification->name }}</label>
                                                <div class="flex items-center">
                                                    <input type="text"
                                                           name="itemSpecifications[{{ $specification->id }}]"
                                                           id="groups[{{ $group->id }}][specifications][{{ $specification->id }}]"
                                                           value="{{ $item->specification($specification->id) }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endisset
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-center items-center mt-0 mb-25">
                        <div onclick="javascript:document.getElementById('update-item-specifications').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">UPDATE SPECIFICATIONS</span>
                            </div>
                            <div class="button-icon rounded-r-lg">
                                <span class="fas fa-plus-circle"></span>
                            </div>
                        </div>
                    </div>
                @endisset

            </form>
        </div>
@endsection
