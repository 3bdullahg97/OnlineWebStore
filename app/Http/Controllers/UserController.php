<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::paginate(7);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validatedAttributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'numeric', 'digits:14'],
        ]);

        if(encrypt($validatedAttributes['password']) == $user->password)
            $user->update([
                'first_name' => $validatedAttributes['first_name'],
                'last_name' => $validatedAttributes['last_name'],
                'email_name' => $validatedAttributes['email'],
                'password' => encrypt($validatedAttributes['password']),
                'phone_name' => $validatedAttributes['phone']
            ]);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->back();
    }
}
