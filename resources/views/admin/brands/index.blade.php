@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', 'Brands')
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a class="font-bold" href="/admin/brands">Brands</a></span>
    </nav>

    <div class="flex flex-col md:flex-row">
        <div class="flex flex-col bg-white md:w-1/4 rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Add a new brand</div>
            <form id="new-brand" action="{{ route('brands.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p class="m-15 text-oxford font-bold">Brand information</p>
                <div class="form-group">
                    <div class="form-control">
                        <label for="name">Brand name</label>
                        <input type="text" name="name" id="name"
                               class="{{ $errors->has('name') ? 'border border-danjer' : '' }}"
                               value="{{ old('name') }}"
                               autocomplete="off" required>
                    </div>

                    <div class="form-control">
                        <label for="description">Description</label><br>
                        <textarea name="description" id="description"
                                  class="bg-catskill_white rounded-lg w-full h-100 p-10
                                  {{ $errors->has('description') ? 'border border-danjer' : '' }}"
                                  autocomplete="off" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="form-control">
                        <label for="color">Brand color</label>
                        <input type="color" name="color" id="color"
                               class="{{ $errors->has('color') ? 'border border-danjer' : '' }}"
                               value="{{ old('color') }}"
                               autocomplete="off" required>
                    </div>

                    <div class="form-control">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" id="logo"
                               class="{{ $errors->has('logo') ? 'border border-danjer' : '' }}"
                               value="{{old('logo')}}"
                               autocomplete="off" required>
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

                    <div class="flex justify-center items-center m-25">
                        <div onclick="javascript:document.getElementById('new-brand').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">ADD BRAND</span>
                            </div>
                            <div class="button-icon rounded-r-lg">
                                <span class="fas fa-plus-circle"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-col bg-white md:w-3/4 rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Brands table</div>
            <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                <thead class="bg-catskill_white">
                <tr class="h-50">
                    <th>Brand name</th>
                    <th># of items</th>
                    <th>ٌRUD</th>
                </tr>
                </thead>
                @isset($brands)
                    @foreach($brands as $brand)
                        <tr>
                            <td><a href="/brands/{{ $brand->id }}">{{ $brand->name }}</a></td>
                            <td>{{ count($brand->items) }}</td>
                            <td class="flex justify-center items-center text-white">
                                <a href="{{ route('brands.edit', $brand->id) }}" class="bg-oxford p-10 rounded-lg m-5"><span class="fas fa-edit"></span></a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="post">@csrf @method('delete')
                                    <button onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg m-5"><span class="fas fa-trash-alt"></span></button></form>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </table>
            <div class="flex justify-center items-center">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
