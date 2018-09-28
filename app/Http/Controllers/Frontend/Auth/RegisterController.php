<?php

namespace HappyFeet\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\Repository\RepresentantRepositoryInterface;
use Validator;


class RegisterController extends Controller
{
    public function showRegisterForm()
    {
    	return view('frontend.auth.register');
    }

    public function verifyForm(Request $request)
    {
    	
    	$validator = Validator::make($request->all(), 
    		['num_identification' => 'required|valid_dni'],
    		[
    			'num_identification.valid_dni' => 'Ingrese una cédula válida',
    			'num_identification.required' => 'Ingrese una cédula válida'
    		]
    	);

    	if ($validator->fails()) 
    	{
    	 	return redirect()->back()
    	 	->withInput($request->only('num_identification'))
    	 	->withErrors(['num_identification'=> $validator->errors()->first()]);
    	}

    	$validator = Validator::make($request->all(), 
    		[]);
    	
    }
}
