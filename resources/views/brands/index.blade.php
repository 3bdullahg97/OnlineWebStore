@extends('layouts.app')
@extends('templates.header')
@section('title', 'Brands')

@section('content')
    <div>
        <div class="text-center text-5xl font-bold">Brands</div>
            @isset($brands)
            <nav class="flex flex-col m-20">
                @foreach($brands as $brand)
                    <a href="/brands/{{ $brand->id }}">{{ $brand->name }}</a>
                @endforeach
            </nav>
                @endisset
    </div>
@endsection
