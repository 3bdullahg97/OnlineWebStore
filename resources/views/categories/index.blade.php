@extends('layouts.app')
@extends('templates.header')
@section('title', 'Categories')

@section('content')
    <div>
        <div class="text-center text-5xl font-bold">Categories</div>
        @isset($categories)
            <nav class="flex flex-col m-20">
                @foreach($categories as $category)
                    <a href="/categories/{{$category->id}}">{{ $category->name }}</a>
                @endforeach
                @endisset
            </nav>
    </div>
@endsection
