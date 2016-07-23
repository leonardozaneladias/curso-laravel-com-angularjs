<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 23/07/16
 * Time: 01:07
 */

namespace CodeProject\OAuth;


use Illuminate\Support\Facades\Auth;


class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}