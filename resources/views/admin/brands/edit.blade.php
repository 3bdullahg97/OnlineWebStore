@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', "Edit $brand->name")
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a href="/admin/brands">Brands</a> / <a
                href="/brands/{{ $brand->id }}" class="font-bold">{{ $brand->name }}</a></span>
    </nav>
   <div class="flex flex-col md:flex-row">
       <div class="flex flex-col bg-white md:w-3/4 rounded-lg m-10">
           <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Edit Brand</div>

           <form id="update-brand" action="{{ route('brands.update', $brand->id) }}" method="post">
               @csrf
               @method('PATCH')
               <div class="form-group">
                   <div class="form-control">
                       <label for="name">Brand name</label>
                       <input type="text" name="name" id="name" value="{{ $brand->name }}"
                              class="{{ $errors->has('name') ? 'border border-danjer' : '' }}"
                              autocomplete="off" required>
                       @if($errors->get('name'))
                           <div class="form-control pt-40">
                               <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                   @foreach($errors->get('name') as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                   </div>

                   <div class="form-control">
                       <label for="description">Description</label><br>
                       <textarea name="description" id="description"
                                 class="bg-catskill_white rounded-lg w-full h-100 p-10
                                    {{ $errors->has('description') ? 'border border-danjer' : '' }}"
                                 autocomplete="off" required
                       >{{ $brand->description }}</textarea>

                       @if($errors->get('description'))
                           <div class="form-control pt-40">
                               <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                   @foreach($errors->get('description') as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                   </div>

                   <div class="form-control">
                       <label for="color">Brand color</label>
                       <input type="color" name="color" id="color" value="{{ $brand->color }}"
                              class="{{ $errors->has('color') ? 'border border-danjer' : '' }}"
                       autocomplete="off" required>

                       @if($errors->get('color'))
                           <div class="form-control pt-40">
                               <ul class="text-sm text-white rounded-lg p-10 bg-danjer">
                                   @foreach($errors->get('color') as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                   </div>



                   <div class="flex justify-center items-center m-25">
                       <div onclick="javascript:document.getElementById('update-brand').submit()" role="button" class="custom-button">
                           <div class="button-title rounded-l-lg">
                               <span style="font-size: 12px">UPDATE BRAND</span>
                           </div>
                           <div class="button-icon rounded-r-lg">
                               <span class="fas fa-plus-circle"></span>
                           </div>
                       </div>
                   </div>
               </div>

           </form>
       </div>

       <div class="flex flex-col bg-white md:w-1/4 rounded-lg m-10">
           <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">{{ $brand->name }} logo</div>
            <div class="flex justify-center mt-20">
                   <img src="{{ $brand->logo }}" alt="Brand logo" height="150" width="150">
               </div>
               <form id="update-brand-logo" action="{{ route('brands.update.logo', $brand->id) }}"
                     method="post" enctype="multipart/form-data">
                   @csrf
                   @method('PATCH')
                   <div class="form-group">
                       <div class="form-control">
                           <label for="logo">Logo</label>
                           <input type="file" name="logo" id="logo" class="{{ $errors->has('logo') ? 'border border-danjer' : '' }}">
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
                       <div onclick="javascript:document.getElementById('update-brand-logo').submit()" role="button"
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
   </div>
@endsection
