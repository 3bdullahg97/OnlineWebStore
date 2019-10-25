<?php


namespace App\Managers;


use App\Address;
use App\User;

class RegisterManager
{
    public static function create(array $data)
    {
        $user = User::add($data);
        Address::add($data, $user);

        return $user;
    }
}
