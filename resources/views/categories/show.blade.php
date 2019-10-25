@extends('layouts.app')
@extends('templates.header')
@section('title', "{{ $category->name }}")

@section('content')
    <h1>{{ $category->name }}</h1>
    <h1>{{ $category->description }}</h1>
    <h1>{{ $category->logo }}</h1>

@endsection
