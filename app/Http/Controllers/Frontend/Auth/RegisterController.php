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
    	// $existRepresentant = $this->existRepresentant($request);
        $representant = $this->representantRepository->find(['num_identification'=>$request->get('num_identification')]);

        // dd($representant->students);

        //si no existe representante 
        if (!$representant) 
        {
            session()->put('num_identification',$request->get('num_identification'));
            // hora de registrar padre
            return redirect()->route('wizard');
        } 


        //existe representante y busca si tiene niños
        if (count($representant->students) > 0) 
        { 
            foreach ($representant->students as $key => $student) 
            {
                //verifica si ha llevado a niño a clase demostrativa
                if ($student->hasTakenTrialClass()) { // lo ha llevado
                    dd("LLEVAR A PAGO");
                } else {
                    dd("tiene clase trial activa, reagendar y enviar a pago");
                }
            }
    	} 
        else 
        {
            //no tiene niños
            dd("esta registrado pero no tiene niños, hora de ingresar");
        }
    	
    }

    public function wizard(Request $request)
    {
        if (session()->has('num_identification')) {

            return view('frontend.auth.register');

        } else {

            return redirect()->route('register-show');

        }
    }
}
