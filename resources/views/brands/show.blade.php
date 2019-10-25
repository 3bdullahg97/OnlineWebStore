@extends('layouts.app')
@extends('templates.header')
@section('title', "{{ $brand->name }}")

@section('content')
    <h1>{{ $brand->name }}</h1>
    <h1>{{ $brand->description }}</h1>
    <h1>{{ $brand->logo }}</h1>
    <h1>{{ $brand->color }}</h1>

    <a href="/brands/{{ $brand->id }}/edit" class="text-center text-2xl font-bold">Edit brand</a><br>
    <a href="/brands" class="text-center text-2xl font-bold"><< Back to brands</a>
    @endsection
