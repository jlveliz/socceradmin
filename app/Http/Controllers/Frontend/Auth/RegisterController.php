<?php

namespace HappyFeet\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use HappyFeet\RepositoryInterface\RepresentantRepositoryInterface;
use Validator;


class RegisterController extends Controller
{
    
    private $representantRepository;

    public function __construct(RepresentantRepositoryInterface $representantRepository)
    {
        $this->representantRepository = $representantRepository;
    }

    public function showRegisterForm()
    {
    	return view('frontend.auth.insert-identification');
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

    	
    	// si existe representante
    	$existRepresentant = $this->existRepresentant($request);


    	//si no existe representante 
    	if ($existRepresentant->fails()) 
        {
    		session()->put('num_identification',$request->get('num_identification'));
    		return redirect('register-wizard');
        } 


        //si representante tiene niños
        $representant = $this->representantRepository->find(['num_identification'=>$request->get('num_identification')]);
        if (count($representant->students) > 0) 
        { 
            //verifica si ha llevado a niño a clase demostrativa
            if (condition) {
                # code...
            }
    	}
    	
    }


    private function existRepresentant(Request $request)
    {
        return Validator::make($request->all(), 
                ['num_identification' => Rule::exists('person')->where(function($query)
                    {
                        $query->select('person.num_identification')
                        ->rightJoin('user','user.person_id','=','person.id')
                        ->rightJoin('representant','representant.user_id','=','user.id');
                    })
                ]
            );
    }
}
