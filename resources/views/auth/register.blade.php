@extends('layouts.app')
@section('content')
<div class="flex justify-center items-center">
    <form action="{{ route('register') }}" method="post" class="m-15">
        @csrf
        <div class="bg-white p-20 rounded-lg rounded-b-none">
            <a href="/" class="flex flex-col justify-center items-center text-2xl text-oxford font-bold">Online<span class="text-base">WebStore</span></a>

            <p class="text-oxford text-sm font-bold m-20">Have you accout? <a href="/login" class="text-spindle">Login</a></p>

            <div class="form-group">

                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="form-control">
                        <label for="first_name">First name</label><br>
                        <input type="text" name="first_name" id="first_name" class="{{ $errors->has('first_name') ? 'border border-danjer' : '' }}" value="{{ old('first_name') }}" autocomplete="off">
                    </div>

                    <div class="form-control">
                        <label for="last_name">Last name</label><br>
                        <input type="text" name="last_name" id="last_name" class="{{ $errors->has('last_name') ? 'border border-danjer' : '' }}" value="{{ old('last_name') }}" autocomplete="off">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="form-control md:flex-row">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email" class="{{ $errors->has('email') ? 'border border-danjer' : '' }}" value="{{ old('email') }}" autocomplete="off">
                    </div>
                    <div class="form-control">
                        <label for="phone">Phone</label><br>
                        <input type="text" name="phone" id="phone" class="{{ $errors->has('phone') ? 'border border-danjer' : '' }}" value="{{ old('phone') }}" autocomplete="off">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="form-control">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" class="{{ $errors->has('password') ? 'border border-danjer' : '' }} " value="{{ old('password') }}" autocomplete="off">
                    </div>
                    <div class="form-control">
                        <label for="password_confirmation">Confirm password</label><br>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="{{ $errors->has('password_confirmation') ? 'border border-danjer' : '' }}" value="{{ old('confirm-password') }}" autocomplete="off">
                    </div>

                </div>

                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="form-control">
                        <label for="country">Country</label><br>
                        <input type="text" name="country" id="country" class="{{ $errors->has('country') ? 'border border-danjer' : '' }}" value="{{ old('country') }}" autocomplete="off">
                    </div>
                    <div class="form-control">
                        <label for="city">City</label><br>
                        <input type="text" name="city" id="city" class="{{ $errors->has('city') ? 'border border-danjer' : '' }}" value="{{ old('city') }}" autocomplete="off">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="form-control">
                        <label for="street">Street</label><br>
                        <input type="text" name="street" id="street" class="{{ $errors->has('street') ? 'border border-danjer' : '' }}" value="{{ old('street') }}" autocomplete="off">
                    </div>
                    <div class="form-control">
                        <label for="postal_code">Postal code</label><br>
                        <input type="text" name="postal_code" id="postal_code" class="{{ $errors->has('postal_code') ? 'border border-danjer' : '' }}" value="{{ old('postal_code') }}" autocomplete="off">
                    </div>
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

        </div>

        <button class="flex w-full justify-center items-center h-50 rounded-lg rounded-t-none bg-oxford text-heather font-bold">Register a new account</button>

    </form>

</div>
@endsection
