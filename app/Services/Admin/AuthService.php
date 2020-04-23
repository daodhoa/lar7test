<?php


namespace App\Services\Admin;


use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{

    public function login($credentials)
    {
        return Auth::attempt($credentials);
    }
}
