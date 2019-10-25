<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $addresses = Address::where('user_id', '=', auth()->id())->paginate(7);

        return view('account.addresses', compact('addresses'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Address::class);

        $user = User::find(auth()->id());

        $validatedRequest = $this->validate($request, [
            'street'      => 'string|min:3|max:50|required',
            'city'        => 'string|min:3|max:50|required',
            'postal_code' => 'integer|digits_between:5,10|required',
            'country'     => 'string|required'
        ]);

        Address::add($validatedRequest, $user);

        return redirect()->back();
    }

    public function show(Address $address)
    {
        //
    }

    public function edit(Address $address)
    {
        //
    }

    public function update(Request $request, Address $address)
    {
        //
    }

    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);

       $address->delete();

       return redirect()->back();
    }
}
