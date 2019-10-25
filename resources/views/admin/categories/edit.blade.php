@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', "Edit $category->name")
@section('admin-content')
<div class="flex flex-col">
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a href="/admin/categories">Categories</a> /&nbsp;<a style="font-weight: bold" href="/categories/{{ $category->id }}">{{ $category->name }}</a></span>
    </nav>

    <div class="flex w-full flex-col md:flex-row">
        <div class="md:w-4/6 flex flex-col bg-white rounded-lg m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">{{ $category->name }}</div>

            <form id="update-category" action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('PATCH')
                <p class="m-15 text-oxford font-bold">Category information</p>
                <div class="form-group">
                    <div class="form-control">
                        <label for="name">Categoy name</label>
                        <input type="text" name="name" id="name" value="{{ $category->name }}" class="{{ $errors->has('name') ? 'border border-danjer' : '' }}" autocomplete="off" required>
                    </div>

                    @if($errors->get('name'))
                        <div class="form-control pt-40">
                            <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                @foreach($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-control">
                        <label for="description">Description</label><br>
                        <textarea class="bg-catskill_white rounded-lg w-full h-100 p-10 {{ $errors->has('description') ? 'border border-danjer' : '' }}"
                                  name="description" id="description" autocomplete="off" required>{{ $category->description }}</textarea>
                    </div>

                    @if($errors->get('description'))
                        <div class="form-control pt-40">
                            <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                @foreach($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @isset($category->specificationGroups)
                    <p class="m-15 text-oxford font-bold">Category specifications</p>
                    <div class="form-group border border-catskill_white rounded-lg p-15">
                        @foreach($category->specificationGroups as $group)
                            <div class="form-control">
                                <label for="groups[{{ $group->id }}][name]">Group: {{ $group->group_name }}</label>
                                <div class="flex items-center">
                                    <input type="text" id="groups[{{ $group->id }}][name]"
                                           name="groups[{{ $group->id }}][name]" value="{{ $group->group_name }}">
                                    <div onclick="deleteGroup({{ $group->id }})" class="text-red p-5 rounded-lg m-5">
                                        <span class="fas fa-trash-alt"></span></div>

                                </div>

                                @isset($group->specifications)
                                    <div class="form-group border border-catskill_white rounded-lg p-15">
                                        @foreach($group->specifications as $specification)
                                            <div class="form-control">
                                                <label for="groups[{{ $group->id }}][specifications][{{ $specification->id }}]">
                                                    Specification: {{ $specification->name }}</label>
                                                <div class="flex items-center">
                                                <input type="text"
                                                       name="groups[{{ $group->id }}][specifications][{{ $specification->id }}]"
                                                   id="groups[{{ $group->id }}][specifications][{{ $specification->id }}]"
                                                   value="{{ $specification->name }}"><div
                                                       onclick="deleteSpecification({{ $specification->id }})"
                                                        class="text-red p-5 rounded-lg m-5">
                                                    <span class="fas fa-trash-alt"></span></div>

                                                </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset
                        </div>
                    @endforeach
                </div>
            @endisset

                <div class="flex justify-center items-center mt-0 mb-25">
                    <div onclick="javascript:document.getElementById('update-category').submit()" role="button"
                         class="custom-button">
                        <div class="button-title rounded-l-lg">
                            <span style="font-size: 12px">UPDATE CATEGORY</span>
                        </div>

                        <div class="button-icon rounded-r-lg">
                            <span class="fas fa-edit"></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-col md:w-2/6">
            <div class="flex flex-col">
                <div class="flex flex-col bg-white rounded-lg m-10">
                    <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">{{ $category->name }} logo</div>
                    <div class="flex justify-center mt-20">
                        <img src="{{ $category->logo }}" alt="Category logo" height="150" width="150">
                    </div>
                    <form id="update-category-logo" action="{{ route('categories.update.logo', $category->id) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <div class="form-control">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" id="logo" class="{{ $errors->has('logo') ? 'border border-danjer' : '' }}" required>
                            </div>
                            @if($errors->get('logo'))
                                <div class="form-control pt-40">
                                    <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                        @foreach($errors->get('logo') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-center items-center mt-0 mb-25">
                            <div onclick="javascript:document.getElementById('update-category-logo').submit()" role="button"
                                 class="custom-button">
                                <div class="button-title rounded-l-lg">
                                    <span style="font-size: 12px">UPDATE LOGO</span>
                                </div>

                                <div class="button-icon rounded-r-lg">
                                    <span class="fas fa-edit"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="flex flex-col bg-white rounded-lg m-10">
                <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Add new Specifications</div>
                <form id="new-groups" action="{{ route('groups.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-control">
                            <label for="group-count"># of groups</label>
                            <div class="flex items-center">
                                <input type="number" id="groups-count" width="w-3/4">
                                <a class="flex justify-center items-center w-1/4 bg-oxford text-heather ml-10 p-5 rounded-lg cursor-pointer font-bold text-sm" onclick="addGroups()">Show</a>
                            </div>
                        </div>

                        <div id="specification-groups" class="form-group">

                        </div>
                    </div>

                    <div class="flex justify-center items-center mt-0 mb-25">
                        <div onclick="javascript:document.getElementById('new-groups').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">ADD SPECIFICATIONS</span>
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
</div>
@endsection
