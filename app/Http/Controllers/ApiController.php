<?php

namespace Futbol\Http\Controllers;

use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    private $field;



    public function __construct(FieldRepositoryInterface $field) {
        $this->middleware('auth:api')->except('login');
        $this->middleware('client')->except('login');
        $this->middleware('CORS')->except('login');
        $this->field = $field; 
    }

    /*
    */
    public function login(Request $request) {
        
        if(!$request->has('email'))  return response()->json("ingrese una email",401);
        if(!$request->has('password'))  return response()->json("ingrese una contraseña",401);

        $credendials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if(auth()->attempt($credendials)) {
            if(auth()->user()->isSuperAdmin()) {
                $token = auth()->user()->createToken('jlfutbol')->accessToken;
                return response()->json(['token' => $token],200);
            } else {
                return response()->json(['error'=> 'No Autorizado'],401);
            }
        } else {
            return response()->json(['error'=> 'No Autorizado'],401);
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

        return response()->json(['error'=> 'No Autorizado'],401);
    }

}
