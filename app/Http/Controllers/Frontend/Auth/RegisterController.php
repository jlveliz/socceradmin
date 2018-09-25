<?php

namespace HappyFeet\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
    	return view('frontend.auth.register');
    }
}
