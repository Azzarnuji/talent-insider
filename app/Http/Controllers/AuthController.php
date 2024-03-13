<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login(){

        $data = [
            'title'=>"Login Page"
        ];
        return view('Auth.LoginPage', $data);
    }
    public function register()
    {
        $data = [
            'title'=>"Register Page"
        ];
        return view('Auth.RegisterPage', $data);
    }
}
