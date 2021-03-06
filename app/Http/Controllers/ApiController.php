<?php

namespace Futbol\Http\Controllers;

use Futbol\RepositoryInterface\GroupClassRepositoryInterface;
use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Futbol\RepositoryInterface\StudentRepositoryInterface;
use Futbol\RepositoryInterface\AgeRangeRepositoryInterface;
use Futbol\Exceptions\GroupClassException;
use Futbol\Exceptions\StudentException;
use Futbol\Exceptions\AgeRangeException;
use Futbol\Events\NewDemoClass;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{

    private $field;

    private $groupClass;

    private $studentRepo;

    private $ageRange;



    public function __construct(FieldRepositoryInterface $field, GroupClassRepositoryInterface $groupClass, StudentRepositoryInterface $studentRepo, AgeRangeRepositoryInterface $ageRange) {
       
        $this->middleware('auth:api')->except('login');
        $this->middleware('client')->except('login');
        // $this->middleware('CORS')->except('login');
        $this->field = $field; 
        $this->groupClass = $groupClass; 
        $this->studentRepo = $studentRepo; 
        $this->ageRange = $ageRange; 

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

    /**
     * get age ranges from system
     *
     * @return json
     */
    public function getAgesRange()
    {
        try { 
            $ages = $this->ageRange->getRangeSecuence();
            return response()->json($ages,200);
        } catch (AgeRangeException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return response()->json($message,500);
        }
    }

    /*
        Show fields Json
        @return \Illuminate\Http\Response
    */
    public function getFields($age)
    {
        if(auth()->user()) {
            return response($this->field->getFieldsByAge($age),200);
        }

        return response()->json(['error'=> 'No Autorizado'],401);
    }


    /**
     * 
     */

    public function getAvailableDayField($fieldId, Request $request)
    {
        
        try {
            $days = $this->groupClass->getAvailableDayByField($fieldId);
            return response()->json($days,200);
            
        } catch (GroupClassException $e) {
            return response()->json($e->getMesage(),$e->getCode());
        }
        
    }


    public function getAvailableHourDay($fieldId ,Request $request)
    {
        try {  
            $days = $this->groupClass->getAvailableHourDay($request->get('day'), $fieldId);
            return response()->json($days,200);
        } catch (GroupClassException $e) {
            return response()->json($e->getMesage(),$e->getCode());
        }
    }

    public function process(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $user = $this->studentRepo->insertFromRegisterForm($request->all());
            DB::commit();
            // event( new NewDemoClass($user) );
            return response()->json("Exitoso",200);
        } catch (StudentException $e) {
            DB::rollback();
            return response()->json($e->getMessage(),$e->getCode());
        } 
        catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

}
