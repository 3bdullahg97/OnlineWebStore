@extends('layouts.user-panel')
@section('title', 'Home page')
@extends('templates.home-header')
@extends('templates.home-left-menu')
@section('user-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="{{ route('home') }}"><span class="fas fa-home m-10"></span>Home</a> / <a class="font-bold" href="{{ route('settings') }}">Account Settings</a></span>
    </nav>

    <div class="flex">
        <div class="flex flex-col bg-white rounded-lg w-full md:w-1/3 m-10">
            <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Your orders</div>
            <form id="update-user" class="form-group" action=" {{ route('users.update', auth()->id()) }}" method="post">
                @csrf
                @method('patch')

                <div class="form-control">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}">
                </div>

                <div class="form-control">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}">
                </div>

                <div class="form-control">
                    <label for="email">E-Mail Address</label>
                    <input type="text" name="email" id="email" value="{{ auth()->user()->email }}">
                </div>

                <div class="form-control">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone }}">
                </div>

                <div class="form-control">
                    <label for="password">Your password</label>
                    <input type="password" name="password" id="password" >
                </div>

                <div class="form-control">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="flex justify-center items-center m-25">
                    <div onclick="javascript:document.getElementById('update-user').submit()" role="button" class="custom-button">
                        <div class="button-title rounded-l-lg">
                            <span style="font-size: 12px">SAVE CHANGES</span>
                        </div>
                        <div class="button-icon rounded-r-lg">
                            <span class="fas fa-edit"></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
