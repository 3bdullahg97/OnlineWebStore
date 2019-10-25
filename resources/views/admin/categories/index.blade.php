@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', 'Categories')
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a class="font-bold" href="/admin/categories">Categories</a></span>
    </nav>
    <div class="flex flex-col md:flex-row">
        <div class="flex flex-col bg-white md:w-1/4 rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Add a new Category</div>
            <form id="new-category" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p class="m-15 text-oxford font-bold">Category information</p>
                <div class="form-group">
                    <div class="form-control">
                        <label for="name">Categoy name</label>
                        <input type="text" name="name" id="name"
                               class="{{ $errors->has('name') ? 'border border-danjer' : '' }}"
                               value="{{ old('name') }}" autocomplete="off" required>
                    </div>
                    <div class="form-control">
                        <label for="logo">Category logo</label>
                        <input type="file" name="logo" id="logo"
                               class="{{ $errors->has('logo') ? 'border border-danjer' : '' }}"
                                value="{{ old('logo') }}" autocomplete="off" required>
                    </div>
                    <div class="form-control">
                        <label for="description">Description</label><br>
                        <textarea class="bg-catskill_white rounded-lg w-full h-100 p-10
                        {{ $errors->has('description') ? 'border border-danjer' : '' }}"
                                  name="description" id="description"
                                  autocomplete="off" required>{{ old('description') }}</textarea>
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
                <p class="m-15 text-oxford font-bold">Category specifications</p>
                <div class="form-group">
                    <div class="form-control">
                        <label for="group-count"># of groups</label>
                        <div class="flex">
                            <input type="number" id="groups-count" width="w-1/2">
                            <a class="flex justify-center items-center w-1/2" onclick="addGroups()">Show</a>
                        </div>
                    </div>

                    <div id="specification-groups" class="form-group">

                    </div>
                </div>
                <div class="flex justify-center items-center mt-0 mb-25">
                    <div onclick="javascript:document.getElementById('new-category').submit()" role="button" class="custom-button">
                        <div class="button-title rounded-l-lg">
                            <span style="font-size: 12px">ADD CATEGORY</span>
                        </div>
                        <div class="button-icon rounded-r-lg">
                            <span class="fas fa-plus-circle"></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-col bg-white md:w-3/4 rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Categories table</div>
            <div class="flex flex-col justify-between h-full mb-10">
            <table class=" overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                <thead class="bg-catskill_white">
                <tr class="h-50">
                    <th>Name</th>
                    <th ># of items</th>
                    <th>ٌRUD</th>
                </tr>
                </thead>
                @foreach($categories as $category)
                    <tr class="h-50">
                        <td><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                        <td>{{ count($category->items) }}</td>
                        <td class="flex justify-center items-center text-white">
                            <a title="Update category" href="{{ route('categories.edit', $category->id) }}" class="bg-oxford p-10 rounded-lg m-5 cursor-pointer" ><span class="fas fa-edit"></span></a>

                            <form id="delete-category" class="m-5" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg"><span class="fas fa-trash-alt"></span></button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </table>
                <div class="flex justify-center items-center">
                    {{ $categories->links() }}
                </div>
            </div>


        </div>
    </div>
@endsection
