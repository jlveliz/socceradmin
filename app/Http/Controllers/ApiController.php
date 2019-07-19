<?php

namespace Futbol\Http\Controllers;

use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    private $field;



    public function __construct(FieldRepositoryInterface $field) {
        $this->middleware('auth:api')->except('login');
        $this->middleware('client');
        $this->middleware('CORS');
        $this->field = $field; 
    }

    /*
    */
    public function login(Request $request) {
        
        if(!$request->has('email'))  return response("ingrese una email",401);
        if(!$request->has('password'))  return response("ingrese una contraseña",401);

        $credendials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if(auth()->attempt($credendials)) {
            $token = auth()->user()->createToken('jlfutbol')->accessToken;
            return response()->json(['token' => $token],200);
        } else {
            return response()->json(['error'=> 'No Autorizado']);
        }
    }

    /*
        Show fields Json
        @return \Illuminate\Http\Response
    */
    public function getFields()
    {
        if(auth()->user()) {
            return response($this->field->enum(),200);
        }
    }

}
