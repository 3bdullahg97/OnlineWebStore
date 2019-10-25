@extends('layouts.user-panel')
@section('title', 'Home page')
@extends('templates.home-header')
@extends('templates.home-left-menu')
@section('user-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a class="font-bold" href="{{ route('home') }}"><span class="fas fa-home m-10"></span>Home</a></span>
    </nav>
    <div class="flex">
        <h1 class="m-20 text-oxford text-2xl">Hello, {{ $user->first_name . ' ' . $user->last_name }}</h1>
    </div>
@endsection
