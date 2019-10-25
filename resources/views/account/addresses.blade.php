@extends('layouts.user-panel')
@section('title', 'Addresses')
@extends('templates.home-header')
@extends('templates.home-left-menu')
@section('user-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="{{ route('home') }}"><span class="fas fa-home m-10"></span>Home</a> / <a class="font-bold" href="{{ route('addresses') }}">Addresses</a></span>
    </nav>

    <div class="flex flex-col md:flex-row">
            <div class="flex flex-col bg-white md:w-1/4 rounded-lg m-10">
                <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">New address</div>
                <form id="new-address" action="{{ route('addresses.store') }}" method="post" class="form-group">
                    @csrf
                    <div class="form-control">
                        <label for="street">Street</label>
                        <input type="text" name="street" id="street"
                               class="{{ $errors->has('street') ? 'border border-danjer' : '' }}" autocomplete="off"
                               value="{{old('street')}}" required>
                    </div>

                    <div class="form-control">
                        <label for="postal_code">Postal code</label>
                        <input type="text" id="postal_code" name="postal_code"
                               class="{{ $errors->has('postal_code') ? 'border border-danjer' : '' }}" autocomplete="off"
                               value="{{old('postal_code')}}" required>
                    </div>

                    <div class="form-control">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city"
                               class="{{ $errors->has('city') ? 'border border-danjer' : '' }}" autocomplete="off"
                               value="{{old('city')}}" required>
                    </div>

                    <div class="form-control">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country"
                               class="{{ $errors->has('country') ? 'border border-danjer' : '' }} " autocomplete="off"
                               value="{{old('country')}}" required>
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

                    <div class="flex justify-center items-center m-25">
                        <div onclick="javascript:document.getElementById('new-address').submit()" role="button" class="custom-button">
                            <div class="button-title rounded-l-lg">
                                <span style="font-size: 12px">NEW ADDRESS</span>
                            </div>
                            <div class="button-icon rounded-r-lg">
                                <span class="fas fa-plus-circle"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex flex-col bg-white md:w-3/4 rounded-lg m-10">
                <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Addresses</div>
                @isset($addresses)
                    <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                        <thead class="bg-catskill_white">
                        <tr class="h-50">
                            <th>Street</th>
                            <th>Postal Code</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($addresses as $address)
                            <tr>
                                <td>{{ $address->street }}</td>
                                <td>{{ $address->postal_code }}</td>
                                <td>{{ $address->city }}</td>
                                <td>{{ $address->country }}</td>
                                <td>
                                    <form action="{{ route('addresses.destroy', $address->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg text-white m-5"><span class="fas fa-trash-alt"></span></button></form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $addresses->links() }}
                @endisset
            </div>
        </div>

@endsection
