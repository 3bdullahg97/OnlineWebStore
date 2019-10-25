<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
class HomeController extends Controller
{

    public function index()
    {
        $user = User::find(auth()->id());

        return view('account.index', compact('user'));
    }

}
