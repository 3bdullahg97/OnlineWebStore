@extends('layouts.app')
@section('content')
<div class="flex justify-center items-center">
    <form action="{{ route('login') }}" method="post" class="m-15">
        @csrf
        <div class="bg-white p-20 rounded-lg rounded-b-none">
            <a href="/" class="flex flex-col justify-center items-center text-2xl text-oxford font-bold">Online<span class="text-base">WebStore</span></a>

            <p class="text-oxford text-sm font-bold m-20">Have you accout? <a href="/register" class="text-spindle">Register</a></p>

            <div class="form-group">

                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="form-control">
                        <label for="email">Email</label><br>
                        <input type="text" name="email" id="email" placeholder="example@example.com" class="{{ $errors->has('email') ? 'border border-danjer' : '' }}" value="{{ old('email') }}" autocomplete="off">
                    </div>

                    <div class="form-control">
                        <label for="last_name">Password</label><br>
                        <input type="password" name="password" id="password" class="{{ $errors->has('password') ? 'border border-danjer' : '' }}" value="{{ old('password') }}" autocomplete="off">
                    </div>
                </div>

                <div class="form-control pt-10">
                    <a href="{{ route('password.request') }}" class="text-oxford">Reset password?</a>
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
    
        <button class="flex w-full justify-center items-center h-50 rounded-lg rounded-t-none bg-oxford text-heather font-bold">Log In to your account</button>

    </form>

</div>
@endsection
